<?php
/**
 * @var $updateForm \Ip\Form
 */
?>
    <pre>
    {{model |json}}
</pre>
<?php
$attrs = $updateForm->getAttributes();
$nfieldsets = isset($attrs['tfieldsets']) ? count($updateForm->getFieldsets()) - $attrs['tfieldsets'] : count($updateForm->getFieldsets());
if ($nfieldsets > 1): ?>
    <ul class="nav nav-tabs" role="tablist">
        <?php foreach ($updateForm->getFieldsets() as $key => $fieldset): ?>
            <?php if ($fieldset->getAttribute('fieldset') == 'tab'): ?>
                <li class="<?php echo $key == 0 ? 'active' : '' ?>">
                    <a href="#<?php echo escAttr($fieldset->getAttribute('id')) ?>" role="tab"
                       data-toggle="tab">
                        <?php echo esc($fieldset->getLabel()) ?>
                    </a>
                </li>
                <?php $fieldset->setLabel(' '); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php echo $updateForm ?>