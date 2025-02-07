<?php
 namespace App\Controllers;

 /**
  * Summary of IndexController
  */
 class IndexController extends BaseController
 {
    public function IndexAction()
    {
       $data = array('message' => 'Hola mundo');
       $this->renderHTML('../app/views/index_view.php',$data);
    }

    public function saludaAction($request){
        $nombre = explode("/", $request);
        $nombre = end($nombre);
        $data = array('message' => "Hola " . $nombre);
        $this -> renderHTML('../app/views/saluda_view.php', $data);
    }
 }
