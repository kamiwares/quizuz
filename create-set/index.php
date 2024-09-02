<?php
    session_start();
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true){
        $logged = $_SESSION['is_logged'];
        $name = $_SESSION['name'];
        $userID = $_SESSION['userID'];
    }
    else{
        header('Location: ../get-started/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/create-set.css">
    <script src="js/active-input.js" defer></script>
    <script src="js/add-flashcard.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@200;400;500;700&display=swap" rel="stylesheet"></head>
<body>
    <?php
        if (isset($logged)) {
            include('../assets/navbar/navbaruser.php');
        } else {
            include('../assets/navbar/navbar.php');
        }
    ?>
    <div class="section">
        <div class="create-set-section">
            <div class="create-set-nav">
                <div class="create-set-nav-title">Stwórz nowy zestaw do nauki</div>
            </div>
            <div class="create-set-inputs">
                <form action="create-set.php" method="post" enctype="multipart/form-data">
                    <div class="create-set-input">
                        <label>Tytuł</label>
                        <input autocomplete="off" type="text" name="collection-name" placeholder="Wpisz tytuł, na przykład">
                    </div>
                    <div class="create-set-input">
                        <label>Opis</label>
                        <input autocomplete="off" name="collection-desc" type="text" placeholder="Dodaj opis...">
                    </div>
                    <div class="create-set-flashcard-section">
                        <div class="create-flashcard">
                            <div class="create-flascard-wrapper">
                                <div class="create-set-input">
                                    <label>Pojęcie</label>
                                    <input autocomplete="off" required name="answer[]" type="text" placeholder="POJĘCIE">
                                </div>
                                <div class="create-set-input">
                                    <label>Definicja</label>
                                    <input autocomplete="off" required name="def[]" type="text" placeholder="DEFINICJA">
                                </div>
                                <div class="create-set-input imgInpWrapper">
                                    <label>Zdjęcie</label>
                                    <input required class="imgInp" name="image[]" type="file" placeholder="Dodaj zdjęcie">
                                </div>
                                <div class="del-item">
                                    <img class="del-item-btn" src="../img/icons/bin-svgrepo-com.svg" alt="Usuń element">
                                </div>
                            </div>
                            <div class="imgPriev-wrapper">
                                <img class="imgPriev" src="">
                                <div class="del-img">
                                    <img src="../img/icons/delete.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="create-set-add-flashcard">
                        <div class="add-flashcard-button">Dodaj kolejną fiszkę</div>
                    </div>
                    <div class="create-set-add-flashcard">
                        <button type="submit" class="button">Stwórz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>