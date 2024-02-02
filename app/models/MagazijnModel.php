<?php

class MagazijnModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMagazijnInfo()
    {
        $sql = "SELECT Magazijn.Id AS MagazijnId, Product.Barcode, Product.Naam, Magazijn.VerpakkingsEenheid, Magazijn.AantalAanwezig
        FROM Magazijn
        INNER JOIN Product ON Magazijn.ProductId = Product.Id
        ORDER BY Product.Barcode ASC;
        
        
        ";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getAlergieInfo($Id)
    {
        $sql = "SELECT
        P.Naam AS Snoep,
        P.Barcode,
        A.Omschrijving AS AllergeenOmschrijving,
        M.Id AS MagazijnId
        
    FROM
        Product AS P
    JOIN
        ProductPerAllergeen AS PA ON P.Id = PA.ProductId
    JOIN
        Allergeen AS A ON PA.AllergeenId = A.Id
    JOIN
        Magazijn AS M ON P.Id = M.ProductId
    WHERE P.Id = :id;
    ";

        $this->db->query($sql);
        $this->db->bind(":id", $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getLeverancierInfo($Id)
    {
        $sql = "SELECT 
        Le.Naam AS LeverancierNaam,
        Le.ContactPersoon AS LeverancierContactPersoon,
        Le.LeverancierNummer,
        Le.Mobiel AS LeverancierMobiel,
        Pr.Id AS ProductId,
        Pr.Naam AS ProductNaam,
        Ma.AantalAanwezig,
        PpL.DatumLevering,
        PpL.DatumEerstVolgendeLevering
    FROM 
        Leverancier AS Le
    JOIN 
        ProductPerLeverancier AS PpL ON Le.Id = PpL.LeverancierId
    JOIN 
        Product AS Pr ON PpL.ProductId = Pr.Id
    JOIN 
        Magazijn AS Ma ON PpL.ProductId = Ma.ProductId
    WHERE 
        Pr.Id = :id;
    ";

        $this->db->query($sql);
        $this->db->bind(":id", $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    

}