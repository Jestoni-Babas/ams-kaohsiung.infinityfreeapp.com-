<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MCGI-AMS' ?></title>
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/app.css" />
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/glyphicons.css" />
    <script src="<?= $base ?>/src/js/bootstrap.min.js"></script>
</head>
<body>

<?= $content ?>
<script>
    const BASE_URL = "<?= $base ?>";
</script>
<script src="<?= $base ?>/src/js/register.js"></script>
<script src="<?= $base ?>/src/js/login.js"></script>
</body>
</html>