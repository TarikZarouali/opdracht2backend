<?php
class LeverancierModel
{
    // Properties, fields
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeverancierById(int $leverancierId)
    {
        try
        {
            $sql = "SELECT  Leverancier.Id
                            ,Leverancier.Naam
                            ,Leverancier.ContactPersoon
                            ,Leverancier.LeverancierNummer
                            ,Leverancier.Mobiel

                    FROM Leverancier
                    WHERE   Leverancier.Id = :id";

            $this->db->query($sql);
            $this->db->bind(':id', $leverancierId, PDO::PARAM_INT);
            $result = $this->db->single();
            return $result;
        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
            throw $error->getMessage();
        }
    }

    public function getLeveranciers()
    {
        try
        { $sql = "SELECT  Leverancier.Id
                          ,Leverancier.Naam
                          ,Leverancier.Contactpersoon
                          ,Leverancier.LeverancierNummer
                          ,Leverancier.Mobiel
                          ,COUNT(PPL.ProductId) AS product_count
                  FROM Leverancier
                  LEFT JOIN ProductPerLeverancier AS PPL
                  ON Leverancier.Id = PPL.LeverancierId
                  GROUP BY PPL.LeverancierId
                  ORDER BY product_count DESC;";

            $this->db->query($sql);
            $result = $this->db->resultSet();
            return $result;

        } catch (PDOException $error) {
            echo $error->getMessage();

            throw $error->getMessage();
        }
    }

    public function getToonproducts($id)
    {

        try
        {

            $sql = "SELECT  Product.Id
                            ,Product.Naam
                            ,Magazijn.AantalAanwezig
                            ,Magazijn.VerpakkingsEenheid
                            ,ProductPerLeverancier.DatumLevering
                    FROM Leverancier

                    INNER JOIN  ProductPerLeverancier
                    ON ProductPerLeverancier.LeverancierId = Leverancier.Id

                    INNER JOIN Product
                    ON Product.Id = ProductPerLeverancier.ProductId

                    INNER JOIN Magazijn
                    ON Product.Id = Magazijn.ProductId

                    WHERE Leverancier.Id = :id

                    ORDER BY Magazijn.AantalAanwezig DESC";

            $this->db->query($sql);
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            $result = $this->db->resultSet();
            return $result;

        } catch (PDOException $error) {
            echo $error->getMessage();

            throw $error->getMessage();
        }
    }

    public function getupdateproducts($id)
    {
        try
        { $sql = "SELECT   Product.Id
                          ,Magazijn.VerpakkingsEenheid
                          ,ProductPerLeverancier.DatumLevering
                  FROM Leverancier

                  INNER JOIN  ProductPerLeverancier
                  ON ProductPerLeverancier.LeverancierId = Leverancier.Id

                  INNER JOIN Product
                  ON Product.Id = ProductPerLeverancier.ProductId

                  INNER JOIN Magazijn
                  ON Product.Id = Magazijn.ProductId

                  WHERE Leverancier.Id = :id

                  ORDER BY Magazijn.AantalAanwezig DESC";

            $this->db->query($sql);
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            $result = $this->db->resultSet();
            return $result;

        } catch (PDOException $error) {
            echo $error->getMessage();

            throw $error->getMessage();
        }
    }

    public function leveringProduct($id)
    {
        try {
            $sql = "SELECT  leverancier.id
                            ,Leverancier.Naam
                            ,Leverancier.Contactpersoon
                            ,Leverancier.Mobiel
                FROM Leverancier
                LEFT JOIN ProductPerLeverancier AS PPL
                ON Leverancier.Id = PPL.LeverancierId
                WHERE leverancier.id = :id
                GROUP BY PPL.LeverancierId";
            $this->db->query($sql);
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            $result = $this->db->single();
            return $result;
        } catch (PDOException $error) {
            echo $error->getMessage();
            throw $error;
        }
    }

    private function GetProductIdByLeverancierId(int $leverancierId) : int
    {
        try
        {
            $sqlQuery = "   SELECT		PRLE.Id	AS ProductId
                            FROM    	Leverancier AS LEVER
                            INNER JOIN 	ProductPerLeverancier AS PRLE
                                    ON	PRLE.LeverancierId = LEVER.Id
                            WHERE		LEVER.Id = :leverancierId
                            ORDER BY    PRLE.Id desc
                            LIMIT 		1
                        ";

            $this->db->query($sqlQuery);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $result = $this->db->single();
            return  $result->ProductId;
        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
            throw $error;
        }
    }

    public function CreatProductPerLeverancier(mixed $post, int $leverancierId)
    {
        try
        {
            $productId = $this->GetProductIdByLeverancierId($leverancierId);

            $aantal                     = $post["AantalProducten"];
            $datumEerstVolgendeLevering = $post["DatumEerstvolgendeLevering"]; 

            $sqlQuery = "   INSERT INTO ProductPerLeverancier
                (
                    LeverancierId
                    ,ProductId
                    ,DatumLevering
                    ,Aantal
                    ,DatumEerstVolgendeLevering
                    ,IsActief
                    ,Opmerking
                    ,DatumAangemaakt
                    ,DatumGewijzigd
                )
                values(:leverancierId, :productId, sysdate(6), :aantal, :datumEerstVolgendeLevering, 1, null, sysdate(6), sysdate(6));
                -- values(1, 1, sysdate(6), 2, sysdate(6), 1, null, sysdate(6), sysdate(6));
            ";

            $this->db->query($sqlQuery);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->bind(':productId', $productId, PDO::PARAM_INT);
            $this->db->bind(':aantal', $aantal, PDO::PARAM_STR);
            $this->db->bind(':datumEerstVolgendeLevering', $datumEerstVolgendeLevering, PDO::PARAM_STR);
            $this->db->execute();
        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
            throw $error;
        }
    }


    public function updateAantalAanwezig($id, $nieuwAantal)
{
    try {
        $sql = "UPDATE Magazijn
                SET AantalAanwezig = AantalAanwezig + :nieuwAantal
                WHERE ProductId IN (
                SELECT ProductId
                FROM ProductPerLeverancier
                WHERE LeverancierId = :leverancierId)";
        $this->db->query($sql);
        $this->db->bind(':nieuwAantal', $nieuwAantal, PDO::PARAM_INT);
        $this->db->bind(':leverancierId', $id, PDO::PARAM_INT);
        $this->db->execute();
    } 
    catch (PDOException $error) 
    {
        echo $error->getMessage();
        throw $error;
    }
}

public function updateDatumLaatsteLevering($id)
{
    try {
        $sql = "UPDATE ProductPerLeverancier
                SET DatumLevering = CURRENT_DATE()
                WHERE LeverancierId = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();
    } catch (PDOException $error) {
        echo $error->getMessage();
        throw $error;
    }
}


}