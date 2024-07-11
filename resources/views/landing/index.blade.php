<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== BOX ICONS ==========-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <title>Found and Lost | Helping You Reunite with Your Belongings</title>
</head>

<body>
    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-up-arrow-alt scrolltop__icon'></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="/" class="flex items-center mt-5">
                <img src="{{ asset('storage/icons/lost-found.png') }}" class="h-10 md:hidden">
                <img src="{{ asset('storage/icons/lost-found.png') }}" alt="logo" width="130" height="32" class="py-3 hidden md:block">
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                    <li class="nav__item"><a href="#share" class="nav__link">About us</a></li>
                    <li class="nav__item"><a href="#decoration" class="nav__link">Login</a></li>
                    <li class="nav__item"><a href="#accessory" class="nav__link">Contact</a></li>

                    <li><i class='bx bx-toggle-left change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!--========== HOME ==========-->
        <section class="home" id="home">
            <div class="home__container bd-container bd-grid">
                <div class="home__img">
                    <img src="{{ asset('storage/images/home.png') }}" alt="">
                </div>

                <div class="home__data">
                    <h1 class="home__title">Lost and Found Service</h1>
                    <p class="home__description">Explore our lost and found service to recover lost items or report found items. Help us reunite lost belongings with their owners.</p>
                    <a href="{{route("login")}}" class="button">Get Started</a>
                </div>
            </div>
        </section>



        <!--========== About us ==========-->
        <section class="share section bd-container" id="share">
            <div class="share__container bd-grid">
                <div class="share__data">
                    <h2 class="section-title-center">About Our Lost and Found Service</h2>
                    <p class="share__description">At our lost and found service, we are dedicated to reuniting lost items with their owners and helping individuals report found items. Our goal is to create a community-driven initiative where lost belongings find their way back home.</p>
                </div>

                <div class="share__img">
                    <img src="{{ asset('storage/images/shared.png') }}" alt="">
                </div>
            </div>
        </section>

        <!--========== Login ==========-->
        <section class="decoration section bd-container" id="decoration">
            <div class="home__container bd-container bd-grid">
                <div class="home__img">
                    <img src="{{ asset('storage/images/fingerprint.png') }}" alt="">
                </div>

                <div class="home__data">
                    <h1 class="home__title">Login or Register</h1>
                    <p class="home__description">Sign in to manage your lost and found reports or register for a new account to get started.</p>
                    <div>
                        <a href="{{route("login")}}" class="button">Login</a>
                    </div>
                </div>

            </div>
        </section>

        <!--========== ACCESSORIES ==========-->
        <section class="accessory section bd-container" id="accessory">
            <div class="send__container bd-container bd-grid">
                <div class="send__content">
                    <h2 class="section-title-center send__title">Contact Us</h2>
                    <p class="send__description">Have questions or feedback? Reach out to us using the form below.</p>
                    <form action="">
                        <div class="send__direction">
                            <input type="text" placeholder="Your Message" class="send__input">
                            <a href="#" class="button">Send</a>
                        </div>
                    </form>
                </div>


                <div class="send__img">
                    <img src="{{ asset('storage/images/send.png') }}" alt="">
                </div>
            </div>
        </section>

        <!--========== SEND GIFT ==========-->

    </main>

    <!--========== FOOTER ==========-->
    <footer class="footer section">
        <div class="footer__container bd-container bd-grid">
            <div class="footer__content">
                <h3 class="footer__title">
                    <a href="#" class="footer__logo">Christmas Gift</a>
                </h3>
                <p class="footer__description">I sent a gift and it gives <br> happiness</p>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Services</h3>
                <ul>
                    <li><a href="#" class="footer__link">Pricing </a></li>
                    <li><a href="#" class="footer__link">Discounts</a></li>
                    <li><a href="#" class="footer__link">Shipping mode</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Company</h3>
                <ul>
                    <li><a href="#" class="footer__link">Blog</a></li>
                    <li><a href="#" class="footer__link">About us</a></li>
                    <li><a href="#" class="footer__link">Our mision</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Social</h3>
                <a href="#" class="footer__social"><i class='bx bxl-facebook-circle '></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram-alt'></i></a>
            </div>
        </div>

        <p class="footer__copy">&#169; 2024. All right reserved</p>
    </footer>

    <!--========== SCROLL REVEAL ==========-->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!--========== MAIN JS ==========-->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>