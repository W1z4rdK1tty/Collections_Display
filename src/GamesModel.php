<?php

class GamesModel 
    {
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllGames()
    {
    $query = $this->db->prepare('SELECT * FROM `board_games`;');

    $query->execute();

    $result = $query->fetchAll();
    return $result;

    }
    }

