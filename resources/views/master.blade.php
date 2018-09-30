<?php

$locale = app()->isLocale('en') ? '' : '/ru';
$canonicalUrl = config('app.url') . $locale;

$h1 = 'Web&Opt';
$title_wide = 'W E B - O P T';
$title_legal = 'Web-Opt, LLC';
$slogan = 'Website Development and Optimization';
$work1 = __('work1');
$work2 = __('work2');

?>
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8" />
    <title>Home | {{ $title_wide }}</title>
    <meta name="description" content="@lang($slogan)">
    <meta name="keywords" content="www, web site, design, development, optimization">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="@lang($slogan)">
    <meta name="twitter:card" content="@lang($slogan)">
    <meta name="viewport" content="width=1200">
    <meta name="robots" content="{{ config('view.robots') }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" type="text/css" href="{{ elixir('build/css/app.css', '') }}">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script type="text/javascript" src="{{ elixir('build/js/head.js', '') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/modernizr.js') }}"></script>
</head>
<body>
<div id="section-home" class="w-section section-header">
    <div class="w-row">
        <div class="w-col w-col-6">
            @include('components.lang')
        </div>
        <div class="w-col w-col-6 w-clearfix">
            <div class="top-navigation">

                {{-- works with "#section-xxx", @see public/js/webflow.js:3221 --}}
                <a href="#home" class="top-navigation-link">@lang('Home')</a>
                <a href="#work1" class="top-navigation-link">@lang('Work') 1</a>
                <a href="#work2" class="top-navigation-link">@lang('Work') 2</a>
                <a href="#contact" class="top-navigation-link">@lang('Contact')</a>

            </div>
        </div>
    </div>
    <div class="w-container">
        <div class="intro-holder">
            <h1 class="intro-title">{{ $h1 }}</h1>
            <div class="intro-description">@lang($slogan)</div>
        </div>
    </div>
</div>
<div class="w-section section-works">
    <div id="section-work1" class="work weareglow">
        <div class="weareglow-holder">
            <h2>Glow</h2>
            <p class="work-description">{{ $work1 }}</p>
            <a href="http://weareglow.com/" target="_blank" class="work-link">www.weareglow.com</a>
        </div>
    </div>
    <div id="section-work2" class="work criteo">
        <div class="weareglow-holder">
            <h2>Criteo</h2>
            <p class="work-description">{{ $work2 }}</p>
            <a href="https://www.criteo.com/" target="_blank" class="work-link white">www.criteo.com</a>
        </div>
    </div>
</div>
<div id="section-contact" class="w-section section-footer">
    <div class="copyrights">&copy; 2011-{{ date('Y') }} {{ $title_legal }}. @lang('All rights reserved').</div>
    <div class="weareglow-holder">
        <h2>@lang('Contact')</h2>
        <div class="personal-contact">
            <div class="contact-name">
                @lang('Geo Artemenko | New York')
            </div>
            <div class="contact-phone">
                +1 (929) 400-5006
            </div>
            <div>
                <a class="contact-email" href="mailto:geo@web-opt.com">geo@web-opt.com</a>
            </div>
        </div>
        <div class="personal-contact">
            <div class="contact-name">
                @lang('Kirill Artemenko | Moscow')
            </div>
            <div class="contact-phone">
                +7 (919) 993-9240
            </div>
            <div>
                <a class="contact-email" href="mailto:kirill@artemenko.ru">kirill@artemenko.ru</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ elixir('build/js/foot.js', '') }}"></script>
<!--[if lte IE 9]><script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>
