<?php

/**
 * @var bool $amp AMP or not (optional)
 */

$amp = empty($amp) ? '' : '-amp';

?>

@if(app()->isLocale('en'))
    <a href="{{ route('ru-home' . $amp) }}" class="top-navigation-link">Ru</a>
@else
    <a href="{{ route('home' . $amp) }}" class="top-navigation-link">En</a>
@endif
