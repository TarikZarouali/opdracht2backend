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
        $sql = "SELECT             
                        Product.Id
                        ,Product.Naam as ProductNaam
                        ,ProductPerLeverancier.DatumLevering
                        ,ProductPerLeverancier.Aantal
                        ,ProductPerLeverancier.DatumEerstVolgendeLevering
                        ,Leverancier.Naam as LeverancierNaam
                        ,Leverancier.Contactpersoon
                        ,Leverancier.LeverancierNummer
                        ,Leverancier.Mobiel
                        ,MAGA.AantalAanwezig

              FROM Product

              inner join ProductPerLeverancier
              ON Product.Id = ProductPerLeverancier.ProductId
              
              INNER JOIN Leverancier
			        ON Leverancier.Id = ProductPerLeverancier.LeverancierId	
              
              INNER JOIN Magazijn AS MAGA
              ON        MAGA.ProductId = Product.Id
              
              WHERE   Product.Id = :id
              ORDER BY DatumEerstVolgendeLevering ASC";
      $this->db->query($sql);
      $this->db->bind(':id', $ProductId, PDO::PARAM_INT);
      $result = $this->db->resultSet();
      return $result;
    }

    public function getallergeneinfos($productId) {
      $sql = "SELECT                
                      Allergeen.Naam
                     ,Allergeen.Omschrijving
                     ,Product.Naam as naamproduct
                     ,Product.Barcode
                     
              FROM Allergeen

              INNER JOIN ProductPerAllergeen
              ON Allergeen.Id = ProductPerAllergeen.AllergeenId
              
              INNER JOIN Product
              ON ProductPerAllergeen.ProductId = Product.Id
              
              WHERE   Product.Id = :id
              ORDER BY Allergeen.Naam ASC";
      $this->db->query($sql);
      $this->db->bind(':id', $productId, PDO::PARAM_INT);
      $result = $this->db->resultSet();
      return $result;
    }

    public function getProductById($productId)
    {
      $sql = "SELECT  Product.Id              
                     ,Product.Naam as naamproduct
                     ,Product.Barcode
                     
              FROM Product
              WHERE   Product.Id = :id";
      $this->db->query($sql);
      $this->db->bind(':id', $productId, PDO::PARAM_INT);
      $result = $this->db->single();
      return $result;
    }
}
?>