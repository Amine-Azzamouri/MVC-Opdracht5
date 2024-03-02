<?php

class Leverancier extends BaseController
{
    private $leverancierModel; 

    public function __construct()
    {
        $this->leverancierModel = $this->model('leverancierModel');
    }

    public function index()
    {
        $result = $this->leverancierModel->getLeverancierInfo();

        //var_dump($result);
        $rows = "";
        foreach ($result as $LeverancierInfo) {
            

            $rows .= "<tr>
                        <td>$LeverancierInfo->LeverancierNaam</td>
                        <td>$LeverancierInfo->ContactPersoon</td>
                        <td>$LeverancierInfo->LeverancierNummer</td>
                        <td>$LeverancierInfo->Mobiel</td>
                        <td>$LeverancierInfo->AantalVerschillendeProducten</td>
                        <td>
                            <a href='" . URLROOT . "/Leverancier/geleverdeProducten/$LeverancierInfo->LeverancierId'>
                                <i class='bi bi-box'></i>
                            </a>           
                      </tr>";
        }
        
        $data = [
            'title' => 'Overzicht Leveranciers van Jamin',
            'rows' => $rows
        ];

        $this->view('Leverancier/overzichtLeverancier', $data);
    } 
    
    public function geleverdeProducten($Id)
    {
        $result = $this->leverancierModel->getGeleverdeProductenInfo($Id);
        //var_dump($result);
        if ($result) {
            $rows = "";
            foreach ($result as $geleverdeProductenInfo) {
                $rows .= "<tr>
                    <td>$geleverdeProductenInfo->NaamProduct</td>
                    <td>$geleverdeProductenInfo->AantalInMagazijn</td>
                    <td>$geleverdeProductenInfo->VerpakkingsEenheid</td>
                    <td>$geleverdeProductenInfo->DatumLevering</td>
                    <td>
                        <a href='" . URLROOT . "/Leverancier/{$geleverdeProductenInfo->ProductId}'>
                            <i class='bi bi-plus-lg'></i>
                        </a>           
                    </tr>";
            }

            $data = [
                'title' => 'Overzicht geleverdeProducten van Jamin',
                'LeverancierNaam' => $result[0]->LeverancierNaam,
                'ContactPersoon' => $result[0]->ContactPersoon,
                'LeverancierNummer' => $result[0]->LeverancierNummer,
                'Mobiel' => $result[0]->Mobiel,
                'rows' => $rows,
            ];

            $this->view('Leverancier/overzichtGeleverdeProducten', $data);
        } else {
            $data = [
                'title' => 'Overzicht geleverdeProducten van Jamin',
                'LeverancierNaam' => '',
                'ContactPersoon' => '',
                'LeverancierNummer' => '',
                'Mobiel' => '',
                'rows' => '<tr><td colspan="6">Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin</td></tr>',
            ];

            echo '<script>
            setTimeout(function(){
                window.location.href = "http://www.jamin.nl/Magazijn/overzichtMagazijn"; 
            }, 4000); 
          </script>';

            $this->view('Leverancier/overzichtLeverancier', $data);
        }
    }
}