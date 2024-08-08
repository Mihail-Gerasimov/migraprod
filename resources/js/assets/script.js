document.addEventListener('DOMContentLoaded', function () {

    "use strict"
    // modal
    const winModal = document.querySelector('.modal'),
        btnModal = document.querySelector('.big__btn'),
        btnClose = document.querySelector('.modal__wrapper-close');

    // modal
    btnModal.addEventListener('click', function () {
        winModal.classList.add('modal--active');
    });

    btnClose.addEventListener('click', function () {
        winModal.classList.remove('modal--active');
    });

    // quiz
    const winQuiz = document.querySelector('.quiz'),
        btnQuiz = document.querySelectorAll('.btn__quiz'),
        btnQuizClose = document.querySelector('.quiz__close');

    btnQuiz.forEach(item => {
        item.addEventListener('click', function () {
            winQuiz.classList.add('quiz--active');
        });
    })

    btnQuizClose.addEventListener('click', function () {
        winQuiz.classList.remove('quiz--active');
    });
});