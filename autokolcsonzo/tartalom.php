<?php

switch ($menu) {
    case 'orokbefogadasUser':
        require_once './pages/autokolcsonzesUser.php';
        break;
    case 'logout':
        require_once './pages/logout.php';
        break;
    case 'orokbefogadasGuest':
        require_once './pages/autokolcsonzesGuest.php';
        break;
    case 'login':
        require_once './pages/login.php';
        break;
    case 'regisztracio':
        require_once './pages/regisztracio.php';
        break;
    case 'rolunk':
        require_once './pages/rolunk.php';
        break;
    case 'home':
        if ($id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)) {
            require_once './pages/kivalasztottAuto.php';
        } else {
            require_once './pages/home.php';
        }
        break;
    default:
        require_once './pages/home.php';
        break;
}