<?php

class AllergenenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getALLAllergenen()
    {
        $sql = "SELECT
        p.Id AS product_id,
        p.Naam AS naamproduct,
        GROUP_CONCAT(a.Id) AS allergenen_id,
        GROUP_CONCAT(a.Naam) AS naamallergenen,
        GROUP_CONCAT(a.Omschrijving) AS omschrijving,
        m.AantalAanwezig AS aantalaanwezig
    FROM
        Magazijn m
    JOIN
        Product p ON m.ProductId = p.Id
    LEFT JOIN
        ProductPerAllergeen ppa ON p.Id = ppa.ProductId
    LEFT JOIN
        Allergeen a ON ppa.AllergeenId = a.Id
    GROUP BY
        p.Id, p.Naam, m.AantalAanwezig;
    
    
        ";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getAllergenen($selectedAllergie)
    {
        $sql = "SELECT
                p.Id AS product_id,
        p.Naam AS naamproduct,
        GROUP_CONCAT(a.Id) AS allergenen_id,
        GROUP_CONCAT(a.Naam) AS naamallergenen,
        GROUP_CONCAT(a.Omschrijving) AS omschrijving,
        m.AantalAanwezig AS aantalaanwezig
    FROM
        Magazijn m
    JOIN
        ProductPerAllergeen ppa ON m.ProductId = ppa.ProductId
    JOIN
        Product p ON m.ProductId = p.Id
    JOIN
        Allergeen a ON ppa.AllergeenId = a.Id
    WHERE
        a.Naam = :selectedallergie
    GROUP BY
        p.Naam, m.AantalAanwezig;
    
        ";

        $this->db->query($sql);
        $this->db->bind(':selectedallergie', $selectedAllergie, PDO::PARAM_STR);
        return $this->db->resultSet();
    }

    public function getAllergieInfoIndex($Id)
    {
        $sql = "SELECT
        l.Naam AS naamleverancier,
        l.ContactPersoon AS contactpersoon,
        l.Mobiel AS mobiel,
        c.Stad AS stad,
        c.Straat AS straatnaam,
        c.Huisnummer AS huisnummer,
        pp.ProductId AS product_id
    FROM
        Leverancier l
    LEFT JOIN
        Contact c ON l.ContactId = c.Id
    JOIN
        ProductPerLeverancier pp ON l.Id = pp.LeverancierId
    WHERE
        pp.ProductId = :product_id;
    
        ";

        $this->db->query($sql);
        $this->db->bind(':product_id', $Id, PDO::PARAM_STR);
        return $this->db->resultSet();
    }
}