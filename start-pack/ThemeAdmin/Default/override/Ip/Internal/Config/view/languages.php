<?php
/** @var Ip\Language $language */
/** @var Ip\Language $currentLang */
$currentLang = ipContent()->getCurrentLanguage();
?>
<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
        <i class="flag-icon flag-icon-<?php echo strtolower(esc($currentLang->getAbbreviation())); ?>"></i>
        <?php echo $currentLang->getTitle();?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <?php foreach ($languages as $key => $language): ?>
        <li class="dropdown-header">
            <a title="<?php echo escAttr($language->getTitle()); ?>" href="<?php echo escAttr($language->getLink()); ?>">
                <i class="flag-icon flag-icon-<?php echo strtolower(esc($language->getAbbreviation())); ?>"></i>
                <?php echo esc($language->getTitle()); ?>
            </a>
        </li>
        <?php endforeach;?>
    </ul>
</div>
