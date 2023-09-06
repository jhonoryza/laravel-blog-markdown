<?php

namespace App\Data;

class Post
{
	public function __construct(
		public $title,
		public $slug,
		public $content,
		public $date,
		public $desc
	) {
		//
	}
}
