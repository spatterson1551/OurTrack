<?php

class Tag {

	public $id;
	public $name;

	public function __toString() {
		echo '<div class="tag">'.$this->name.'</div>';
	}
}




?>