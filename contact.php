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

        if ($nameErr == "" && $priceErr == "" && $minCountErr == "" && $maxCountErr == "") {
            header('Location: index.php');

            $db = new PDO('mysql:host=db; dbname=collections_display', 'root', 'password');

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $query = $db->prepare("INSERT INTO board_games (`name`, `rrp`, `min_player_count`, `max_player_count`, `image`, `types`) 
                VALUES ('$name', '$price', '$playerCountMin', '$playerCountMax', '$image', '$gameType')");

            $query->execute();
        }

        // $query->bindParam(':name', $name); 
        // $query->bindParam(':rrp', $price);
        // $query->bindParam(':min_player_count', $playerCountMin); 
        // $query->bindParam(':max_player_count', $playerCountMax);
        // $query->bindParam(':image', $image); 
        // $query->bindParam(':types', $gameType);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a class="active" href="contact.php">Add a Game</a>
    </div>
    <h1 class="title">Add a new game to my games collection!</h1>

    <form method="post" class="formToAdd">
        <label for="name">Name of Game *</label>
        <input id="name" name="name" type="text" maxlength="100" value="<?php echo $name; ?>" />
        <span class="error"><?php echo $nameErr; ?></span>

        <label for="price">RRP £ *</label>
        <input id="price" name="price" type="number" min="0.00" max="1000.00" step="0.01" value="<?php echo $price; ?>" />
        <span class="error"><?php echo $priceErr; ?></span>

        <label for="playerCountMin">Minimum no. of Players *</label>
        <input id="playerCountMin" name="playerCountMin" type="number" min="1" max="100" value="<?php echo $playerCountMin; ?>" />
        <span class="error"><?php echo $minCountErr; ?></span>

        <label for="playerCountMax">Maximum no. of Players *</label>
        <input id="playerCountMax" name="playerCountMax" type="number" min="1" max="100" value="<?php echo $playerCountMax; ?>" />
        <span class="error"><?php echo $maxCountErr; ?></span>

        <label for="image">Image URL</label>
        <input id="image" name="image" type="url" placeholder="https://www.example.com" maxlength="500" value="<?php echo $image; ?>" />

        <label for="gameType">Type of Game</label>
        <input id="gameType" name="gameType" type="text" maxlength="100" placeholder="Strategy, Family, Party etc" value="<?php echo $gameType; ?>" />
        
        <input class="submitBtn" name="submit" type="submit" value="Submit" />
    </form>

</body>

</html>