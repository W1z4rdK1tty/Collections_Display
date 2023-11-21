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
        .board_games {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
        }
        .game {
            background-color: purple;
        }
    </style>
</head>
<body>
<div class="games">
<?php

foreach ($result as $game) {
    echo '<ul class="game">';
    echo "<li>{$game['name']}</li>";
    echo "<li>£{$game['rrp']}</li>";
    echo "<li>{$game['min_player_count']}</li>";
    echo "<li>{$game['max_player_count']}</li>";
    echo "<li><img src='{$game['image']}' /></li>";
    echo '</ul>';
}
?>
</div>
</body>
</html>