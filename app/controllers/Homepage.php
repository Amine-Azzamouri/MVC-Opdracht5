<?php

class Homepage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Opdracht 8 MVC Amine Azzamouri'
        ];
    
        $this->view('Homepage/index', $data);
    }
}