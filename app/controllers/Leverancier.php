<?php

class Leverancier extends Controller
{
    //properties
    private $LeverancierModel;

    // Dit is de constructor van de controller
    public function __construct()
    {
        $this->LeverancierModel = $this->model('LeverancierModel');
    }

    public function index()
    {
        $Leveranciers = $this->LeverancierModel->getLeveranciers();
        // var_dump($Leveranciers);exit();

        $rows = '';

        foreach ($Leveranciers as $items) {
            $rows .= "<tr>
                        <td>$items->Naam</td>
                        <td>$items->Contactpersoon</td>
                        <td>$items->LeverancierNummer</td>
                        <td>$items->Mobiel</td>
                        <td>$items->product_count</td>
                        <td>
                            <a href='" . URLROOT . "/Leverancier/toonproduct/$items->Id'><img src='" . URLROOT . "/img/bx-package.svg' alt='Info'></a>
                        </td>
                      </tr>";
        }

        $data = [
            'title' => "<h2>Overzicht Leveranciers</h2>",
            'rows' => $rows,
        ];
        $this->view('Leverancier/index', $data);
    }

    public function toonproduct($id)
    {

        $product = $this->LeverancierModel->getLeverancierById($id);

        $toonproducts = $this->LeverancierModel->getToonproducts($id);

        $rows = '';
        if (empty($toonproducts)) {
            $message = "Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin";

            $rows .= "<tr>
                            <td colspan='5'>$message</td>
                        </tr>";
            header("Refresh:3; url=http://magazijnjamin.nl/Leverancier/index");
        } else {
            foreach ($toonproducts as $items) {

                if (empty($items->AantalAanwezig)) {
                    $AantalAanwezig = "geen";
                } else {
                    $AantalAanwezig = $items->AantalAanwezig;
                }

                // Ternary operator verkortere versie van hierboven ^
                // $AantalAanwezig = (empty($items->AantalAanwezig)) ? 'Geen': $items->AantalAanwezig;
                $rows .= "<tr>
                                <td>$items->Naam</td>
                                <td>$AantalAanwezig</td>
                                <td>$items->VerpakkingsEenheid</td>
                                <td>$items->DatumLevering</td>
                                <td>
                                    <a href='" . URLROOT . "/Leverancier/updateproduct/$items->Id'><img src='" . URLROOT . "/img/bx-plus-medical.svg' alt='Info'></a>
                                </td>
                            </tr>";
            }
        }

        $data = [
            'title' => "<h2>Geleverde producten</h2>",
            'rows' => $rows,
            'leveranciernaam' => $product->Naam,
            'ContactPersoon' => $product->ContactPersoon,
            'LeverancierNummer' => $product->LeverancierNummer,
            'Mobiel' => $product->Mobiel,
        ];
        $this->view('Leverancier/toonproduct', $data);
    }

  public function updateproduct($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $aantalEenheden = $_POST['aantal_eenheden'];
        $this->LeverancierModel->updateAantalAanwezig($id, $aantalEenheden);
        $this->LeverancierModel->updateDatumLaatsteLevering($id);

        // Fetch the updated leverancier details
        $leverancier = $this->LeverancierModel->leveringProduct($id);

        $data = [
            'title' => "<h2>Levering product</h2>",
            'Naam' => $leverancier->Naam,
            'ContactPersoon' => $leverancier->Contactpersoon,
            'Mobiel' => $leverancier->Mobiel,
            'id' => $id,
        ];
        $this->view('Leverancier/updateproduct', $data);
    } else {
        // Display the update form
        $leverancier = $this->LeverancierModel->leveringProduct($id);
        $data = [
            'title' => "<h2>Levering product</h2>",
            'Naam' => $leverancier->Naam,
            'ContactPersoon' => $leverancier->Contactpersoon,
            'Mobiel' => $leverancier->Mobiel,
            'id' => $id,
        ];
        $this->view('Leverancier/updateproduct', $data);
    }
}





}