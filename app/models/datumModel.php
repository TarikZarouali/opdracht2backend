<?php
  class datumModel {
    // Properties, fields
    private $db;
    public $helper;

    public function __construct() {
      $this->db = new Database();
    //   $this->helper = new SqlHelper();
    }

    // public function getSingleUitslag($id) 
    // {
    //   $this->db->query("SELECT  PERS.Id AS PersoonId
    //                            ,PERS.Voornaam
    //                            ,PERS.Tussenvoegsel
    //                            ,PERS.Achternaam
    //                            ,US.Aantalpunten
    //                             FROM    persoon AS PERS
    //                             INNER JOIN Spel AS SP
    //                                 ON PERS.Id = SP.PersoonId
    //                             INNER JOIN uitslag AS US
    //                                 ON SP.Id = US.SpelId
    //                             WHERE   PERS.Id = :id");
    //   $this->db->bind(':id', $id, PDO::PARAM_INT);
    //   return $this->db->single();
    // }

    public function getDatumgegevens() {
     

    $sql = "SELECT persoon.Id,
                persoon.Voornaam, 
				persoon.tussenvoegsel,
			persoon.Achternaam,
		    uitslag.Aantalpunten,
        Reservering.datum
            -- DATE(Reservering.datum) as Datum
            from persoon
            INNER JOIN Spel 
            ON Persoon.Id = Spel.PersoonId
            INNER JOIN Reservering 
            ON Persoon.Id = Reservering.PersoonId
            inner join  uitslag
            on Spel.Id = uitslag.SpelId
            -- where   Reservering.datum <= :datum 
            ORDER BY uitslag.Aantalpunten DESC";
        
        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }
}