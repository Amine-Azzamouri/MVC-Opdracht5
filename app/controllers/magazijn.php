<?php

class Magazijn extends BaseController
{
    private $magazijnModel;

    public function __construct()
    {
        $this->magazijnModel = $this->model('MagazijnModel');
    }

    public function overzichtMagazijn()
    {
        $result = $this->magazijnModel->getMagazijnInfo();

          //var_dump($result);
        $rows = "";
        foreach ($result as $MagazijnInfo) {
            

            $rows .= "<tr>
                        <td>$MagazijnInfo->Barcode</td>
                        <td>$MagazijnInfo->Naam</td>
                        <td>$MagazijnInfo->VerpakkingsEenheid</td>
                        <td>$MagazijnInfo->AantalAanwezig</td>
                        <td>
                            <a href='" . URLROOT . "/Magazijn/overzichtMagazijn/$MagazijnInfo->MagazijnId'>
                                <i class='bi bi-x'></i>
                            </a>
                        </td>
                        <td>
                        <a href='" . URLROOT . "/Magazijn/overzichtMagazijn/$MagazijnInfo->MagazijnId'>
                        <i class='bi bi-question'></i>
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