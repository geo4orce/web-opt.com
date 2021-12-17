<?php

$canonicalUrl = config('app.url');
$favicon = 'favicon1.png';

$title_wide = 'W E B - O P T';
$title_legal = 'Web-Opt, LLC';
$slogan = 'Website Development and Optimization';
$slogan_br = 'WEBSITE DEVELOPMENT <br> AND OPTIMIZATION';
$work1 = 'Award-winning, digital marketing and social media agency based in New York City. Since 1999, GLOW has partnered with high-profile brands and networks to build world-class social and digital campaigns.';
$work2 = 'Founded in Paris, Criteo has become a global leader in commerce marketing. Driving this growth: machine-learning technology, data and performance at scale, and measurable ROI for our clients, as well as the ingenuity and spirit worldwide.';
$emailGeo = 'geo@web-opt.com';
$emailJulia = 'julia@web-opt.com';

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Home | {{ $title_wide }}
    </title>
    <meta name="description" content="{{ $slogan }}">
    <meta name="keywords" content="www, web site, design, development, optimization">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="{{ $slogan }}">
    <meta name="twitter:card" content="{{ $slogan }}">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1">
    <meta name="robots" content="{{ config('view.robots') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('build/css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;600&display=swap" rel="stylesheet">
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
            WEB<span>&</span>OPT
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
            <div class="personal-contact">
                <div class="contact-name">
                    Geo Artemenko
                </div>
                <div class="contact-phone">
                    +1 (929) 602-0605
                </div>
                <a href="mailto:{{ $emailGeo }}">
                    {{ $emailGeo }}
                </a>
            </div>
            <div class="personal-contact">
                <div class="contact-name">
                    Julia Oldman
                </div>
                <div class="contact-phone">
                    +1 (984) 833-9300
                </div>
                <a href="mailto:{{ $emailJulia }}">
                    {{ $emailJulia }}
                </a>
            </div>
        </div>
    </div>
    <div class="copyrights">
        &copy; 2011-{{ date('Y') }} {{ $title_legal }}. All rights reserved.
    </div>
    <script type="text/javascript" src="{{ mix('build/js/app.js') }}" async defer></script>
</body>
</html>
