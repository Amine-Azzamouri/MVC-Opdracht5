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

}