<?php
    session_start();
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
        <div class="login-section">
            <h1>Zaloguj się</h1>
            <form class="login-form" class="login-form" action="login/" method="post">
                <label>Login</label>
                <input name="login" type="text">
                <label>Hasło</label>
                <input name="password" type="password">
                <span class="err">
                    <?php
                    if(isset($_SESSION['errSingIn'])){
                        echo $_SESSION['errSingIn'];
                    }
                    ?>
                </span>
                <div class="login-wrapper">
                    <input class="button" type="submit" value="Zaloguj się">
                    <span>
                        Masz już konto?
                    </span>
                    <div class="button" id="register">
                        Zarejestruj się
                    </div>
                </div>
            </form>
        </div>
        <div class="register-section">
            <h1>Zarejestruj się</h1>
            <form class="login-form" action="register/" method="post">
                <label>Login</label>
                <input required type="text" name="login">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errLogin'])){
                            echo $_SESSION['errLogin'];
                        }
                    ?>
                </span>
                <label>Imię</label>
                <input name="name" type="text">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errName'])){
                            echo $_SESSION['errName'];
                        }
                    ?>
                </span>
                <label>Nazwisko</label>
                <input name="surname" type="text">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errSurname'])){
                            echo $_SESSION['errSurname'];
                        }
                    ?>
                </span>
                <label required>Email</label>
                <input name="email" type="text">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errMail'])){
                            echo $_SESSION['errMail'];
                        }
                    ?>
                </span>
                <label required>Hasło</label>
                <input id="pass" name="password" type="password">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errPassword'])){
                            echo $_SESSION['errPassword'];
                        }
                    ?>
                </span>
                <label required>Powtórz hasło</label>
                <input id="passsec" name="password-repeat" type="password">
                <span class="err">
                    <?php
                        if(isset($_SESSION['errPasswordRepeat'])){
                            echo $_SESSION['errPasswordRepeat'];
                        }
                    ?>
                </span>
                <div class="login-wrapper">
                    <input class="button" type="submit" value="Zarejestruj się">
                    <span>
                        Masz już konto?
                    </span>
                    <div class="button" id="login">
                        Zaloguj się
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
    session_destroy();
?>