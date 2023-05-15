<?php
class OverzichtmagazijnModel {
    // Properties, fields
    private $db;
    public $helper;

    public function __construct() {
      $this->db = new Database();
    }

     public function getOverzichtmagazijns() {
      $sql = "SELECT  Product.Id as ProductId
                     ,Product.Barcode
                     ,Product.Naam
                     ,Magazijn.Verpakkingseenheid
                     ,Magazijn.Aantalaanwezig
              FROM Product
              inner join Magazijn
              ON Product.Id = Magazijn.ProductId
              ORDER BY Barcode ASC;";
      $this->db->query($sql);
      $result = $this->db->resultSet();
      return $result;
    }

    public function getLeverantieinfos($ProductId) {
        $sql = "SELECT  Product.Id
                     ,Product.Naam
                     ,ProductPerLeverancier.DatumLevering
                     ,ProductPerLeverancier.Aantal
                     ,ProductPerLeverancier.DatumEerstVolgendeLevering
              FROM Product
              inner join ProductPerLeverancier
              ON Product.Id = ProductPerLeverancier.ProductId
			  WHERE   Product.Id = :id
              ORDER BY DatumEerstVolgendeLevering ASC";
      $this->db->query($sql);
       $this->db->bind(':id', $ProductId, PDO::PARAM_INT);
      $result = $this->db->resultSet();
      return $result;
    }
}


?>