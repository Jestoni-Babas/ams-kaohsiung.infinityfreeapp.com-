<?php
include 'controllers/isLoggedIn.php';
?>
<h1>
   <?php
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));

        echo ucfirst($segments[1]) ?? null;
    ?>
</h1>