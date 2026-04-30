<div class="d-flex justify-content-between align-items-center w-100">
    <button id="burger">
            <div></div>
            <div></div>
            <div></div>
        </button>
    <h4 class="m-0">
        <span class="text-warning">MCGI AMS</span> 
        <?php
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $segments = explode('/', trim($path, '/'));

            $text = $segments[1] ?? null;

            if ($text !== null) {

                if (strpos($text, '_') !== false) {
                    $parts = explode('_', $text);
                    $parts = array_reverse($parts);
                    $text = implode(' ', $parts);
                }

                $text_css = ucfirst(strtolower($text));
                echo $text_css;
            }
        ?>

    </h4>

    <a href="logout" class="a_logout">
        <span class="glyphicon glyphicon-log-out text-danger"></span> Log out 
    </a>
</div>