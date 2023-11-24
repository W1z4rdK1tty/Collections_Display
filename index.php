<?php

require_once 'src/GamesModel.php';

$db = new PDO('mysql:host=db; dbname=collections_display', 'root', 'password');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$gamesModel = new GamesModel($db);

$games = $gamesModel->getAllGames();


//new code for dropdown functionality and search box

// $sql = $db->prepare("SELECT DISTINCT `types` FROM `board_games`;");

// $sql->execute();

// $columnResult = $sql->fetchAll(); 

// $arrayValues = array();

// foreach ($columnResult as $v1) {
//     foreach ($v1 as $v2) {
//         //make new from v2 split by comma
//         $pieces = explode(", ", $v2);
//         foreach ($pieces as $piece) {
//             array_push($arrayValues, $piece);
//         }
//         //if sorted array does not contain v2 add it to new array
//         // echo "$v2\n";
//         // print_r(array_values($pieces));
//     }
// }

// // print_r(array_unique($arrayValues));

// $filteredArray = array_unique($arrayValues);

// print_r($filteredArray);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Collection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="contact.php">Add a Game</a>
<!-- HTML code for filter dropdown box and text search bar (story5) -->
        <!-- <form class="categorySearch" method="post">
            <label for="search">Search Bar</label>
            <input type="text" name="categoryToSearch" placeholder="Category To Search">
            <label for="searchButton">Button</label>
            <input type="submit" name="search" value="Search">
        <span></span>
        <form class="playerCountFilter" method="post">
            <label for="filter">Filter Bar</label>
            <input type="number" name="playerCountToSearch" placeholder="How many players?">
            <label for="filterButton">Button</label>
            <input type="submit" name="countFilter" value="Filter"> -->
    </div>

    <h1 class="title">Welcome to my games collection!</h1>

    <div class="games">
        <?php

        foreach ($games as $game) {

            echo '<div class="game">';
            echo "<h2>{$game['name']}</h2>";
            echo "<div><img src='{$game['image']}' alt='Photo of {$game['name']} board game box'/></div>";
            echo "<div>RRP: £{$game['rrp']}</div>";
            echo "<div>Min Players: {$game['min_player_count']}</div>";
            echo "<div>Max Players: {$game['max_player_count']}</div>";
            echo "<div>Categories: {$game['types']}</div>";
            echo '</div>';
        }

        ?>
    </div>
</body>

</html>