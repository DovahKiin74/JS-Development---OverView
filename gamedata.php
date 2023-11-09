<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameName = $_POST["gameName"];
    $description = $_POST["description"];
    $imageSrc = $_POST["imageSrc"];
    $buttonLabel = $_POST["buttonLabel"];

    // Replace these with your database connection details

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "games";

    // Create a connection to the database
    $conn = new mysqli($host, $user, $password, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Prepare the SQL statement
        $sql = "INSERT INTO `gamesdata` (`gname`, `gdescrip`, `gimgsrc`, `gbtnlabel`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        // Bind the parameters
        $stmt->bind_param("ssss", $gameName, $description, $imageSrc, $buttonLabel);

        if ($stmt->execute()) {
            $_SESSION['gameAddedSuccessfully'] = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameData</title>
    <link rel="stylesheet" href="fake.css">
</head>
<body>
    <div class="main-container">
        <?php
        if (isset($_SESSION['gameAddedSuccessfully']) && $_SESSION['gameAddedSuccessfully']) {
            echo '<div class="success-message">Congratulations! Your game has been added.</div>';
            $_SESSION['gameAddedSuccessfully'] = false;
        }
        ?>
        <div class="btn-Container">
            <button type="button" id="add-game-button" class="addgameBTN" onclick="toggleForm()"><span>Add Game from here</span> Add Game</button>
            <button type="button" id="edit-game-button" class="editgameBTN" onclick="toggleEditForm()"><span>Edit Game from here</span> Edit Game</button>
        </div>
        <div class="form-container" id="game-form-container">
            <button class="close-button" onclick="closeForm()"><i class='bx bx-cross'></i></button>
            <h2 class="form-header"><i class='bx bx-fingerprint' ></i> Add Game</h2>
            <form id="game-form" action="" method="post">
                <div class="form-group">
                    <label for="gameName"><i class='bx bxs-joystick-button' ></i> Game Name:</label>
                    <input type="text" id="gameName" name="gameName" required>
                </div>
                <div class="form-group">
                    <label for="description"><i class='bx bxl-spring-boot'></i> Description <small class="muted">(2 lines max)</small>:</label>
                    <textarea id="description" name="description" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <label for="imageSrc"><i class='bx bxs-image-add'></i> Image Source <small class="muted">(URL)</small>:</label>
                    <input type="text" id="imageSrc" name="imageSrc" required>
                </div>
                <div class="form-group">
                    <label for="buttonLabel"><i class='bx bxs-label' ></i> Button Label:</label>
                    <input type="text" id="buttonLabel" name="buttonLabel" required>
                </div>
                <button type="submit" class="submitgamedata"><i class='bx bxs-cloud-upload'></i> Submit</button>
            </form>
        </div>
        <span class="emoji">
            <img src="images/emoji/astonished.png">
        </span>
    </div>


    <?php
$host = "localhost";
$user = "root";
$password = "";
$db = "games";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement for fetching data
$sql = "SELECT gname, gdescrip, gimgsrc, gbtnlabel FROM gamesdata";
$result = $conn->query($sql);

if ($result) {
    // Step 3: Organize the data
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // Store the JSON data in a file
    $filename = 'games.json';
    file_put_contents($filename, $json);
} else {
    // Handle database query error
    echo "Query error: " . $mysqli->error;
}
$conn->close();
?>
<script>
    


    function toggleForm() {
        var formContainer = document.getElementById("game-form-container");
        if (formContainer.style.display === "none" || formContainer.style.display === "") {
            formContainer.style.display = "block";
        } else {
            formContainer.style.display = "none";
        }
    }
    function closeForm() {
        var formContainer = document.getElementById("game-form-container");
        formContainer.style.display = "none";
    }
    function toggleEditForm() {
        var editFormContainer = document.getElementById("edit-game-form-container");
        if (editFormContainer.style.display === "none" || editFormContainer.style.display === "") {
            editFormContainer.style.display = "block";
        } else {
            editFormContainer.style.display = "none";
        }
    }
</script>    
</body>
</html>
