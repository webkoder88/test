<?php
/**
 * Verifies if the given $locale is supported in the project
 * @param string $locale
 * @return bool
 */
function valid($locale) {
    return in_array($locale, ['en_US', 'en', 'ru_RU', 'ru']);
}

$lang = 'en_US';

if (isset($_GET['lang']) && valid($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang);
} elseif (isset($_COOKIE['lang']) && valid($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    array_walk($langs, function (&$lang) { $lang = strtr(strtok($lang, ';'), ['-' => '_']); });
    foreach ($langs as $browser_lang) {
        if (valid($browser_lang)) {
            $lang = $browser_lang;
            break;
        }
    }
}

putenv("LANG=$lang");

setlocale(LC_ALL, $lang);
bindtextdomain('main', ROOT_DIR.'locales');
bind_textdomain_codeset('main', 'UTF-8');
textdomain('main');
