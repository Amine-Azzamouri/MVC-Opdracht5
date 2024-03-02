<?php

class Homepage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Opdracht 5 MVC Amine Azzamouri'
        ];
    
        $this->view('Homepage/index', $data);
    }
}