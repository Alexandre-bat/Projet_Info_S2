<?php
    //securite pour ne pas pouvoir trouver les jsons par url
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (str_starts_with($uri, '/json/')) {
        http_response_code(403);
        exit('Accès interdit');
    }
    $chemin = __DIR__ . $uri;
    if ($uri !== '/' && file_exists($chemin)) {
        return false;
    }
    require __DIR__ . '/Accueil.php';
?>