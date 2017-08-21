<?php if (isset($images) && is_array($images)) { ?>
<div class="_container">

    <div class="<?php echo ipIsManagementState() ? '' : 'justified-gallery';?> ipsItem ">
        <?php foreach ($images as $imageKey => $image) { ?>
        <a class="<?php echo ipIsManagementState() ? '_item' : '';?>"
            <?php if ($image['type'] == 'lightbox' && !ipIsManagementState()) { ?>
                rel="lightbox"
                href="<?php echo escAttr($image['imageBig']); ?>"
            <?php } ?>
            <?php if ($image['type'] == 'link') { ?>
                href="<?php echo escAttr($image['url']); ?>"
                <?php echo $image['blank'] ? ' target="_blank" ' : ''; ?>
                <?php echo $image['nofollow'] ? ' rel="nofollow" ' : ''; ?>
            <?php } ?>
            class="_link"
            title="<?php echo esc($image['title']); ?>"
            data-description="<?php echo isset($image['description']) ? escAttr($image['description']) : ''; ?>"
            >
            <img class="_image ipsImage"
                 src="<?php echo escAttr($image['imageSmall']); ?>"
                 data-original-src="<?php echo escAttr($image['imageBig']); ?>"
                 data-original-src-width="<?php echo escAttr($image['sizes'][0]) ?>"
                 data-original-src-height="<?php echo escAttr($image['sizes'][1]) ?>"
                 alt="<?php echo escAttr($image['title']); ?>" />
        </a>
        <?php } ?>
    </div>

</div>
<?php } ?>
