<?php
  class uitslagModel {
    // Properties, fields
    private $db;
    public $helper;

    public function __construct() {
      $this->db = new Database();
    //   $this->helper = new SqlHelper();
    }

    public function getSingleUitslag($id) 
    {
      $this->db->query("SELECT  PERS.Id AS PersoonId
                               ,PERS.Voornaam
                               ,PERS.Tussenvoegsel
                               ,PERS.Achternaam
                               ,US.Aantalpunten
                                FROM    persoon AS PERS
                                INNER JOIN Spel AS SP
                                    ON PERS.Id = SP.PersoonId
                                INNER JOIN uitslag AS US
                                    ON SP.Id = US.SpelId
                                WHERE   PERS.Id = :id");
      $this->db->bind(':id', $id, PDO::PARAM_INT);
      return $this->db->single();
    }

    public function getUitslaggegevens() {
     

    $sql = "SELECT persoon.Id,
                persoon.Voornaam, 
				persoon.tussenvoegsel,
			persoon.Achternaam,
		    uitslag.Aantalpunten
            from persoon
            INNER JOIN Spel 
            ON Persoon.Id = Spel.PersoonId
            inner join  uitslag
            on Spel.Id = uitslag.SpelId;";
        
        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }

    public function updateUitslag(array $post) 
    {
      try 
      {
            $this->db->query(" UPDATE uitslag
                              SET Aantalpunten = :aantalpunten
                              WHERE uitslag.Id = :id");

            $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
            $this->db->bind(':aantalpunten', $post["Aantalpunten"], PDO::PARAM_STR);
            $this->db->execute();
      } 
      catch(PDOException $e) 
      {
        echo $e->getMessage() . "Rollback";
        // $this->db->dbHandler->rollBack();
      }
    }
}