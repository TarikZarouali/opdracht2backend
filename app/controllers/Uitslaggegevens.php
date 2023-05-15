<?php

class Uitslaggegevens extends Controller
{
    //properties
    private $uitslagModel;

    // Dit is de constructor van de controller
    public function __construct() 
    {
        $this->uitslagModel = $this->model('uitslagModel');
    }

    public function index()
    {
        $uitslag = $this->uitslagModel->getUitslaggegevens();
        // var_dump($uitslag);exit();

        $rows = '';

        foreach ($uitslag as $items)
        {
            $rows .= "<tr>
                        <td>$items->Voornaam</td>
                        <td>$items->tussenvoegsel</td>
                        <td>$items->Achternaam</td>
                        <td>$items->Aantalpunten</td>
                        <td>
                            <a href='" . URLROOT . "/uitslaggegevens/update/$items->Id'>Wijzigen</a>
                        </td>
                      </tr>";
        }

        $data = ['title' => "<h1>Overzicht Speler</h1>", 'rows' => $rows];
        $this->view('uitslaggegevens/index', $data);
    }

    public function update($id = null) 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

           $isUpdateObjValid = new PromiseEntity();

            $isUpdateObjValid = UitslagValidator::validateUitslagInputFields($_POST);

            if ($isUpdateObjValid->Isvalid) 
            {
                $this->uitslagModel->updateUitslag($_POST);
                header("Location:" . URLROOT . "/uitslaggegevens/index");
            }
            else 
            {
                //$isUpdateObjValid->Message;
                // var_dump($isUpdateObjValid->Message);
                // exit();
                echo "$isUpdateObjValid->Message";
                header("refresh: 4 " . URLROOT . "/uitslaggegevens/index");
                
            }

        } 
        else // get
        {
            $row = $this->uitslagModel->getSingleUitslag($id);
            $data = ['title' => '<h1>Detail Uitslag</h1>', 'row' => $row];
            $this->view("uitslaggegevens/update", $data);
        }
    }
}
?>