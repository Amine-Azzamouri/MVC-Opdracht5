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
        l.Id = :leverancierId
;";
        $this->db->query($sql);
        $this->db->bind(":leverancierId", $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getSingleLeverancierInfo($Id)
    {

        $sql = "SELECT Id, Naam, ContactPersoon, Mobiel
        FROM Leverancier
        WHERE
        Id = :leverancierId;
    ";
        $this->db->query($sql);
        $this->db->bind(":leverancierId", $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function updateLeveringProduct($post)
    {
        try {
            $sql = "UPDATE Magazijn m
            JOIN ProductPerLeverancier ppl ON m.ProductId = ppl.ProductId
            SET 
                m.AantalAanwezig = m.AantalAanwezig + :aantal_Productheden,
                ppl.DatumLevering = :datum_Levering
            WHERE m.ProductId = :productId;           
            ";
        
            $this->db->query($sql);
            $this->db->bind(':aantal_Productheden', $post['aantal_Productheden'], PDO::PARAM_INT);
            $this->db->bind(':datum_Levering', $post['datum_Levering'], PDO::PARAM_STR);
            $this->db->bind(':productId', $post['productId'], PDO::PARAM_INT);
            $this->db->execute();
            
            return true; 
        } catch (Exception $e) {
            throw new Exception('Error updating levering: ' . $e->getMessage());
        }
    }

    public function getLeverancierDetails($Id)
    {

        $sql = "SELECT 
        l.Id AS LeverancierId,
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel,
        c.Straat,
        c.Huisnummer,
        c.Postcode,
        c.Stad
    FROM 
        Leverancier l
    JOIN 
        Contact c ON l.ContactId = c.Id
    WHERE
        l.Id = :leverancierId;
    ";
        $this->db->query($sql);
        $this->db->bind(":leverancierId", $Id, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function updateLeverancierDetails($post)
    {
        try {
            $sql = "UPDATE Leverancier l
                    JOIN Contact c ON l.ContactId = c.Id
                    SET 
                        l.Naam = :naam,
                        l.ContactPersoon = :contact_persoon,
                        l.LeverancierNummer = :leverancier_nummer,
                        l.Mobiel = :mobiel,
                        c.Straat = :straatnaam,
                        c.Huisnummer = :huisnummer,
                        c.Postcode = :postcode,
                        c.Stad = :stad";
            
            $this->db->query($sql);
            $this->db->bind(':naam', $post['naam'], PDO::PARAM_STR);
            $this->db->bind(':contact_persoon', $post['contact_persoon'], PDO::PARAM_STR);
            $this->db->bind(':leverancier_nummer', $post['leverancier_nummer'], PDO::PARAM_STR);
            $this->db->bind(':mobiel', $post['mobiel'], PDO::PARAM_STR);
            $this->db->bind(':straatnaam', $post['straatnaam'], PDO::PARAM_STR);
            $this->db->bind(':huisnummer', $post['huisnummer'], PDO::PARAM_STR);
            $this->db->bind(':postcode', $post['postcode'], PDO::PARAM_STR);
            $this->db->bind(':stad', $post['stad'], PDO::PARAM_STR);
            $this->db->execute();
            
            return true; 
        } catch (Exception $e) {
            throw new Exception('Error updating leverancier details: ' . $e->getMessage());
        }
    }
    

}