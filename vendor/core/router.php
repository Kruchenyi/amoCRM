<?php

require CONFIG . '/routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

if (array_key_exists($uri, $routes)) {
    require CONTROLLERS . "/$routes[$uri]";
}
