<?php

class Allergenen extends BaseController
{
    private $AllergenenModel; 

    public function __construct()
    {
        $this->AllergenenModel = $this->model('AllergenenModel');
    }

    public function index()
    {
        $selectedAllergie = $_POST['selectedAllergen'] ?? null;


        if ($selectedAllergie) {
            $result = $this->AllergenenModel->getAllergenen($selectedAllergie);
        } else {
            $result = $this->AllergenenModel->getALLAllergenen();
        }

        //var_dump($result);
        $rows = "";
        foreach ($result as $AllergenenInfo) {
            

            $rows .= "<tr>
                        <td>$AllergenenInfo->naamproduct</td>
                        <td>$AllergenenInfo->naamallergenen</td>
                        <td>$AllergenenInfo->omschrijving</td>
                        <td>$AllergenenInfo->aantalaanwezig</td>
                        <td>
                            <a href='" . URLROOT . "/Allergenen/allergieinfoindex/$AllergenenInfo->product_id'>
                                <i class='bi bi-question-lg'></i>
                            </a>
                        </td>
                      </tr>";
        }
        
        $data = [
            'title' => 'Overzicht Allergenen',
            'rows' => $rows
        ];

        $this->view('Allergenen/index', $data);
    } 

    public function allergieinfoindex($Id)
    {
        $result = $this->AllergenenModel->getAllergieInfoIndex($Id);
        //var_dump($result);
        $rows = "";
        if (!empty($result)) {
            foreach ($result as $AllergenenInfo) {
                if (!empty($AllergenenInfo->mobiel) && !empty($AllergenenInfo->stad) && !empty($AllergenenInfo->straatnaam) && !empty($AllergenenInfo->huisnummer)) {
                    $rows .= "<tr>
                                <td>$AllergenenInfo->naamleverancier</td>
                                <td>$AllergenenInfo->contactpersoon</td>
                                <td>$AllergenenInfo->mobiel</td>
                                <td>$AllergenenInfo->stad</td>
                                <td>$AllergenenInfo->straatnaam</td>
                                <td>$AllergenenInfo->huisnummer</td>
                              </tr>";
                } else {
                    //$rows .= "<tr><td colspan='3'>Er zijn geen adresgegevens bekend</td></tr>";
                    $rows .= "<tr>
                                <td>$AllergenenInfo->naamleverancier</td>
                                <td>$AllergenenInfo->contactpersoon</td>
                                <td>$AllergenenInfo->mobiel</td>
                                <td colspan='3'>Er zijn geen adresgegevens bekend</td>
                               
                              </tr>";
                
                }
            }
        
        $data = [
            'title' => 'Overzicht Allergenen',
            'rows' => $rows
        ];

        $this->view('Allergenen/allergieinfo', $data);
    }
}
}
    
