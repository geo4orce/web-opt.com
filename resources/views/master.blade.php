<?php

$title = 'Web&Opt';
$title_wide = 'W E B - O P T';
$title_legal = 'Web-Opt, LLC';
$slogan = 'Website Development and Optimization';

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home | {{ $title_wide }}</title>
    <meta name="description" content="{{ $slogan }}">
    <meta name="keywords" content="www, web site, design, development, optimization">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="{{ $slogan }}">
    <meta name="twitter:card" content="{{ $slogan }}">
    <meta name="viewport" content="width=1200">
    <meta name="generator" content="Sublime Text">
    <meta name="robots" content="index,follow">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webflow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web-opt.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script src="{{ asset('js/webfont.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    @include('parts.ga')
</head>
<body>
  <div id="section-home" class="w-section section-header">
    <div class="w-row">
      <div class="w-col w-col-6"></div>
      <div class="w-col w-col-6 w-clearfix">
        <div class="top-navigation">

            {{-- works with "#section-xxx", @see public/js/webflow.js:3221 --}}
            <a href="#home" class="top-navigation-link">Home</a>
            <a href="#work" class="top-navigation-link">Work</a>
            <a href="#contact" class="top-navigation-link">Contact</a>

        </div>
      </div>
    </div>
    <div class="w-container">
      <div class="intro-holder">
        <h1 class="intro-title">{{ $title }}</h1>
        <div class="intro-description">{{ $slogan }}</div>
      </div>
    </div>
  </div>
  <div id="section-work" class="w-section section-works">
    <div class="work weareglow">
      <div class="weareglow-holder">
        <h1>Glow</h1>
        <p class="work-description">Award-winning, digital marketing and social media agency based in New York City. Since 1999, GLOW has partnered with high-profile brands and networks to build world-class social and digital campaigns.</p>
        <a href="http://weareglow.com/" target="_blank" class="work-link">www.weareglow.com</a>
      </div>
    </div>
    <div class="work criteo">
      <div class="weareglow-holder">
        <h1>Criteo</h1>
        <p class="work-description">Founded in Paris, Criteo has become a global leader in commerce marketing. Driving this growth: machine-learning technology, data and performance at scale, and measurable ROI for our clients, as well as the ingenuity and spirit worldwide.</p>
        <a href="https://www.criteo.com/" target="_blank" class="work-link white">www.criteo.com</a>
      </div>
    </div>
  </div>
  <div id="section-contact" class="w-section section-footer">
    <div class="copyrights">&copy; 2011-{{ date('Y') }} {{ $title_legal }}. All Rights Reserved.</div>
    <div class="weareglow-holder">
      <h1>Contact</h1>
      <div class="personal-contact">
        <div class="contact-name">Geo Artemenko | New York</div>
        <div class="contact-phone">+1 (929) 400-5006</div>
        <div><a class="contact-email" href="mailto:geo@web-opt.com">geo@web-opt.com</a>
        </div>
      </div>
      <div class="personal-contact">
        <div class="contact-name">Kirill Artemenko | Moscow</div>
        <div class="contact-phone">+7 (919) 993-9240</div>
        <div><a class="contact-email" href="mailto:kirill@artemenko.info">kirill@artemenko.info</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/webflow.js') }}"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>
