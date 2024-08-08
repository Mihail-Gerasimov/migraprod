<template>
    <transition>

        <div @click="modalFalseTarget($event)" class="modal">
            <div class="modal__container">
                <div class="modal__wrapper">

                    <p class="modal__wrapper-title">Оставьте заявку!</p>

                    <form action="#" id="modal-form">

                        <div class="input-group modal-main__input-group">
                            <input v-model="name"
                                :class="{ 'input--invalid': (v$.name.required.$invalid && v$.$dirty) || (v$.name.minLength.$invalid && v$.$dirty) }"
                                type="text" placeholder="Ваше имя" id="modal-name" name="name">

                            <div class="input__msg" v-if="v$.name.required.$invalid && v$.$dirty">Поле должно быть
                                заполнено</div>
                            <div class="input__msg" v-if="v$.name.minLength.$invalid && v$.$dirty">Минимальная длина
                                {{ v$.name.minLength.$params.min }}</div>
                        </div>

                        <div class="input-group modal-main__input-group">
                            <input v-model="phone" v-maska="'+7 (###) ###-####'"
                                :class="{ 'input--invalid': (v$.phone.required.$invalid && v$.$dirty) || (v$.phone.minLength.$invalid && v$.$dirty) }"
                                type="tel" placeholder="Номер телефона" id="modal-phone" name="phone">
                            <div class="input__msg" v-if="v$.phone.required.$invalid && v$.$dirty">Поле должно быть
                                заполнено</div>
                            <div class="input__msg" v-if="v$.phone.minLength.$invalid && v$.$dirty">Неверный формат
                            </div>
                        </div>

                        <button @click.prevent="submitForm" type="submit" id="modal-submit" class="btn">
                            Отправить
                        </button>

                        <label class="politics">
                            <input v-model="politics" type="checkbox" class="politics__input">
                            <span class="politics__ok"></span>
                            <span class="politics__text">Нажимая на кнопку, вы даете согласие на обработку <a
                                    href="/politics" target="_blank">персональных данных</a></span>

                            <span class="invalid-feedback invalid-feedback--politics"
                                v-if="v$.politics.agree.$invalid && v$.$dirty">Согласие обязательно</span>
                        </label>
                    </form>
                    <button class="modal__wrapper-close">&#9746;</button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength } from '@vuelidate/validators'

export default {
    setup() {
        return { v$: useVuelidate() }
    },
    name: "Modal",
    data() {
        return {
            name: '',
            phone: '',
            politics: true,
            isDisabled: false,
            counters: null
        }
    },
    computed: {
        stateModal() {
            return this.$store.getters['modal/stateModal']
        }
    },
    methods: {
        clear() {
            this.name = ''
            this.phone = ''
        },
        async submitForm() {
            const isFormCorrect = await this.v$.$validate()
            if (!isFormCorrect) {
                return
            }
            this.isDisabled = true
            await axios.post('/api/v1/lead.add', {
                name: this.name,
                phone: this.phone.replace(/\D/g, ""),
                host: window.location.host,
                referrer: document.referrer,
                url_query_string: sessionStorage.getItem('urlQueryString'),
            }).then(response => {
                if (response.status === 201) {
                    if (this.counters.ym) ym(this.counters.ym, "reachGoal", "order");
                    this.v$.$reset()
                    this.clear()
                    this.isDisabled = false
                    this.$store.dispatch('modal/modalFalse')
                    setTimeout(() => {
                        window.location.href = '/thanks'
                    }, 500)
                }
            })
        },
        modalFalseTarget(e) {
            if (e.target.classList.contains('modal__container')) {
                this.$store.dispatch('modal/modalFalse')
            }
        },
        modalFalse() {
            this.$store.dispatch('modal/modalFalse')
        }
    },
    validations() {
        return {
            name: { required, minLength: minLength(2) },
            phone: { required, minLength: minLength(17) },
            politics: { agree: (bool) => { return bool } }
        }
    },

    async created() {
        await axios
            .get("/api/v1/counters")
            .then((response) => {
                this.counters = response.data
            })
            .catch((error) => {
                console.log(error.message);
            });
    }
}
</script>

<style scoped>
.modal-main__input-group {
    position: relative;
}

.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

.invalid-feedback {
    position: absolute;
    top: 20px;
    left: 10px;
    width: 100%;
    color: #dc3545;
    text-align: left;
    font-size: 14px;
}

.invalid-feedback--politics {
    top: auto;
    left: 0;
    bottom: 8px;
    text-align: center;
}

.politics {
    width: 100%;
    display: flex;
    align-items: center;
    column-gap: 5px;
}

.politics__input {
    margin: 0;
    width: fit-content !important;
}

.politics__text {
    font-size: 13px;
    color: #858585;
}

.politics__text a {
    color: red;
}

.input__msg {
    top: 20%;
    left: 10px;
}
</style>
