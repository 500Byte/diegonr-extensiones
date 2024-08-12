<?php
// Generar token utilizando MD5
function diego_nav_generate_token($password) {
    return md5($password . 'nana'); // Puedes cambiar 'nana' a cualquier otra clave secreta
}
