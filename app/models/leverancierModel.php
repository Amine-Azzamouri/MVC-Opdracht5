<?php

class leverancierModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeverancierInfo()

    // ik moet een betere kijkje nemen naar mijn sql query die de leverancierinfo ophaalt. volgensmij is die niet helemaal correct. 
    
    {
        $sql = "SELECT
        L.Id AS LeverancierId,
        L.Naam AS LeverancierNaam,
        L.ContactPersoon AS ContactPersoon,
        L.LeverancierNummer AS LeverancierNummer,
        L.Mobiel AS Mobiel,
        COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten
    FROM
        Leverancier L
    LEFT JOIN
        ProductPerLeverancier PPL 
    ON 
        L.Id = PPL.LeverancierId
    GROUP BY
        L.Id, L.Naam, L.ContactPersoon, L.LeverancierNummer, L.Mobiel
    ORDER BY
        AantalVerschillendeProducten DESC;
    ";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getGeleverdeProductenInfo($Id)
    {

        $sql = "SELECT
        p.Id AS ProductId,
        p.Naam AS NaamProduct,
        m.AantalAanwezig AS AantalInMagazijn,
        m.VerpakkingsEenheid,
        pl.DatumLevering,
        l.Id AS LeverancierId,
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel
    FROM
        Product p
    JOIN
        Magazijn m ON p.Id = m.ProductId
    JOIN
        ProductPerLeverancier pl ON p.Id = pl.ProductId
    JOIN
        Leverancier l ON pl.LeverancierId = l.Id
    WHERE
        l.Id = :leverancierId;
    ";
        $this->db->query($sql);
        $this->db->bind(":leverancierId", $Id, PDO::PARAM_INT);

        return $this->db->resultSet();
    }
}