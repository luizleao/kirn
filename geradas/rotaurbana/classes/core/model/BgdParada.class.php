<?php
class BgdParada {
	
	public $id;
	public $comments;
	public $latitude;
	public $longitude;
	public $title;
	
	function __construct($id = NULL, $comments = NULL, $latitude = NULL, $longitude = NULL, $title = NULL){
		$this->id = $id;
		$this->comments = $comments;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->title = $title;
	}

	function __toString(){
		return $this->id;
	}
}