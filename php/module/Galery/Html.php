<?php

namespace Module\Galery;

use Acoustep\Canvas;


class Html{
	
	function getFormImage(array $types){

		return (new Canvas())->width(300)
					         ->height(500)
					         ->image(ROOT.'assets/common/andrew-avatar.png', 
					         		 ['scale'=>'height','x'=>'left','y'=>'bottom'])
					         ->image(ROOT.'assets/common/tilo-avatar.png', 
					         	     ['scale'=>'width','x'=>'50%','y'=>'55%'])
					         ->output(ROOT.'assets/common/test4')
					         ->filetype('png')
					         ->create();	
	}

}