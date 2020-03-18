<?php

if (!function_exists('modelResponse')) {
    function modelResponse($success, $message, $data = null)
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }
}

if (!function_exists('middleware')) {
    function middleware($type, $redirect_to)
    {
        switch ($type) {
            case 'auth':
                if (!(isset($_SESSION['user_id']) && isset($_SESSION['logged_in']))) {
                    header('Location: ' . $redirect_to);
                }
                break;
            case 'guest':
                if (isset($_SESSION['user_id']) && isset($_SESSION['logged_in'])) {
                    header('Location: ' . $redirect_to);
                }
                break;
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($redirect_to)
    {
        header('Location: ' . $redirect_to);
        exit;
    }
}

if (!function_exists('get_photo')) {
    function get_photo($id)
    {
        $file_name = ROOT_DIR.'storage/'.md5($id);
        if(file_exists($file_name)){
            return '/storage/'.md5($id);
        }

        return "https://picsum.photos/seed/picsum/150/150";
    }
}
if (!function_exists('language_widget')) {
    function language_widget()
    {
        $lang = $_COOKIE['lang']?:'en_US';
        $next_lang = $lang === 'ru_RU'?'en_US':'ru_RU';
        $lang_name = $next_lang === 'ru_RU'?'Русский':'English';

        return _('Change language to: ')."<a href='/?lang=$next_lang'><span class='label label-primary'>$lang_name</span></a>";
    }
}
