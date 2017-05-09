<?php
	/**
	 * @var $field \Ip\Form\Field\Submit
	 */
	//$classes = empty($field->getClasses()) ? 'class="form-control"' : $field->getClassesStr();
	?>

<input <?php echo $field->getAttributesStr($doctype)?> class="form-control <?php echo implode(' ',  $field->getClasses());?>"
	   name="<?php echo escAttr($field->getName()) . '" ' . $field->getValidationAttributesStr($doctype)?> type="<?php echo $type?>"
	   value="<?php echo escAttr($field->getValue()) ?>">