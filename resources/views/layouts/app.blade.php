<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Миграционный центр - узнайте как именно в вашей ситуации получить Квоту на РВП, РВП, ВНЖ или гражданство РФ.">

    {{--    favicon--}}
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Миграционный центр - узнайте как именно в вашей ситуации получить Квоту на РВП, РВП, ВНЖ или гражданство РФ.
    </title>

    @vite([
    'resources/sass/main.scss',
    'resources/js/assets/script.js',
    'resources/js/app.js'
    ])


</head>

<body>
    <div id="app">

        <header class="header bgLightGrey">
            <div class="container">
                <div class="nav">
                    <div class="logo">
                        <img src="{{ Vite::asset('resources/img/nav/logo.png') }}" alt="Логотип">
                    </div>

                    <a href="tel:+7 495 275-18-55" class="nav__num fw600">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_44_163" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <rect width="24" height="24" fill="#D9D9D9" />
                            </mask>
                            <g mask="url(#mask0_44_163)">
                                <path
                                    d="M19.95 21C17.8667 21 15.8083 20.5458 13.775 19.6375C11.7417 18.7292 9.89167 17.4417 8.225 15.775C6.55833 14.1083 5.27083 12.2583 4.3625 10.225C3.45417 8.19167 3 6.13333 3 4.05C3 3.75 3.1 3.5 3.3 3.3C3.5 3.1 3.75 3 4.05 3H8.1C8.33333 3 8.54167 3.07917 8.725 3.2375C8.90833 3.39583 9.01667 3.58333 9.05 3.8L9.7 7.3C9.73333 7.56667 9.725 7.79167 9.675 7.975C9.625 8.15833 9.53333 8.31667 9.4 8.45L6.975 10.9C7.30833 11.5167 7.70417 12.1125 8.1625 12.6875C8.62083 13.2625 9.125 13.8167 9.675 14.35C10.1917 14.8667 10.7333 15.3458 11.3 15.7875C11.8667 16.2292 12.4667 16.6333 13.1 17L15.45 14.65C15.6 14.5 15.7958 14.3875 16.0375 14.3125C16.2792 14.2375 16.5167 14.2167 16.75 14.25L20.2 14.95C20.4333 15.0167 20.625 15.1375 20.775 15.3125C20.925 15.4875 21 15.6833 21 15.9V19.95C21 20.25 20.9 20.5 20.7 20.7C20.5 20.9 20.25 21 19.95 21ZM6.025 9L7.675 7.35L7.25 5H5.025C5.10833 5.68333 5.225 6.35833 5.375 7.025C5.525 7.69167 5.74167 8.35 6.025 9ZM14.975 17.95C15.625 18.2333 16.2875 18.4583 16.9625 18.625C17.6375 18.7917 18.3167 18.9 19 18.95V16.75L16.65 16.275L14.975 17.95Z"
                                    fill="#1C1B1F" />
                            </g>
                        </svg>
                        <span>+7 495 275-18-55</span>
                    </a>
                </div>

                <div class="header__wrapper">
                    <img src="{{ Vite::asset('resources/img/header/man.png') }}" alt="img">

                    <div class="header__inner">
                        <h1 class="title header__title">Пройдите тест за 2 мин.</h1>
                        <p class="header__inner-subtitle fw600">
                            и узнайте как именно в вашей ситуации получить Квоту на РВП, РВП, ВНЖ или гражданство РФ
                        </p>

                        <button @click="startQuiz" class="btn header__inner-btn btn__quiz">Начать тест
                            <svg width="45" height="16" viewBox="0 0 45 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M44.7071 8.70711C45.0976 8.31658 45.0976 7.68342 44.7071 7.29289L38.3431 0.928932C37.9526 0.538408 37.3195 0.538408 36.9289 0.928932C36.5384 1.31946 36.5384 1.95262 36.9289 2.34315L42.5858 8L36.9289 13.6569C36.5384 14.0474 36.5384 14.6805 36.9289 15.0711C37.3195 15.4616 37.9526 15.4616 38.3431 15.0711L44.7071 8.70711ZM0 9H44V7H0V9Z"
                                    fill="white" />
                            </svg>
                        </button>

                        <p class="header__inner-text grey">Благодаря этому тесту <span class="dark">вы сможете
                                сэкономить</span>
                            минимум
                            <span class="dark">1 год</span> и около <span class="dark">70.000 рублей</span>
                        </p>

                        <p class="header__inner-text grey">
                            Тест разработан на основе действующего законодательства и нашего более чем 8-летнего опыта
                            работы в гражданских делах.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer__wrapper">
                    <div class="logo">
                        <img src="{{ Vite::asset('resources/img/nav/logo.png') }}" alt="Логотип">
                    </div>

                    <div class="footer__inner">
                        <a class="nav__num fw600" href="tel:+7 495 275-18-55">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_44_163" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                    width="24" height="24">
                                    <rect width="24" height="24" fill="#D9D9D9" />
                                </mask>
                                <g mask="url(#mask0_44_163)">
                                    <path
                                        d="M19.95 21C17.8667 21 15.8083 20.5458 13.775 19.6375C11.7417 18.7292 9.89167 17.4417 8.225 15.775C6.55833 14.1083 5.27083 12.2583 4.3625 10.225C3.45417 8.19167 3 6.13333 3 4.05C3 3.75 3.1 3.5 3.3 3.3C3.5 3.1 3.75 3 4.05 3H8.1C8.33333 3 8.54167 3.07917 8.725 3.2375C8.90833 3.39583 9.01667 3.58333 9.05 3.8L9.7 7.3C9.73333 7.56667 9.725 7.79167 9.675 7.975C9.625 8.15833 9.53333 8.31667 9.4 8.45L6.975 10.9C7.30833 11.5167 7.70417 12.1125 8.1625 12.6875C8.62083 13.2625 9.125 13.8167 9.675 14.35C10.1917 14.8667 10.7333 15.3458 11.3 15.7875C11.8667 16.2292 12.4667 16.6333 13.1 17L15.45 14.65C15.6 14.5 15.7958 14.3875 16.0375 14.3125C16.2792 14.2375 16.5167 14.2167 16.75 14.25L20.2 14.95C20.4333 15.0167 20.625 15.1375 20.775 15.3125C20.925 15.4875 21 15.6833 21 15.9V19.95C21 20.25 20.9 20.5 20.7 20.7C20.5 20.9 20.25 21 19.95 21ZM6.025 9L7.675 7.35L7.25 5H5.025C5.10833 5.68333 5.225 6.35833 5.375 7.025C5.525 7.69167 5.74167 8.35 6.025 9ZM14.975 17.95C15.625 18.2333 16.2875 18.4583 16.9625 18.625C17.6375 18.7917 18.3167 18.9 19 18.95V16.75L16.65 16.275L14.975 17.95Z"
                                        fill="#1C1B1F" />
                                </g>
                            </svg>
                            <span>+7 495 275-18-55</span>
                        </a>
                        <p class="fw600">Ежедневно с 09:00 до 21:00</p>
                        <p>юр.адрес : ООО "ОВАЛ" ИНН: 6319215026 ОГРН: 1176313011544
                            443023, г. Самара, ул. Советской Армии, дом 17</p>
                    </div>
                </div>
            </div>
        </footer>
        <modal-app></modal-app>
        <div class="quiz">
            <div class="quiz__container">
                <quiz-app></quiz-app>
            </div>
        </div>
    </div>



    @include('layouts._counters', [
    'counters' => [
    'yandexMetrika' => [],
    ]
    ])


</body>

</html>