<?php

class Tag {

	public $id;
	public $name;

	public function __toString() {
		return '<div class="tag">'.$this->name.'</div>';
	}
}




?>