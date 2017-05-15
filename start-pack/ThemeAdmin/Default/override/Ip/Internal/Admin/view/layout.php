<?php echo ipDoctypeDeclaration(); ?>
<html<?php echo ipHtmlAttributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosbitAdmin</title>
    <?php ipAddCss('Ip/Internal/Core/assets/admin/admin.css'); ?>
    <?php ipAddCss(ipAdminThemeUrl('admin.css')); ?>
    <?php ipAddCss(ipFileUrl('ThemeAdmin/syntax/prism.css')); ?>

    <?php echo ipHead(); ?>
</head>
<body class="ip ipAdminBody">
<?php if (!empty($submenu)) { ?>
    <div class="ipAdminSubmenu">
        <?php echo ipSlot('menu', $submenu); ?>
    </div>
<?php } ?>

<?php if (empty($removeAdminContentWrapper)) { ?>
<div class="ipsAdminAutoHeight ipAdminContentWrapper clearfix<?php if (!empty($submenu)) { ?> _hasSubmenu<?php } ?>">
    <?php } ?>

    <?php echo ipBlock('main'); ?>

    <?php if (empty($removeAdminContentWrapper)) { ?>
</div>
<?php } ?>

<div class="ip">
    <div id="ipLoading" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php _e('Aguarde', 'Ip-admin'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%" id="progressinner">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ipAddJs(ipFileUrl('ThemeAdmin/syntax/highlight.pack.js')); ?>
<?php ipAddJs(ipFileUrl('ThemeAdmin/syntax/prism.js')); ?>
<?php echo ipJs(); ?>
</body>
</html>
