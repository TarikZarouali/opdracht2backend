<?php

class Overzichtmagazijn extends Controller
{
    private $OverzichtmagazijnModel;

    public function __construct()
    {
        $this->OverzichtmagazijnModel = $this->model('OverzichtmagazijnModel');
    }

    public function index()
    {
        /**
         * Haal alle instructeurs op uit de model
         */
        $overzichtmagazijns = $this->OverzichtmagazijnModel->getOverzichtmagazijns();

        /**
         * Maak tabelrijen van de opgehaalde data over de overzichtmagazijn
         */
        $rows = '';
        foreach ($overzichtmagazijns as $items) {
            $rows .= "<tr>
                    <td>$items->Barcode</td>
                    <td>$items->Naam</td>
                    <td>$items->Verpakkingseenheid</td>
                    <td>$items->Aantalaanwezig</td>
                    <td>
                      <a href='" . URLROOT . "/overzichtmagazijn/allergeneinfo/$items->ProductId'><img src='" . URLROOT . "/img/bx-x.svg'  style='color:#0e6fec' alt='Info'></a>
                    </td>
                    <td>
                      <a href='" . URLROOT . "/overzichtmagazijn/leverantieInfo/$items->ProductId'><img src='" . URLROOT . "/img/bx-question-mark.svg'  style='color:#0e6fec' alt='Info'></a></td>
                    </td>
                  </tr>";

        }

        $data = ['title' => "<h2>Overzicht magazijn jamin</h2>", 'rows' => $rows];
        $this->view('overzichtmagazijn/index', $data);
    }

    public function allergeneinfo($productId)
    {
        $product = $this->OverzichtmagazijnModel->getProductById($productId);

        $allergeneinfos = $this->OverzichtmagazijnModel->getallergeneinfos($productId);
        // var_dump($allergeneinfos);exit();
        if (empty($allergeneinfos)) {
            $rows = "<tr><td>Geen allergieen</td></tr>";
        } else {
            $rows = '';
            foreach ($allergeneinfos as $items) {
                $rows .= "<tr>
                        <td>$items->Naam</td>
                        <td>$items->Omschrijving</td>
                      </tr>";

            }

        }

        $data = [
            'title' => "<h2>allergeneinformatie</h2>",
            'rows' => $rows,
            'productnaam' => $product->naamproduct,
            'barcode' => $product->Barcode,
        ];
        $this->view('overzichtmagazijn/allergeneinfo', $data);
    }

    public function Leverantieinfo($ProductId)
    {

        $Leverantieinfos = $this->OverzichtmagazijnModel->getLeverantieinfos($ProductId);

        /**
         * Maak tabelrijen van de opgehaalde data over de overzichtmagazijn
         */
        $rows = '';
        foreach ($Leverantieinfos as $items) {
            if ($items->AantalAanwezig == 0) {
                $message = "Er is van dit product op dit moment geen voorraad aanwezig, abdullatif de verwachte eerstvolgende levering is: " . $items->DatumEerstVolgendeLevering;
                header("Refresh:4; url=http://magazijnjamin.nl/overzichtmagazijn/index");
            } else {
                $message = "";
            }
            $rows .= "<tr>
                      <td>$items->ProductNaam</td>
                      <td>" . date_format(date_create($items->DatumLevering), 'd-m-Y') . "</td>
                      <td>$items->Aantal</td>
                      <td>" . date_format(date_create($items->DatumEerstVolgendeLevering), 'd-m-Y') . "</td>
                    </tr>";
        }

        $data = [
            'title' => "<h2>LeveringInformatie</h2>",
            'rows' => $rows,
            'message' => $message,
            'leveranciervoornaam' => $items->LeverancierNaam,
            'contactpersoon' => $items->Contactpersoon,
            'telefoonnummer' => $items->Mobiel,

        ];
        $this->view('overzichtmagazijn/leverantieInfo', $data);
    }
}
