<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KosbitAdmin</title>
    <link rel="stylesheet" href="<?php echo ipFileUrl('Ip/Internal/Core/assets/admin/admin.css'); ?>">
    <link rel="stylesheet" href="<?php echo ipFileUrl('Ip/Internal/Admin/assets/login.css'); ?>">
    <link rel="shortcut icon" href="<?php echo ipFileUrl('favicon.ico'); ?>">

    <style>
        .pswp{
            display: none;
        }
    </style>
</head>
<body>


<a href="http://www.kosbit.com.br/" class="logo" target="_blank">
    <img class="img-responsive" style="height: 80px;" src="<?php echo ipFileUrl('file/logo.png'); ?>"></a>
<div class="ip languageSelect">
    <?php echo $languageSelectForm->render(); ?>
</div>
<div class="verticalAlign"></div>
<div class="login">
    <?php echo $content; ?>
</div>
<div class="loginFooter">Copyright 2016-<?php echo date("Y"); ?> by <a href="http://www.kosbit.com.br/">Kosbit</a></div>
<?php echo ipJs(); ?>
</body>
</html>
