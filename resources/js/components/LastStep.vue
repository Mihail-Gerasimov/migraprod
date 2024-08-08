<template>
    <transition>
        <div v-show="stateLastStep" class="quiz__last">
            <button class="quiz__close">&#9746;</button>
            <p class="quiz__title">Остался последний шаг!</p>
            <p class="quiz__last-description">Напишите свой номер телефона и получите подробную схему как оформить
                гражданство РФ именно в вашем случае *</p>

            <form id="quiz-form" @submit.prevent="submitForm" class="quiz__last-form" action="#">
                <div class="input-group quiz__last-group">
                    <input v-model="phone" v-maska="'+7 (###) ###-####'"
                        :class="{ 'input--invalid': (v$.phone.required.$invalid && v$.$dirty) || (v$.phone.minLength.$invalid && v$.$dirty) }"
                        type="tel" placeholder="+7 ***-***-****" id="quiz-name" class="quiz__last-form__num"
                        name="phone">
                    <div class="input__msg" v-if="v$.phone.required.$invalid && v$.$dirty">Поле должно быть заполнено
                    </div>
                    <div class="input__msg" v-if="v$.phone.minLength.$invalid && v$.$dirty">Неверный формат</div>
                </div>

                <label class="politics">
                    <input v-model="politics" type="checkbox" class="politics__input">
                    <span class="politics__ok"></span>
                    <span class="politics__text">Нажимая на кнопку, вы даете согласие на обработку <a href="/politics"
                            target="_blank">персональных данных</a></span>

                    <span class="invalid-feedback invalid-feedback--politics"
                        v-if="v$.politics.agree.$invalid && v$.$dirty">Согласие обязательно</span>
                </label>

                <div class="quiz__wrapper-btns">
                    <button @click.prevent="toQuiz" class="quiz__wrapper-btns__prev">
                        <svg width="30" height="16" viewBox="0 0 45 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                fill="white" />
                        </svg>
                    </button>
                    <button id="quiz-submit" type="submit" class="btn quiz__wrapper-btns__next">Далее
                        <svg width="30" height="16" viewBox="0 0 45 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                fill="black" />
                        </svg>
                    </button>
                </div>
            </form>
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
    name: "LastStep",
    props: ["data",],
    data() {
        return {
            name: 'anonim',
            phone: '',
            politics: true,
            isDisabled: false,
            counters: null
        }
    },
    computed: {
        stateLastStep() {
            return this.$store.getters['modal/stateLastStep']
        },
        stateQuestionAnswer() {
            return this.$store.getters['quiz/stateQuestionAnswer']
        },
    },
    methods: {
        toQuiz() {
            this.$emit('toQuiz')
        },
        clear() {
            this.name = ''
            this.phone = ''
        },
        async submitForm() {
            const isFormCorrect = await this.v$.$validate()

            if (!isFormCorrect) return

            this.isDisabled = true
            await axios.post('api/v1/lead.add', {
                host: window.location.host,
                referrer: document.referrer,
                url_query_string: sessionStorage.getItem('urlQueryString'),
                name: this.name,
                phone: this.phone.replace(/\D/g, ""),
                data: this.data
            }).then(response => {
                if (response.status === 201) {
                    if (this.counters.ym) ym(this.counters.ym, "reachGoal", "order");
                    this.v$.$reset()
                    this.clear()
                    this.isDisabled = false
                    setTimeout(() => {
                        window.location.href = '/thanks'
                    }, 500)
                }
            })
        }
    },
    validations() {
        return {
            phone: { required, minLength: minLength(16) },
            politics: { agree: (bool) => { return bool } }
        }
    },
    async created() {
        await axios
            .get("/api/v1/counters")
            .then((response) => {
                this.counters = response.data
                console.log(this.counters)
            })
            .catch((error) => {
                console.log(error.message);
            });
    }

}
</script>

<style scoped>
.quiz__last-group {
    position: relative;
}

.v-enter-active {
    transition: opacity 0.5s ease;
}

.v-enter-from {
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
    bottom: 70px;
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
}

.politics__text {
    font-size: 13px;
    color: #ffffff;
}

.politics__text a {
    color: red;
}


.quiz__last-group {
    width: 100%;
}
</style>
