<div class="ip ipsAdminNavbarContainer">
    <div class="ipAdminNavbar ipsAdminNavbar navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <button type="button" class="_toggle ipsAdminMenu navbar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="_menu hidden ipsAdminMenuBlock">
            <div class="_menuHeader">
                <button type="button" class="_toggle navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="img-responsive" data-display="center" src="<?= ipFileUrl('file/logo_white.png')?>" style="height: 35px; margin-left:10px; padding-top: 5px; margin-left: 50% !important; margin-right: -50% !important; transform: translate(-50%, 0);">
                <p class="navbar-text hidden"><?php _e('Menu', 'Ip-admin'); ?></p>
            </div>
            <div class="_menuContainer ipsAdminMenuBlockContainer">
                <nav>
                    <?php
                    $data = array(
                        'items' => $menuItems,
                        'depth' => 1,
                        'attributesStr' => 'class="nav nav-stacked"',
                        'active' => 'active',
                        'selected' => 'selected',
                        'disabled' => 'disabled',
                        'crumb' => 'crumb',
                        'parent' => 'parent',
                        'children' => 'children'
                    );
                    $view = ipView('menu.php', $data);
                    echo $view->render();
                    ?>
                </nav>
            </div>
        </div>

        <?php if ($curModTitle) { ?>
            <ul class="_active nav navbar-nav">
                <li class="ipsItemCurrent">
                    <a href="<?php echo esc($curModUrl); ?>">
                        <?php if ($curModIcon) { ?>
                            <i class="fa fa-fw <?php echo esc($curModIcon); ?>"></i>
                        <?php } ?>
                        <?php echo _e($curModTitle, 'Ip-admin'); ?>
                    </a>
                </li>
            </ul>
        <?php } ?>

        <ul class="_right nav navbar-nav navbar-right">
            <?php foreach ($navbarButtons as $button) { ?>
                <li>
                    <a
                            href="<?php echo empty($button['url']) ? '#' : escAttr($button['url']); ?>"
                            class="<?php echo empty($button['class']) ? '' : escAttr($button['class']); ?>"
                            title="<?php echo empty($button['hint']) ? '' : escAttr($button['hint']); ?>"
                    >
                        <i class="fa <?php echo empty($button['faIcon']) ? '' : escAttr($button['faIcon']); ?>"></i>
                        <?php echo empty($button['text']) ? '' : $button['text']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div class="navbar-center">
            <div class="navbar-center-container">
                <?php foreach ($navbarCenterElements as $el) { echo $el; } ?>
            </div>
        </div>
    </div>
</div>
<?php if ($curModTitle): ?>
<script>
    if(document.title != 'KosbitAdmin'){
        document.title = 'KosbitAdmin :: ' + document.title;
    }
    document.title = document.title + ' :: <?php echo $curModTitle;?>';
</script>
<?php endif;?>