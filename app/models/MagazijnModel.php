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
        $sql = "SELECT * FROM JaminMagazijn";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

}