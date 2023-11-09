
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$gameName = "";       // Initialize these variables with empty values
$description = "";
$imageSrc = "";
$buttonLabel = "";
$dataFromDatabase = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameName = $_POST["gameName"];
    $description = $_POST["description"];
    $imageSrc = $_POST["imageSrc"];
    $buttonLabel = $_POST["buttonLabel"];

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
        // Corrected SQL query with placeholders
        $sql = "INSERT INTO `gamesdata`(`gname`, `gdescrip`, `gimgsrc`, `gbtnlabel`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        $stmt->bind_param("ssss", $gameName, $description, $imageSrc, $buttonLabel);
    
        if ($stmt->execute()) {
            echo "<div class='success-message'> Game added successfully";
            header("Location: " . $_SERVER['REQUEST_URI'] . "?success=1");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "Form submitted successfully!";
        }
        $data = array(
            "gname" => $gameName,
            "gdescrip" => $description,
            "gimgsrc" => $imageSrc,
            "gbtnlabel" => $buttonLabel
        );

        // Merge the data into the dataFromDatabase array
        $dataFromDatabase[] = $data;

        // Encode the merged data as JSON
        $jsonMerged = json_encode($dataFromDatabase);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Bar</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="fake.css">
</head>
<div class="form-container" id="game-form-container">
    <button class="close-button" onclick="closeForm()"><i class='bx bx-cross'></i></button>
    <h2>Game Information Form</h2>
    <form id="game-form" action="" method="post">
        <div class="form-group">
            <label for="gameName">Game Name:</label>
            <input type="text" id="gameName" name="gameName" required>
        </div>
        <div class="form-group">
            <label for="description">Description (2 lines max):</label>
            <textarea id="description" name="description" rows="2" required></textarea>
        </div>
        <div class="form-group">
            <label for="imageSrc">Image Source (URL):</label>
            <input type="text" id="imageSrc" name="imageSrc" required>
        </div>
        <div class="form-group">
            <label for="buttonLabel">Button Label:</label>
            <input type="text" id="buttonLabel" name="buttonLabel" required>
        </div>
        <button type="submit" onclick="submitGameInfo()" class="submitgamedata">Submit</button>
    </form>
</div>
<button type="button" id="add-game-button" onclick="toggleForm()">Add Game</button>

<div class="data-container">
<?php
        if (!empty($mergedData)) {
            echo "<script>var gameData = " . $jsonMerged . ";</script>";
            foreach ($mergedData as $game) {
                echo "<div class='game-card'>";
                echo "<div class='game-description-content'>";
                echo "<h3>" . $game["gname"] . "</h3>";
                echo "<p>" . $game["gdescrip"] . "</p>";
                echo "<button>" . $game["gbtnlabel"] . "</button>";
                echo "</div>";
                echo "<div class='game-title-img'>";
                echo "<img src='" . $game["gimgsrc"] . "' alt='Game Image'>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No data found.";
        }
        ?>
</div>


<script>
    function toggleForm() {
    var formContainer = document.getElementById("game-form-container");
    if (formContainer.style.display === "none") {
        formContainer.style.display = "block";
    } else {
        formContainer.style.display = "none";
    }
    }
    function closeForm() {
        var formContainer = document.getElementById("game-form-container");
        formContainer.style.display = "none";
    }
    var gameData = <?php echo json_encode($dataFromDatabase); ?>;
</script>

</body>
</html>