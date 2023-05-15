<?php

  class Overzichtmagazijn extends Controller {
    private $OverzichtmagazijnModel;

    public function __construct() {
    $this->OverzichtmagazijnModel = $this->model('OverzichtmagazijnModel');
  }

  public function index() {
    /**
     * Haal alle instructeurs op uit de model
     */
    $overzichtmagazijns = $this->OverzichtmagazijnModel->getOverzichtmagazijns();

    /**
     * Maak tabelrijen van de opgehaalde data over de overzichtmagazijn
     */
    $rows = '';
    foreach ($overzichtmagazijns as $items){
      $rows .= "<tr>
                  <td>$items->Barcode</td>
                  <td>$items->Naam</td>
                  <td>$items->Verpakkingseenheid</td>
                  <td>$items->Aantalaanwezig</td>
                  <td>
                    <a href='" . URLROOT . "/overzichtmagazijn/allergeneinfo/$items->ProductId'>AllergeneInfo</a>
                  </td>
                  <td>
                    <a href='" . URLROOT . "/overzichtmagazijn/leverantieInfo/$items->ProductId'>LeverantieInfo</a>
                  </td>
                </tr>";

    }

    $data = ['title' => "<h2>Overzicht magazijn jamin</h2>", 'rows' => $rows];
    $this->view('overzichtmagazijn/index', $data);
  }

  public function Leverantieinfo($ProductId){

 
   $Leverantieinfos = $this->OverzichtmagazijnModel->getLeverantieinfos($ProductId);

    /**
     * Maak tabelrijen van de opgehaalde data over de overzichtmagazijn
     */
    $rows = '';
    foreach ($Leverantieinfos as $items){
      $rows .= "<tr>
                  <td>$items->Naam</td>
                  <td>$items->DatumLevering</td>
                  <td>$items->Aantal</td>
                  <td>$items->DatumEerstVolgendeLevering</td>
                </tr>";
    }

    $data = [
            'title' => "<h2>LeveringInformatie</h2>",
            'rows' => $rows
        ];
        $this->view('overzichtmagazijn/leverantieInfo', $data);
    }

}

?>