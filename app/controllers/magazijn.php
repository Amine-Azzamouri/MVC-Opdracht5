<?php

class Magazijn extends BaseController
{
    private $magazijnModel;

    public function __construct()
    {
        $this->MagazijnModel = $this->model('MagazijnModel');
    }

    public function overzichtMagazijn()
    {
        $result = $this->MagazijnModel->getMagazijnInfo();

          var_dump($result);
        $rows = "";
        foreach ($result as $MagazijnInfo) {
            

            $rows .= "<tr>
                        <td>$MagazijnInfo-> </td>
                        <td>$MagazijnInfo-> </td>
                        <td>$MagazijnInfo-> </td>
                        <td>$MagazijnInfo-> </td>
                        <td>$MagazijnInfo-> </td>            
                        <td>
                            <a href='" . URLROOT . "/instructeur/overzichtvoertuigen/$instructeur->Id'>
                                <i class='bi bi-car-front'></i>
                            </a>
                        </td>            
                      </tr>";
        }
        
        $data = [
            'title' => 'Overzicht Magazijn Jamin',
            'rows' => $rows
        ];

        $this->view('Magazijn/overzichtMagazijn', $data);
    }

   
}