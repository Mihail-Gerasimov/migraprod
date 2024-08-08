<template>
    <transition>
            <div v-show="stateQuiz" class="quiz__wrapper">
                <button class="quiz__close">&#9746;</button>
                <p class="quiz__title">{{ stateQuestionAnswer[step].question }}</p>

                <div v-if="stateQuestionAnswer[step].type === 'radio'" class="quiz__wrapper-questions">

                        <label
                            v-for="(answer, answerIndex) in stateQuestionAnswer[step].answers"
                            :key="answerIndex"
                            class="quiz__wrapper-questions__label">
                                <input
                                    :value="answer.text || answer"
                                    v-model="dataAnswer"
                                    @change="prevNext(1, answer.cut)"
                                    name="quiz" type="radio" class="quiz__wrapper-questions__input">
                                <p class="quiz__wrapper-questions__text">{{ answer.text || answer }}</p>
                        </label>

                        <!-- <p class="invalid-feedback invalid-feedback--radio" v-if="v$.dataAnswer.required.$invalid && v$.$dirty">Выберите вариант.</p> -->

                    </div>
                <div class="quiz__wrapper-btns">
                    <button v-if="step === 0" disabled @click.prevent="prevNext(-1)" class="quiz__wrapper-btns__prev">
                        <svg width="30" height="16" viewBox="0 0 45 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                fill="white" />
                        </svg>
                    </button>
                      <button v-else @click.prevent="prevNext(-1)" class="quiz__wrapper-btns__prev">
                        <svg width="30" height="16" viewBox="0 0 45 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                fill="white" />
                        </svg>
                    </button>
                    <button @click.prevent="prevNext(1)" class="btn quiz__wrapper-btns__next">Далее
                        <svg width="30" height="16" viewBox="0 0 45 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                fill="black" />
                        </svg>
                    </button>
                </div>
                </div>
    </transition>
     <last-step :data="data" :stateLastStep="stateLastStep" @toQuiz="toQuiz"></last-step>
</template>

<script>
import blink from "../assets/blink";
import { useVuelidate } from '@vuelidate/core';
import { required } from '@vuelidate/validators'
import LastStep from "./LastStep.vue";

export default {
    setup () {
        const getImageUrl = (path) => {
            return new URL(`/resources/img/quiz/${path}`, import.meta.url).href;
        };
        return { v$: useVuelidate(), getImageUrl }
    },
    name: "Quiz",
    components: {
        LastStep
    },
    data() {
        return {
            type: '',
            dataAnswer: '',
            dataAnswerArr: [],
            myShow: true,
            step: 0,
            data: [],
            // stateQuiz: true,
            stateLastStep: false
        }
    },
    computed: {
        stateQuiz() {
          return this.$store.getters['modal/stateQuiz']
        },
        stateQuestionAnswer(){
            return this.$store.getters['quiz/stateQuestionAnswer']
        },
        getDataAnswer(){
            if (this.data[this.step])
                return this.data[this.step].answer
            return false
        }
    },
    methods: {
        toQuiz() {
          // this.stateLastStep = false
          // this.stateQuiz = true
            this.$store.commit('modal/LAST_STEP_FALSE')
            this.$store.commit('modal/QUIZ_TRUE')
          this.dataAnswer = this.data[this.data.length - 1].answer
        },
        modalQuizFalse() {
            this.$store.dispatch('modal/modalQuizFalse')
        },
        modalQuizFalseTarget(e) {
            if (e.target.classList.contains('modal__container')) {
                this.modalQuizFalse()
            }
        },
        prevNext(val, cut){

            if (this.step === 0 && val < 0)
            {
                this.$store.commit('modal/QUIZ_FALSE')
                this.$store.commit('modal/MAIN_TRUE')
                return
            }

            if(val > 0) {
                if (this.v$.dataAnswer.$invalid) {
                    this.v$.$touch()
                    return
                }
                this.v$.$reset()
            }

            if(cut) {
                alert(cut)
                this.dataAnswer = ''
                return
            }

            const object = {
                question: this.stateQuestionAnswer[this.step].question,
                answer: ''
            }

            if(this.stateQuestionAnswer[this.step].type === 'checkbox') {
                object.answer = this.dataAnswerArr.join()
            } else {
                object.answer = this.dataAnswer
            }

            this.data[this.step] = object

            console.log(this.data)
            if (val <= 0) {
                this.step += val
            } else {
                if (this.step === this.stateQuestionAnswer.length - 1) {
                    this.$store.commit('modal/QUIZ_FALSE')
                    this.$store.commit('modal/LAST_STEP_TRUE')
                    return false
                }
                this.step += val
            }

            this.dataAnswer = ''
            this.dataAnswerArr = []
            if (this.getDataAnswer && this.stateQuestionAnswer[this.step].type !== 'checkbox') {
                this.dataAnswer = this.getDataAnswer
            } else if (this.getDataAnswer && this.stateQuestionAnswer[this.step].type === 'checkbox') {
                this.dataAnswerArr = this.getDataAnswer.split(',')
            }
            if (this.step !== this.stateQuestionAnswer.length) blink(this.$refs.quiz)
        },
    },
    validations: {
        dataAnswer: {
            required,
            numeric: function (dataAnswer) {
                if (this.stateQuestionAnswer[this.step].validate && this.stateQuestionAnswer[this.step].validate.numeric) {
                    const notDigits = /\D/
                    if (notDigits.test(dataAnswer)) {
                        return false
                    }
                }
                return true
            },
            custom: function (dataAnswer) {
                if('validate' in this.stateQuestionAnswer[this.step]) {
                    return this.stateQuestionAnswer[this.step].validate(dataAnswer)
                }
                return true
            }
        }
    }
}
</script>

<style scoped>
.v-enter-active {
    transition: opacity 0.5s ease;
}

.v-enter-from {
    opacity: 0;
}

.invalid-feedback {
    position:absolute;
    top: 1px;
    left: 0;
    width: 100%;
    color: #dc3545;
    text-align: center;
    font-size: 14px;
}
.invalid-feedback--radio {
    top: -20px;
    text-align: center;
}
</style>