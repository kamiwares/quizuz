<?php 
    if($_GET['collection']==''){
        header('Location: ../?error');
    }
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true){
        $logged = $_SESSION['is_logged'];
        $name = $_SESSION['name'];
        $userID = $_SESSION['userID'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/collection.css">
    <script src="../js/script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@200;400;500;700&display=swap" rel="stylesheet">
    <script src="js/main.js" defer></script>
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
        <div class="container border-rounded">
            <form action="wyniki.php?collection=<?php echo $_GET['collection'] ?>" method="post">
                <?php
                    require_once "../connection.php";
                    $collectionID = $_GET['collection'];
                    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    
                    $sql = "SELECT * from elements_quizuz where id_collection = ".'"'.$_GET['collection'].'"';
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="element">';
                            echo '<div class="select-collection">';
                            echo '<div class="collection-element">';
                            echo '<img src="../create-set/'.$row['image'].'">';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="select-answer-wrapper">';
                            echo '<div class="create-set-input">';
                            echo '<label>Co to jest?</label>';
                            echo '<input autocomplete="off" required name="'.$row['id_element'].'" type="text" placeholder="Odpowiedź">';
                            echo '</div>';
                            echo '<button class="button">Kolejne pytanie</button>';
                            echo '<h3 class="err">Wypełnij pole!</h3>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 results";
                    }
    
                    $conn->close();
                ?>
                <div class="summary">
                    <h1>Sprawdź wyniki</h1>
                    <button type="submit">Sprawdź</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>