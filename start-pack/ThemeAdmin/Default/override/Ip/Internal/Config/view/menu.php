<?php
/**
 * This comment block is used just to make IDE suggestions to work
 * @var $items \Ip\Menu\Item[]
 * @var $this \Ip\View
 */
?>
<?php if (!empty($items)){ ?>
<?php if($depth == 1) {
          $attributesStr = 'class="nav navbar-nav"';        
        }
        ?>
<ul <?php echo $attributesStr; ?>><?php
    foreach($items as $menuItem) {
        $css = array();
        $submenu = '';
        $target = '';
        $class = '';
        $dtt = '';
        $caret = '';
        $acss = '';

        if($menuItem->isCurrent()) {
            $css[] = $active;
        } elseif ($menuItem->isInCurrentBreadcrumb()) {
            $css[] =  $crumb;
        }
        
        if(sizeof($menuItem->getChildren()) > 0 && $depth == 1) {
            $css[] = 'dropdown';
            $acss = 'dropdown-toggle';
            $dtt = 'dropdown';
            $caret = 'caret';
        }
        
         
        
        if ($menuItem->isDisabled()) {
            $href = '';
            $css[] = $disabled;
        } else {
            $href = ' href="' . escAttr($menuItem->getUrl()) . '"';
        }

        if ($menuItem->getBlank()) {
            $target = ' target="_blank"';
        }

        if (($menuItem->getChildren()) > 0) {
            $submenuData = array(
                'items' => $menuItem->getChildren(),
                'depth' => $depth + 1,
                'attributesStr' => 'class="dropdown-menu"'
            );
            $submenuData = array_merge($this->getVariables(), $submenuData);
            $submenu = ipView('menu.php', $submenuData)->render();
        }
        

        if (!empty($css)) {
            $class = ' class="'.implode(' ', $css).'"';
        }
        ?>
        <li<?php echo $class; ?>>
        <?php if(!empty($acss)){ ?>
            <a class="<?php echo $acss; ?>" data-toggle="<?php echo $dtt; ?>"  <?php echo $href; ?> <?php echo $target; ?> title="<?php echo escAttr($menuItem->getTitle()); ?>">
                <?php echo esc($menuItem->getTitle()); ?> <b class="<?php echo $caret; ?>"></b>
            </a>
      <?php } else { ?>
        <a class="<?php echo $acss; ?>" data-toggle="<?php echo $dtt; ?>" <?php echo $href; ?><?php echo $target; ?> title="<?php echo escAttr($menuItem->getTitle()); ?>">
                <?php echo esc($menuItem->getTitle()); ?> <b class="<?php echo $caret; ?>"></b>
            </a>
         <?php } ?>
            <?php echo $submenu; ?>
        </li><?php
    } ?>
</ul>
<?php }