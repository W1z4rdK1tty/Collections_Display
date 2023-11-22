<?php

$db = new PDO('mysql:host=db; dbname=collections_display', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT * FROM `board_games`;');

$query->execute();

$result = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            background-color: linen;
            font-family: 'Mukta', sans-serif;
        }
        .games {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
        .game {
            border: 10px solid;
            border-color: black;
            background-color: lightsteelblue;
            padding: 20px;
            margin: 20px;
        }
        img {
            width: 150px;
            height: 150px;
            padding-left: 45px;
            padding-bottom: 10px;
        }
        .topnav {
            background-color: #333;
            overflow: hidden;
        }
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 30px;
        }
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }
        .topnav a.active {
            background-color: purple;
            color: white;
        }
        .title {
            text-align: center;
            font-size: 40px;
        }
    </style>
</head>

<body>

    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#contact">Contact</a>
    </div>
    <h1 class="title">Welcome to my games collection!</h1>

    <div class="games">

        <?php

        foreach ($result as $game) {

            echo '<div class="game">';
            echo "<h2>{$game['name']}</h2>";
            echo "<div><img src='{$game['image']}'/></div>";
            echo "<div>RRP: £{$game['rrp']}</div>";
            echo "<div>Min Players: {$game['min_player_count']}</div>";
            echo "<div>Max Players: {$game['max_player_count']}</div>";
            echo "<div>Categories: {$game['type']}</div>";
            echo '</div>';
        }

        ?>
    </div>
</body>

</html>