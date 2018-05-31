<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title_wide }}</title>
    <meta name="description" content="{{ $slogan }}">
    <meta name="keywords" content="www, web site, design, development, optimization">
    <meta name="author" content="Geo Artemenko">
    <meta property="og:title" content="{{ $title_wide }}">
    <meta property="og:description" content="{{ $slogan }}">
    <meta name="twitter:card" content="{{ $slogan }}">
    <meta name="viewport" content="width=1200px">
    <meta name="generator" content="Sublime Text">
    <meta name="robots" content="index,follow">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webflow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web-opt.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    @include('parts.ga')
    <script src="{{ asset('js/webfont.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body>
  <div id="section-home" class="w-section section-header">
    <div class="w-row">
      <div class="w-col w-col-6"></div>
      <div class="w-col w-col-6 w-clearfix">
        <div class="top-navigation">
            <a href="#section-home" class="top-navigation-link">Home</a>
            <a href="#section-works" class="top-navigation-link">Work</a>
            <a href="#section-footer" class="top-navigation-link">Contact</a>
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
  <div id="section-works" class="w-section section-works">
    <div class="work weareglow">
      <div class="weareglow-holder">
        <h1>Glow</h1>
        <p class="work-description">Award-winning, digital marketing and social media agency based in New York City. Since 1999, GLOW has partnered with high-profile brands and networks to build world-class social and digital campaigns.</p>
        <a href="http://weareglow.com" target="_blank" class="work-link">www.weareglow.com</a>
      </div>
    </div>
    <div class="work hooklogic">
      <div class="weareglow-holder">
        <h1>HookLogic</h1>
        <p class="work-description">Pioneer of performance marketing for brands, manufacturers and hotels. The company was founded in 2004 and is based in New York, with additional offices in California, United Kingdom and France.</p>
        <a href="http://hooklogic.com" target="_blank" class="work-link white">www.hooklogic.com</a>
      </div>
    </div>
  </div>
  <div id="section-footer" class="w-section section-footer">
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
