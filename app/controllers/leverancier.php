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
                        </td>
                        <td>
                        <a href='" . URLROOT . "/Leverancier/leverancierDetails/$LeverancierInfo->LeverancierId'>
                            <i class='bi bi-pencil'></i>
                        </a>
                    </td>             
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
                        <a href='" . URLROOT . "/Leverancier/indexLevering/{$geleverdeProductenInfo->LeverancierId}/{$geleverdeProductenInfo->ProductId}'>
                            <i class='bi bi-plus-lg'></i>
                        </a>           
                    </tr>";
            }

            $data = [
                'title' => 'Overzicht geleverde Producten van Jamin',
                'LeverancierNaam' => $result[0]->LeverancierNaam,
                'ContactPersoon' => $result[0]->ContactPersoon,
                'LeverancierNummer' => $result[0]->LeverancierNummer,
                'Mobiel' => $result[0]->Mobiel,
                'rows' => $rows,
            ];

            $this->view('Leverancier/overzichtGeleverdeProducten', $data);
        } else {
            $data = [
                'title' => 'Overzicht geleverde Producten van Jamin',
                'LeverancierNaam' => '',
                'ContactPersoon' => '',
                'LeverancierNummer' => '',
                'Mobiel' => '',
                'rows' => '<tr><td colspan="6">Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin</td></tr>',
            ];

            echo '<script>
            setTimeout(function(){
                window.location.href = "http://www.jamin.nl/Leverancier/overzichtLeverancier"; 
            }, 4000); 
          </script>';

            $this->view('Leverancier/overzichtLeverancier', $data);
        }
    }

    public function indexLevering($Id, $ProductId)
    {
        $result = $this->leverancierModel->getSingleLeverancierInfo($Id);
        //var_dump($result);
        if ($result) {

            $data = [
                'title' => 'Levering Product',
                'LeverancierNaam' => $result[0]->Naam,
                'ContactPersoon' => $result[0]->ContactPersoon,
                'Mobiel' => $result[0]->Mobiel,
                'Id' => $Id,
                'ProductId' => $ProductId  // Add this line to pass the Id to the view

            ];

            $this->view('Leverancier/overzichtLevering', $data);
        } else {
            $data = [
                'title' => 'error',
                'LeverancierNaam' => '',
                'ContactPersoon' => '',
                'Mobiel' => '',
                'Id' => $Id,  // Add this line to pass the Id to the view

                
                
            ];

       //     echo '<script>
       //     setTimeout(function(){
       //         window.location.href = "http://www.jamin.nl/Leverancier/overzichtLeverancier"; 
       //     }, 4000); 
       //   </script>';

            $this->view('Leverancier/overzichtLevering', $data);
        }
    }

    public function updateLevering()
    {

        //var_dump($_POST);
        try {
            $result = $this->leverancierModel->updateLeveringProduct($_POST);
            //var_dump($result);
            header('Location: ' . URLROOT . '/leverancier/geleverdeProducten/' . $_POST['productId'] . '/' . $_POST['productId']);
            // Load the view with the form
            // $this->view('Leverancier/overzichtLevering', $data);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function leverancierDetails($Id)
    {
        $result = $this->leverancierModel->getLeverancierDetails($Id);
        //var_dump($result);
        $rows = "";
        foreach ($result as $leverancierDetails) {
            $rows .= "<tr>
                <td>$leverancierDetails->LeverancierNaam</td>
                <td>$leverancierDetails->ContactPersoon</td>
                <td>$leverancierDetails->LeverancierNummer</td>
                <td>$leverancierDetails->Mobiel</td>
                <td>$leverancierDetails->Straat</td>
                <td>$leverancierDetails->Huisnummer</td>
                <td>$leverancierDetails->Postcode</td>
                <td>$leverancierDetails->Stad</td>           
                </tr>";
        }

            $data = [
            'title' => 'LeverancierDetails',
            'rows' => $rows
            ];

     $this->view('Leverancier/leverancierDetails', $data);

    }

    public function wijzigLeverancierDetails()
    {
        //var_dump($result);
 
            $data = [
            'title' => 'LeverancierDetails',
            ];

     $this->view('Leverancier/wijzigLeverancierDetails', $data);

    }

    public function updateLeverancierDetails()
    {

        var_dump($_POST);
        try {
            $result = $this->leverancierModel->updateLeverancierDetails($_POST);
            var_dump($result);
            header('Location: ' . URLROOT . '/leverancier/wijzigLeverancierDetails/' . $_POST['Id'] );
            // Load the view with the form
            // $this->view('Leverancier/overzichtLevering', $data);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

    
