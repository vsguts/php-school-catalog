<html>
<head>
    <title><?= $title ?? 'Title' ?></title>
</head>
<body>
<div style="max-width: 960px; margin: 0 auto;">
    <h5>Header</h5>
    <nav style="display: flex; border: 1px solid brown;margin: 20px 0;border-radius: 5px">
        <a style="padding: 5px;" href="/">Home</a>
        <a style="padding: 5px;" href="/forms">Forms</a>
    </nav>

    <?= $content ?>


    <br />
    <h5>Footer</h5>

</div>
</body>
</html>
