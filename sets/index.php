<?php
session_start();
require_once "../connection.php";
if(isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true){
    $logged = $_SESSION['is_logged'];
    $name = $_SESSION['name'];
    $userID = $_SESSION['userID'];
}
if (isset($_GET['user'])) {
    $userID = $_GET['user'];
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM users where id = ?");

    $stmt->bind_param('s', $userID);

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $surname = $data['surname'];
            $name = $data['name'];
            $username = $data['username'];
        }
    } else {
        header('Location: ../?error');
    }
    $stmt->close();
    $conn->close();
} else {
    header('Location: ../?error');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($logged)) {
        include('../assets/navbar/navbaruser.php');
    } else {
        include('../assets/navbar/navbar.php');
    }
    ?>
    <div class="section">
        <div class="container">
            <div class="creator-info">
                <div class="creator-img">

                </div>
                <div class="creator-desc">
                    <p>
                        <?php
                        if (isset($_GET['user'])) {
                            echo $username;
                        }
                        ?>
                    </p>
                    <p>
                        <?php
                        if (isset($_GET['user'])) {
                            echo $name . " " . $surname;
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="select-collection">
                <div class="collections-list">
                    <?php
                    require_once "../connection.php";

                    $conn = new mysqli($host, $db_user, $db_password, $db_name);

                    $sql = "SELECT * from collection_quizuz WHERE owner_id = '$userID' ORDER BY `collection_quizuz`.`created_at` ASC;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $sqlElements = "SELECT * from elements_quizuz where id_collection=" . '"' . $row['id'] . '"';

                            $resultElements = $conn->query($sqlElements);
                            $counter = 0;
                            if ($resultElements !== false && $resultElements->num_rows > 0) {
                                while ($rowElements = $resultElements->fetch_assoc()) {
                                    $counter++;
                                }
                            } else {
                                $counter = 0;
                            }
                            echo '<div class="collection-item">';
                            echo '<a href="../collection/?collection=' . $row['id'] . '">';
                            echo '<p>';
                            echo $counter . ' pojęć';
                            echo '</p>';
                            echo '<p>' . $row['title'] . '</p>';
                            echo '<span></span>';
                            echo '</a>';
                            echo '</div>';
                            $counter = 0;
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['success'])) {
        echo '<div class="notification notification_succ">
            <div class="notification_body">
                <img
                    src="./img/icons/success.svg"
                    alt="Succes"
                    class="notification_icon"
                >
                Udało się! &#128640; 
            </div>
            <div class="notification_progress notification_progress_succ"></div>
        </div>';
    }
    if (isset($_GET['error'])) {
        echo '<div class="notification notification_err">
            <div class="notification_body">
                <img
                    src="./img/icons/error.svg"
                    alt="Succes"
                    class="notification_icon"
                >
                Wystąpił błąd! &#128557;
            </div>
            <div class="notification_progress notification_progress_err"></div>
        </div>';
    }
    ?>
</body>

</html>