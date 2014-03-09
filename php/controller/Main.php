<?php
/*
* Start by Bill Rocha [prbr@ymail.com]
* version 0.1 [ 2014.02.06.16.48.beta ]!
*
*/
class Main {

    function index() {

        return (new View('blog'))->render(false);

    }

    function image(){
        (new Module\Galery\Upload())->images();
    }

    function post(){
        return (new View('post'))->render();
    }

    function ajax(){
    	//exit('teste');
    	file_put_contents(ROOT.'log.txt', print_r($_POST, true));
    	exit(URL);
    }


    function upload(){

    	if(empty($_FILES['file'])) exit();

			$destination = ROOT.'assets/uploads/'. $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);

            (new Neos\Image\Canvas($destination))
                ->resize("800")
                ->text("http://custa.tk", array(
                                           "color" => "#FFFFFF",
                                           "background_color" => "#000000",
                                           "size" => 4,
                                           "x" => "right",
                                           "y" => "bottom"))
                ->save($destination);

			exit(URL_IMG.'uploads/'. $_FILES['file']['name']);
    }

}