<?php
/**
 * @var Ip\WidgetController[] $widgets
 */
$tmpWidgets = [];
foreach ($widgets as $widget){
    $tmpWidgets[$widget->getTitle()] = $widget;
}

$widgets = $tmpWidgets;

?>
<div class="ip ipsAdminPanelContainer">
    <div class="ipAdminPanel ipsAdminPanel">
        <?php /*
 widget search functionality works but no need to have it now

            <div class="ipsAdminPanelWidgetsSearch clearfix">
                <div class="ipaControls">
                    <span class="ipaArrow"></span>
                    <input type="text" class="ipAdminInput ipaInput ipsInput" value="<?php _e('Search widgets', 'Ip-admin') ?>" />
                    <a href="#" class="ipaButton ipsButton"></a>
                </div>
            </div>
*/ ?>

        <?php if(!$manageableRevision){ ?>
            <div class="_disable">
                <p>
                    <?php echo __('This is a preview of older revision, created at', 'Ip-admin'); ?> <?php echo ipFormatDateTime(strtotime($currentRevision['createdAt']), 'Ip-admin') ?>
                    <a href="#" class="ipsContentPublish"><?php _e('Publish this revision', 'Ip-admin'); ?></a>
                    <a href="#" class="ipsContentSave"><?php _e('Duplicate and edit this revision', 'Ip-admin'); ?></a>
                </p>
            </div>
        <?php } ?>

        <div class="_widgetCategories">

            <?php $catCount = count($widgets); ?>
            <?php if (count($tags) > 2) { ?>
                <?php $active = true; ?>
                <?php $current = 0; ?>
                <?php foreach ($tags as $key => $tag){ ?>
                    <?php if ($current % $categorySplit === 0) { ?>
                        <ul class="_widgetTabSwitches">
                    <?php } // $current % $categorySplit === 0 ?>
                    <li class="_widgetTabSwitch ipsWidgetTag" data-tag="<?php echo escAttr($key) ?>">
                        <a href="#">
                            <?php _e($key, 'Ip-admin') ?>
                        </a>
                    </li>
                    <?php $current++; ?>
                    <?php if ($current % $categorySplit === 0){ ?>
                        </ul>
                    <?php } ?>
                    <?php $active = false; ?>

                <?php } ?>
            <?php } // $catCount > 1 ?>

        </div>
        <div class="_widgets ipsWidgetList">

            <a href="#" class="_scrollButton _left ipsLeft"></a>
            <a href="#" class="_scrollButton _right ipsRight"></a>
            <div class="_container ipsAdminPanelWidgetsContainer">
                <?php $scrollWidth = count($widgets)*(55 + 60 + 2*4); // to keep all elements on one line ?>
                <ul<?php echo ' style="width: '.$scrollWidth.'px;"'; ?>>
                    <?php $i = 0; ksort($widgets);?>
                    <?php foreach ($widgets as $widgetKey => $widget) { ?>
                        <?php if(!in_array($widget->getName(), ['Map', 'Video', 'Form'])):?>
                        <li class="ipsWidgetItem ipsWidgetItem-<?php echo $widget->getName(); echo $i > 14 ? '' : ''?>">
                            <div id="ipAdminWidgetButton-<?php echo $widget->getName(); ?>" class="_button ipsAdminPanelWidgetButton">
                                <a href="#" title="<?php echo escAttr($widget->getTitle()); ?>">
                                    <span class="_title"><span><?php echo esc($widget->getTitle()); ?></span></span>
                                    <img class="_icon" src="<?php echo escAttr($widget->getIcon()) ?>" alt="<?php echo escAttr($widget->getTitle()); ?>" />
                                </a>
                            </div>
                        </li>
                        <?php $i++; endif;?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

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

<script>
    $(document).ready(function(){
        var $scrollable = $('.ipsAdminPanelWidgetsContainer'); // binding object
        $scrollable.removeData("scrollable");
        $scrollable.scrollable({
            item: 'li:not(.hidden)',
            items: 'li', // items are <li> elements; on scroll styles will be added to <ul>
            touch: true,
            keyboard: true
        });
        var scrollableAPI = $scrollable.data('scrollable'); // getting instance API
        var itemWidth = scrollableAPI.getItems().eq(0).outerWidth(true);
        var containerWidth = scrollableAPI.getRoot().width() + 24; // adding left side compensation
        var scrollBy = Math.floor(containerWidth / itemWidth); // define number of items to scroll
        if (scrollBy < 1) {
            scrollBy = 1;
        } // setting the minimum
        $scrollable.siblings('.ipsRight, .ipsLeft').off('click'); // unbind if reinitiating dynamically
        scrollableAPI.begin(); // move to scroller to default position (beginning)
        $scrollable.siblings('.ipsRight').on('click', function (event) {
            event.preventDefault();
            scrollableAPI.move(scrollBy);
        });
        $scrollable.siblings('.ipsLeft').on('click', function (event) {
            event.preventDefault();
            scrollableAPI.move(-scrollBy);
        });
    });
/*
    var activeAjaxConnections = 0;

    $( document ).ajaxSend(function() {
        activeAjaxConnections++;
        function animateloop () {
            if(activeAjaxConnections > 0){
                $("#progressinner").css({marginLeft: "-45%"});
                $("#progressinner").animate({
                    marginLeft: "145%"
                }, 2000, function(){animateloop()});
            }
        }
        $('#ipLoading').modal({
            keyboard: false,
            backdrop: 'static'
        });
        animateloop();
    });

    $( document ).ajaxComplete(function() {
        activeAjaxConnections--;
        if(activeAjaxConnections == 0){
            setTimeout(function () {
                $('#ipLoading').modal('hide');
            }, 300);
        }
    });
    */
</script>
