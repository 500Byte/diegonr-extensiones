<?php

function diego_nav_validate_password($password) {
    $stored_password = get_option('diego_nav_password');
    return $password === $stored_password;
}

function diego_nav_validate_token($token) {
    $stored_token = get_option('diego_nav_token');
    return $token === $stored_token;
}

function diego_nav_handle_login() {
    $password = $_POST['password'] ?? null;
    $redirect_to = $_POST['redirect_to'] ?? home_url();
    $success = false;

    if ($password && diego_nav_validate_password($password)) {
        $_SESSION['authenticated'] = true;
        setcookie('diego_nav_token', get_option('diego_nav_token'), time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
        $success = true;
        wp_redirect($redirect_to);
    } else {
        wp_redirect(home_url('ingreso?error=1'));
    }

    diego_nav_log_login_attempt($success, $redirect_to); // Registrar el intento de inicio de sesión
    exit;
}

add_action('admin_post_diego_nav_login', 'diego_nav_handle_login');
add_action('admin_post_nopriv_diego_nav_login', 'diego_nav_handle_login');

function diego_nav_check_authentication() {
    $token = $_GET['token'] ?? null;
    $page_slug = $_SERVER['REQUEST_URI'];
    
    if ($token && diego_nav_validate_token($token)) {
        $_SESSION['authenticated'] = true;
        setcookie('diego_nav_token', $token, time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
        diego_nav_log_login_attempt(true, $page_slug); // Registrar el intento de inicio de sesión exitoso por token
        return;
    } elseif (isset($_COOKIE['diego_nav_token']) && diego_nav_validate_token($_COOKIE['diego_nav_token'])) {
        $_SESSION['authenticated'] = true;
        diego_nav_log_login_attempt(true, $page_slug); // Registrar el intento de inicio de sesión exitoso por cookie
        return;
    }

    if (!is_page('ingreso') && !isset($_SESSION['authenticated'])) {
        wp_redirect(home_url('ingreso?redirect_to=' . urlencode($_SERVER['REQUEST_URI'])));
        diego_nav_log_login_attempt(false, $page_slug); // Registrar el intento de inicio de sesión fallido
        exit;
    }
}

add_action('template_redirect', 'diego_nav_check_authentication');
?>
