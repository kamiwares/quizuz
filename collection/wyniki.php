<?php
    if($_GET['collection']==''){
        header('Location: ../?error');
    }
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true){
        $logged = $_SESSION['is_logged'];
        $name = $_SESSION['name'];
        $userID = $_SESSION['userID'];
    }
    require_once "../connection.php";
                    
                    $conn = new mysqli($host, $db_user, $db_password, $db_name);
                    $total =0;
                    $correct = 0;
                    $incorrect = 0;
                    $sql = "SELECT * from elements_quizuz where id_collection =".'"'.$_GET['collection'].'"';
                    $result = $conn->query($sql);
    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            if(strtoupper($_POST[$row['id_element']])===strtoupper($row['answer'])){
                                $correct++;
                            }
                            else{
                                $incorrect++;
                            }
                            $total++;
                        }
                    } else {
                        echo "0 results";
                    }
                    $percentage = floor($correct/$total*100);
                    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/collection.css">
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
            <div class="summary-wrapper">
                <h1>Wynik:<h2>
                <?php
                    echo $correct."/".$total;
                    echo "<br>";
                    echo $percentage."%";
                    $conn = new mysqli($host, $db_user, $db_password, $db_name);

                    $sql = "SELECT * from elements_quizuz where id_collection =".'"'.$_GET['collection'].'"';
                    $result = $conn->query($sql);
    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            if(strtoupper($_POST[$row['id_element']])===strtoupper($row['answer'])){
                                echo '<div class="element border-rounded">';
                                echo '<div class="select-collection">';
                                echo '<div class="collection-element">';
                                echo '<img src="../create-set/'.$row['image'].'">';
                                echo strtoupper($row['answer']);
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="select-answer-wrapper">';
                                echo '<div class="answer border-rounded correct">Twoja odpowiedź: '.$_POST[$row['id_element']].'</div>';
                                echo '<div class="answer border-rounded correct">Poprawna odpowiedź: '.strtoupper($row['answer']).'</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            else{
                                echo '<div class="element border-rounded">';
                                echo '<div class="select-collection">';
                                echo '<div class="collection-element">';
                                echo '<img src="../create-set/'.$row['image'].'"">';
                                echo strtoupper($row['answer']);
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="select-answer-wrapper">';
                                echo '<div class="answer border-rounded correct">Twoja odpowiedź: '.$_POST[$row['id_element']].'</div>';
                                echo '<div class="answer border-rounded incorrect">Poprawna odpowiedź: '.strtoupper($row['answer']).'</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();

                ?>
            </div>
        </div>
    </div>
</body>
</html>