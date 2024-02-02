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
                            <a href='" . URLROOT . "/Magazijn/overzichtLeverancier/$MagazijnInfo->MagazijnId'>
                                <i class='bi bi-truck'></i>
                            </a>
                        </td>
                        <td>
                        <a href='" . URLROOT . "/Magazijn/InfoAllergie/$MagazijnInfo->MagazijnId'>
                        <i class='bi bi-question-square-fill'></i></a>
                    
                    </td>             
                      </tr>";
        }
        
        $data = [
            'title' => 'Overzicht Magazijn Jamin',
            'rows' => $rows
        ];

        $this->view('Magazijn/overzichtMagazijn', $data);
    }

    public function InfoAllergie($Id = NULL) {

        $result = $this->magazijnModel->getAlergieInfo($Id);
        // echo $Id;exit();
        //var_dump($result);
    
        $rows = "";
    
        if ($result) {
            foreach ($result as $AlergieInfo) {
                $rows .= "<tr>
                            <td>$AlergieInfo->Snoep</td>
                            <td>$AlergieInfo->AllergeenOmschrijving</td>
                        </tr>";
            }
            $data = [
                'title' => 'Overzicht Info Allergieen',
                'barcode' => $AlergieInfo->Barcode,
                'name' => $AlergieInfo->Snoep,
                'rows' => $rows,
            ];
        } else {
            $data = [
                'title' => 'In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken',
                'barcode' => '', 
                'name' => '',    
                'rows' => $rows,
            ];

            echo '<script>
            setTimeout(function(){
                window.location.href = "http://www.jamin.nl/Magazijn/overzichtMagazijn"; 
            }, 4000); 
          </script>';
        }
    
        $this->view('Magazijn/overzichtAlergie', $data);
    }

    public function overzichtLeverancier($Id = NULL) {
        $result = $this->magazijnModel->getLeverancierInfo($Id);
        $rows = "";
    
        if ($result) {
            if ($result[0]->AantalAanwezig === null) 
            {
                $data = [
                    'title' => 'Leverings Informatie',
                    'barcode' => '', 
                    'name' => '',    
                    'rows' => '<tr><td colspan="4">Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is ' . $result[0]->DatumEerstVolgendeLevering .'</td></tr>'
                ];

                echo '<script>
                setTimeout(function(){
                    window.location.href = "http://www.jamin.nl/Magazijn/overzichtMagazijn"; 
                }, 4000); 
              </script>';
            } else {
            foreach ($result as $LeverancierInfo) {
                $rows .= "<tr>
                            <td>$LeverancierInfo->ProductNaam</td>
                            <td>$LeverancierInfo->DatumLevering</td>
                            <td>$LeverancierInfo->AantalAanwezig</td>
                            <td>$LeverancierInfo->DatumEerstVolgendeLevering</td>
                        </tr>";
            }
    
            $data = [
                'title' => 'Leverings Informatie',
                'NaamLeverancier' => $LeverancierInfo->LeverancierNaam,
                'ContactPersoon leverancier' => $LeverancierInfo->LeverancierContactPersoon,
                'LeverancierNummer' => $LeverancierInfo->LeverancierNummer,
                'Mobiel' => $LeverancierInfo->LeverancierMobiel,
                'rows' => $rows,
            ]; }

            $this->view('Magazijn/overzichtLeverancier', $data);
    
            return; 
        }
    
        $this->view('Magazijn/overzichtLeverancier', $data);
    }
    
    
    
    
   
}