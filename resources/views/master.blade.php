<?php

$canonicalUrl = config('app.url');
$favicon = 'favicon2.png';

$title_wide = 'Web-Opt';
$title_legal = 'Web-Opt, LLC';
$slogan = $slogan_br = 'Software Solutions';
$work1 = 'Award-winning, digital marketing and social media agency based in New York City. Since 1999, GLOW has partnered with high-profile brands and networks to build world-class social and digital campaigns.';
$work2 = 'Founded in Paris, Criteo has become a global leader in commerce marketing. Driving this growth: machine-learning technology, data and performance at scale, and measurable ROI for our clients, as well as the ingenuity and spirit worldwide.';
$email = 'contact@web-opt.com';

?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Home | {{ $title_wide }}
    </title>
    <meta name="description" content="{{ $slogan }}">
    <meta name="keywords" content="web-opt, software solutions, geo artemenko, www, web site, design, development, optimization, SEO">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="{{ $slogan }}">
    <meta name="twitter:card" content="{{ $slogan }}">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
    <meta name="robots" content="{{ config('view.robots') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" media="screen" type="text/css" href="{{ mix('build/css/app.css') }}">
</head>
<body>
    <div class="top-navigation">
        <div class="top-navigation__burger js-burger"></div>
        <div class="top-navigation__desktop">
            <a href="#home" class="top-navigation__link">
                Home
            </a>
            <a href="#work1" class="top-navigation__link">
                Work 1
            </a>
            <a href="#work2" class="top-navigation__link">
                Work 2
            </a>
            <a href="#contact" class="top-navigation__link">
                Contact
            </a>
        </div>
    </div>
    <div class="mobile-navigation hidden js-mobile-navigation">
        <div class="mobile-navigation__box">
            <a href="#home" class="mobile-navigation__link">
                Home
            </a>
            <a href="#work1" class="mobile-navigation__link">
                Work
            </a>
            <a href="#contact" class="mobile-navigation__link">
                Contact
            </a>
        </div>
    </div>
    <div id="home" class="header">
        <h1>
            WEB<span>&bull;</span>OPT
        </h1>
        <div class="intro-description">
            {!! $slogan_br !!}
        </div>
    </div>
    <div id="work1" class="work criteo">
        <div class="work__box">
            <h2>
                Criteo
            </h2>
            <p class="work-description">
                {{ $work2 }}
            </p>
            <div class="spacer"></div>
            <a href="https://www.criteo.com/" target="_blank" class="inversed">
                www.criteo.com
            </a>
        </div>
    </div>
    <div id="work2" class="work weareglow">
        <div class="work__box">
            <h2>
                Glow
            </h2>
            <p class="work-description">
                {{ $work1 }}
            </p>
            <div class="spacer"></div>
            <a href="https://weareglow.com/" target="_blank">
                www.weareglow.com
            </a>
        </div>
    </div>
    <div id="contact" class="footer">
        <div class="footer__box">
            <h2>
                Contact
            </h2>
            <div class="contact">
                <a href="mailto:{{ $email }}" class="contact__email">
                    {{ $email }}
                </a>
                <div class="contact__phone">
                    +1 (929) 400-3210
                </div>
                <button type="button" class="contact__btn js-contact-btn">
                    Send Message
                </button>
            </div>
        </div>
    </div>
    <div class="copyrights">
        &copy; 2011-{{ date('Y') }} {{ $title_legal }}. All rights reserved.
    </div>
    <div class="contact-modal js-contact-modal hidden">
        <form action="/api/contact-us" method="POST" class="contact-modal__box">
            <div class="contact-modal__header">
                <h3>
                    Contact Us
                </h3>
                <button type="button" class="js-contact-close">
                    <b>&times;</b>
                </button>
            </div>
            <input
                class="contact-modal__name"
                name="name"
                placeholder="Your Name"
            >
            <input
                class="contact-modal__email js-contact-input"
                name="email"
                placeholder="Your Email"
                required
            >
            <textarea
                class="contact-modal__message js-contact-input"
                name="message"
                placeholder="Your Message"
                required
            ></textarea>
            <button type="submit" class="contact-modal__submit js-contact-input">
                SEND
            </button>
            <div class="contact-modal__success js-contact-success hidden"></div>
            <button type="button" class="contact-modal__submit js-contact-close hidden">
                CLOSE
            </button>
        </form>
    </div>
    <script src="{{ mix('build/js/app.js') }}" async defer></script>
</body>
</html>
