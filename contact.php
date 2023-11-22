<?php

$nameErr = $priceErr = $minCountErr = $maxCountErr = "";
$name = $price = $playerCountMin = $playerCountMax = $image = $gameType = "";

if (
    isset($_POST['name']) && isset($_POST['price']) && isset($_POST['playerCountMin'])
    && isset($_POST['playerCountMax']) && isset($_POST['image']) && isset($_POST['gameType'])
) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $playerCountMin = $_POST['playerCountMin'];
    $playerCountMax = $_POST['playerCountMax'];
    $image = $_POST['image'];
    $gameType = $_POST['gameType'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = ($_POST["name"]);
        }
        if (empty($_POST["price"])) {
            $priceErr = "RRP is required";
        } else {
            $price = ($_POST["price"]);
        }
        if (empty($_POST["playerCountMin"])) {
            $minCountErr = "Minimum no. of players is required";
        } else {
            $playerCountMin = ($_POST["playerCountMin"]);
        }
        if (empty($_POST["playerCountMax"])) {
            $maxCountErr = "Maximum no. of players is required";
        } else {
            $playerCountMax = ($_POST["playerCountMax"]);
        }
        //check no error messages - all fields are complete: 
        //if none then submit to database and move to homepage - still need to write code to send to db!

        if ($nameErr == "" && $priceErr == "" && $minCountErr == "" && $maxCountErr == "") {
            header('Location: index.php');
        }

        $db = new PDO('mysql:host=db; dbname=collections_display', 'root', 'password');

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $query = $db->prepare("INSERT INTO board_games (`name`, `rrp`, `min_player_count`, `max_player_count`, `image`, `type`) 
            VALUES ('$name', '$price', '$playerCountMin', '$playerCountMax', '$image', '$gameType')");

        $query->execute();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
        body {
            margin: 0;
            background-color: linen;
            font-family: 'Mukta', sans-serif;
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

        .formToAdd {
            display: grid;
        }

        .submitBtn {
            max-width: 300px;

        }
    </style>
</head>

<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a class="active" href="contact.php">Add a Game</a>
    </div>
    <h1 class="title">Add a new game to my games collection!</h1>

    <form method="post" class="formToAdd">
        <label for="name">Name of Game *</label>
        <input id="name" name="name" type="text" value="<?php echo $name; ?>" />
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>

        <label for="price">RRP £ *</label>
        <input id="price" name="price" type="number" min="0.00" max="1000.00" step="0.01" value="<?php echo $price; ?>" />
        <span class="error"><?php echo $priceErr; ?></span>
        <br><br>

        <label for="playerCountMin">Minimum no. of Players *</label>
        <input id="playerCountMin" name="playerCountMin" type="number" min="1" max="100" value="<?php echo $playerCountMin; ?>" />
        <span class="error"><?php echo $minCountErr; ?></span>
        <br><br>

        <label for="playerCountMax">Maximum no. of Players *</label>
        <input id="playerCountMax" name="playerCountMax" type="number" min="1" max="100" value="<?php echo $playerCountMax; ?>" />
        <span class="error"><?php echo $maxCountErr; ?></span>
        <br><br>

        <label for="image">Image url</label>
        <input id="image" name="image" type="url" value="<?php echo $image; ?>" />

        <label for="gameType">Type of Game</label>
        <input id="gameType" name="gameType" type="text" value="<?php echo $gameType; ?>" />
        <br><br>

        <input class="submitBtn" name="submit" type="submit" value="Submit" />
    </form>
</body>

</html>