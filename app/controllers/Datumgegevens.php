<?php

class Datumgegevens extends Controller
{
    //properties
    private $datumModel;

    // Dit is de constructor van de controller
    public function __construct() 
    {
        $this->datumModel = $this->model('datumModel');
    }

    public function index()
    {
        $datum = $this->datumModel->getDatumgegevens();
        // var_dump($uitslag);exit();

        $rows = '';

        foreach ($datum as $items)
        {
            $rows .= "<tr>
                        <td>$items->Voornaam</td>
                        <td>$items->tussenvoegsel</td>
                        <td>$items->Achternaam</td>
                        <td>$items->Aantalpunten</td>
                        <td>$items->datum</a>
                        </td>
                      </tr>";
        }

        $data = [
            'title' => "<h2>Overzicht Uitslag</h2>",
            'rows' => $rows
        ];
        $this->view('datumgegevens/index', $data);
    }
}
?>