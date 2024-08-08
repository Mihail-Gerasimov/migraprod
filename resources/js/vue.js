import { createApp } from "vue";
import { store } from "./store";
import Maska from "maska";
import ModalApp from "./components/Modal.vue";
import QuizApp from "./components/Quiz.vue";




import 'vue-select/dist/vue-select.css';

const app = createApp({
    components: {
        ModalApp,
        QuizApp,
    },

    created: function () {

        if (!sessionStorage.getItem('urlQueryString'))
            sessionStorage.setItem('urlQueryString', window.location.href);
    }
});

app.use(store)
app.use(Maska);

app.mount("#app");
