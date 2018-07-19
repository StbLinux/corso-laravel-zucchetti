<?php

function switchLanguageInUrlWith($locale)
{
    return preg_replace('/' . app()->getLocale(). '/i', $locale, request()->url(), 1);
}
