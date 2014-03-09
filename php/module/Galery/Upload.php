<?php

namespace Module\Galery;
use o;
use View;
use Neos\Data\Conn as DB;
use Acoustep\Canvas;


class Upload{
	
	function images(){

		$html = (new Html())->getFormImage(['jpg','png']);

	}

}
