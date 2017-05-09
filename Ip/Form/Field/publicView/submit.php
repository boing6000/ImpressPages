<?php
	/**
	 * @var $field \Ip\Form\Field\Submit
	 */
	$classes = empty($field->getClasses()) ? 'class="btn btn-default"' : $field->getClassesStr();
?>

<button <?php echo $field->getAttributesStr( $doctype ) ?> <?php echo $classes ?>
        name="<?php echo htmlspecialchars( $field->getName() ) . $field->getValidationAttributesStr( $doctype ) ?>"
        type="submit">
	<?php echo htmlspecialchars( $field->getValue() )?>
</button>
