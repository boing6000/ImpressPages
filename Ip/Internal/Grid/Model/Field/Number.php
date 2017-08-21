<?php

/**
 * @package ImpressPages
 *
 */

namespace Ip\Internal\Grid\Model\Field;

use \Ip\Internal\Grid\Model\Field;


class Number extends Field
{

	public function createField()
	{
		$field = new \Ip\Form\Field\Number(array(
			'label' => $this->label,
			'name' => $this->field,
			'layout' => $this->layout,
			'attributes' => $this->attributes,
            'column' => $this->column,
            'ngIf' => $this->ngIf
		));
		$field->setValue($this->defaultValue);
		return $field;
	}

	public function createData($postData)
	{
		if (isset($postData[$this->field])) {
			return array($this->field => $postData[$this->field]);
		}
		return [];
	}

	public function updateField($curData)
	{
		$field = new \Ip\Form\Field\Number(array(
			'label' => $this->label,
			'name' => $this->field,
			'layout' => $this->layout,
			'attributes' => $this->attributes,
            'column' => $this->column,
            'ngIf' => $this->ngIf
		));
		if (isset($curData[$this->field])){
			$field->setValue($curData[$this->field]);
		}
		return $field;
	}

	public function updateData($postData)
	{
		return array($this->field => $postData[$this->field]);
	}


	public function searchField($searchVariables)
	{
		$field = new \Ip\Form\Field\Number(array(
			'label' => $this->label,
			'name' => $this->field,
			'layout' => $this->layout,
			'attributes' => $this->attributes,
            'column' => $this->column,
            'ngIf' => $this->ngIf
		));
		if (!empty($searchVariables[$this->field])) {
			$field->setValue($searchVariables[$this->field]);
		}
		return $field;
	}

	public function searchQuery($searchVariables)
	{
		if (isset($searchVariables[$this->field]) && $searchVariables[$this->field] !== '') {
			return ' `' . $this->field . '` like ' . ipDb()->getConnection()->quote(
					'%' . $searchVariables[$this->field] . '%'
				) . '';
		}
		return null;
	}

}
