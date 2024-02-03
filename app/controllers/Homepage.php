<?php

class Homepage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Opdracht 5 MVC'
        ];
    
        $this->view('Homepage/index', $data);
    }
}