<?php

    namespace App\Controllers;

class IndexController extends BaseController
{
    public function IndexAction()
    {
        $data = [];

        $this->renderHTML('../app/views/index_view.php', $data);
    }
}
?>