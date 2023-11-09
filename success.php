<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "games";
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM gamesdata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // The query executed successfully
    $dataFromDatabase = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dataFromDatabase[] = $row;
        }
    }

    // Check if any data was retrieved
    if (!empty($dataFromDatabase)) {
        $jsonMerged = json_encode($dataFromDatabase);

        echo "<div class='data-container'>";
        if (!empty($jsonMerged)) {
            echo "<script>var gameData = " . $jsonMerged . ";</script>";
        }
        echo "</div>";
    } else {
        echo "No data found.";
    }
}

$conn->close();

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$gameAddedSuccessfully = true;

if ($gameAddedSuccessfully) {
    $_SESSION['gameAddedSuccessfully'] = true;
} else {
    $_SESSION['gameAddedSuccessfully'] = false;
}

// Display a success message or error message
if (isset($_SESSION['gameAddedSuccessfully']) && $_SESSION['gameAddedSuccessfully']) {
    echo "<div class='success-message'><p> Game added successfully </p></div>";
    $_SESSION['gameAddedSuccessfully'] = false;
} else {
    echo "<div class='error-message'><p> Connection Error. </p></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="success.css">
</head>
<body>


<div class="data-container">
    <div class="game-card">
        <div class="game-title-img">
            <img id="gameImage" alt="Game Image">
        </div>
        <div class="game-description-content">
            <h3 id="gameName" class="gameName"></h3>
            <p id="gameDescription" class="gameDescrip"></p>
            <button id="gameButton" class="labelBtn"></button>
        </div>
    <button type="submit" name="redirectButton" id="redirectButton"><i class='bx bxl-telegram'></i></button>
    </div>
</div>

<script>
        document.getElementById("redirectButton").addEventListener("click", function() {
            window.location.href = "gamesdatabase.php";
        });
    if (typeof gameData !== 'undefined' && gameData.length > 0) {
        var latestGame = gameData[0];
        document.getElementById('gameName').textContent = latestGame.gname;
        document.getElementById('gameDescription').textContent = latestGame.gdescrip;
        document.getElementById('gameButton').textContent = latestGame.gbtnlabel;
        document.getElementById('gameImage').src = latestGame.gimgsrc;
    }
</script>
</body>
</html>