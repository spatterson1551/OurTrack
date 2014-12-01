<?php
class Validate {
	private $_passed = false,
			$_errors = array(),
			$_db = null;


	//for user-uploaded files for a track
	private $imageLocation;
	private $audioLocation;

	public function __construct() {
		$this->_db = Database::getInstance();
	}

	public function getImageLocation()
	{
		return $this->imageLocation;
	}
	public function getAudioLocation()
	{
		return $this->audioLocation;
	}

	//used to validate the image and audio file of uploaded track
	public function validateFiles($items = array()) {
		$this->_passed = false;
		foreach($items as $item => $rules) {

			foreach($rules as $rule => $rule_value) {

				if($rule === 'required' && empty($_FILES[$item])) {
					$this->addError("{$item} is required");
				} else  if(!empty($_FILES[$item])){

					switch($rule) {
						case 'trackvalidation';
							//make sure audio files were uploaded successfully
							if($_FILES['file1']["error"] != UPLOAD_ERR_OK) { //error
								$this->addError("Problem uploading track audio");
							}
							//make sure audio files aren't too big
							$maxFileSize = 150*MB; //150mb
							if($_FILES['file1']["size"] > $maxFileSize) { //error
								$this->addError("Audio file is too large");
							}
							//make sure valid audio file type
							$validExt = array("wav", "mp3", "aac");
							$validMime = array("audio/wav", "audio/mp3", "audio/aac", "audio/mpeg", "audio/x-wav");
							$tmp = explode(".", $_FILES['file1']["name"]);
							$extension = end($tmp);
							if(in_array($_FILES['file1']["type"], $validMime) && 
								in_array($extension, $validExt))
							{
								//good
							}
							else
							{
								$this->addError("Audio file is invalid type");
							}
							//Finally move the file to trackaudio folder
							$fileToMove = $_FILES['file1']['tmp_name'];
							$this->audioLocation = uniqid() . '.' . $extension;
							$audioLocationFolder = "./trackaudio/" . $this->audioLocation;
							if(move_uploaded_file($fileToMove, $audioLocationFolder)) {
								//good
							}
							else {
								$this->addError("Unable to move file to trackaudio folder");
							}
						break;
						case 'imagevalidation';
							//make sure image file was uploaded successfully
							if($_FILES['file2']["error"] != UPLOAD_ERR_OK) { //error
								$this->addError("Problem uploading track image");
							}
							//make sure image files aren't too big
							$maxFileSize = 2*MB; //2mb
							if($_FILES['file2']["size"] > $maxFileSize) { //error
								$this->addError("Image is too large");
							}
							//make sure valid image file type
							$validExt = array("jpg", "png");
							$validMime = array("image/jpeg", "image/jpg", "image/png");
							$tmp = explode(".", $_FILES['file2']["name"]);
							$extension = end($tmp);
							if(in_array($_FILES['file2']["type"], $validMime) && 
								in_array($extension, $validExt))
							{
								//good
							}
							else
							{
								$this->addError("Image is invalid type");
							}
							//Finally move the file to trackimages folder
							$fileToMove = $_FILES['file2']['tmp_name'];
							$this->imageLocation = uniqid() . '.' . $extension;
							$imageLocationFolder = "./trackimages/" . $this->imageLocation;
							if(move_uploaded_file($fileToMove, $imageLocationFolder)) {
								//good
							}
							else {
								$this->addError("Unable to move file to trackimages folder");
							}
						break;
					}
				}
			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	public function check($source, $items = array()) {
		$this->_passed = false;
		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				
				$value = trim($source[$item]);
				$item = escape($item);
				
				if($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else  if(!empty($value)){
					switch($rule) {
						case 'min';
							if(strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'max';
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} cannot be more than {$rule_value} characters.");
							}
						break;
						case 'matches';
							if($value != $source[$rule_value]) {
								$this->addError("passwords must match");
							}
						break;
						case 'unique';
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count()) {
								$this->addError("An account with this {$item} already exists");
							}
						break;
						case 'category';
							if($value === 'Select A Category') {
								$this->addError("You must choose a category");
							}
						break;
					}

				}

			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	public function addError($error) {
		$this->_errors[] = $error; 
	}

	public function errors() {
		return $this ->_errors;
	}

	public function passed() {
		return $this ->_passed;
	}
}
?>