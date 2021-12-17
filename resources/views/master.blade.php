<?php

$canonicalUrl = config('app.url');
$favicon = 'favicon1.png';

$title_wide = 'W E B - O P T';
$title_legal = 'Web-Opt, LLC';
$slogan = 'WEBSITE DEVELOPMENT AND OPTIMIZATION';
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
    <meta name="description" content="@lang($slogan)">
    <meta name="keywords" content="www, web site, design, development, optimization">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="@lang($slogan)">
    <meta name="twitter:card" content="@lang($slogan)">
    <meta name="viewport" content="width=1200">
    <meta name="robots" content="{{ config('view.robots') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('build/css/app.css') }}">
</head>
<body>
    <div class="top-navigation">
        <div class="top-navigation__burger js-burger"></div>
        <div class="top-navigation__desktop">
            @include('components.nav')
        </div>
    </div>
    <div class="mobile-navigation hidden js-mobile-navigation">
        <div class="mobile-navigation__box">
            @include('components.nav')
        </div>
    </div>
    <div id="home" class="header">
        <h1>
            WEB<span>&</span>OPT
        </h1>
        <div class="intro-description">
            {{ $slogan }}
        </div>
    </div>
    <div class="works">
        <div id="work1" class="work criteo">
            <div class="weareglow-holder">
                <h2>Criteo</h2>
                <p class="work-description">{{ $work2 }}</p>
                <a href="https://www.criteo.com/" target="_blank" class="work-link white">
                    www.criteo.com
                </a>
            </div>
        </div>
        <div id="work2" class="work weareglow">
            <div class="weareglow-holder">
                <h2>Glow</h2>
                <p class="work-description">{{ $work1 }}</p>
                <a href="https://weareglow.com/" target="_blank" class="work-link">
                    www.weareglow.com
                </a>
            </div>
        </div>
    </div>
    <div id="contact" class="footer">
        <div class="copyrights">
            &copy; 2011-{{ date('Y') }} {{ $title_legal }}. @lang('All rights reserved').
        </div>
        <div class="weareglow-holder">
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
                <div>
                    <a class="contact-email" href="mailto:{{ $emailGeo }}">
                        {{ $emailGeo }}
                    </a>
                </div>
            </div>
            <div class="personal-contact">
                <div class="contact-name">
                    Julia Oldman
                </div>
                <div class="contact-phone">
                    +1 (984) 833-9300
                </div>
                <div>
                    <a class="contact-email" href="mailto:{{ $emailJulia }}">
                        {{ $emailJulia }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ mix('build/js/app.js') }}" async defer></script>
</body>
</html>
