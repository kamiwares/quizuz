<?php
    session_start();
    if(isset($_GET['userID'])){

    }
    else{
        header('Location: ../');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizuz- Get Started!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@200;400;500;700&display=swap" rel="stylesheet"></head>
    <link rel="stylesheet" href="css/main.css">
    <script defer src="js/script.js"></script>
</head>
<body>
    <main>
        <div class="header">
            <h1>Quizuz</h1>
            <p>Dołącz do grupy ponad 2 użytkowników portalu Quizuz i popraw swoje wyniki w nauce!</p>
        </div>
        <div class="register-section">
            <h1>Potwierdź swój adres email</h1>
            <p>W celu dokończenia rejestracji wpisz kod wysłany na mail.</p>
            <p>Sprawdź również folder SPAM</p>
            <form class="login-form" class="login-form" action="process/?userID=<?php echo $_GET['userID'];?>" method="post">
                <div class="confirm-wrapper">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                    <input name="code[]" autocomplete="off" required type="text" maxlength="1">
                </div>
                <input class="button" type="submit" value="Zweryfikuj">
            </form>
            <span class="err">
                <?php
                if(isset($_SESSION['errVerification'])){
                    echo $_SESSION['errVerification'];
                }
                ?>
            </span>
        </div>
    </main>
</body>
</html>
<?php
    session_destroy();
?>