<?php


class Sort {

	public $replies;

	public function __construct($r) {
		$this->replies = $r;
	}

	public function cmp($a,$b)
	{
		if ($a->likes == $b->likes) {
        return 0;
    	}
    	return ($a->likes > $b->likes) ? -1 : 1;
	}
	
	public function sortByLikes()
	{
		usort($this->replies, array($this, 'cmp'));
		return $this->replies;
	}
	
}



?>