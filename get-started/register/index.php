<?php
    // Validation
    session_start();
    require_once "../../connection.php";

    function randHash($len=32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
    }
    $err = 0;

    if(isset($_POST['login']) && ($_POST['login']!='')){
        if(preg_match("/^[a-zA-Z0-9]+$/", $_POST['login']) == 1) {
            $login = $_POST['login'];
            // Check if login is used 
            $conn = new mysqli($host, $db_user, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("select id from users where username = ?");
            
            $stmt->bind_param('s', $login);

            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() > 0) {
                $err = 1;
               $errLoginMsg="Nick zajęty!";
               $_SESSION['errLogin'] = $errLoginMsg;
            } else {
                echo "Nick wolny!";
            }
            $stmt->close();
            $conn->close();
        }
        else{
            $errLoginMsg =  "login nie może zawierać znaków specjalnych!";
            $_SESSION['errLogin'] = $errLoginMsg;
        }
    }
    else{
        echo "nie ma loginu";
        $err = 1;
        $errLoginMsg = "nie ma loginu";
        $_SESSION['errLogin'] = $errLoginMsg;
    }


    if(isset($_POST['name']) && ($_POST['name']!='')){
        if(preg_match("/^[a-zA-Z]+$/", $_POST['name']) == 1) {
            $name = $_POST['name'];
        }
        else{
            $err = 1;
            $errNameMsg = "W imieniu nie może być cyfr lub znaków specjalnych.";
            $_SESSION['errName'] = $errNameMsg;
        }
    }
    else{
        $errNameMsg = "nie ma name";
        $_SESSION['errName'] = $errNameMsg;
        $err = 1;
    }


    if(isset($_POST['surname']) && ($_POST['surname']!='')){
        if(preg_match("/^[a-zA-Z]+$/", $_POST['surname']) == 1) {
            $surname = $_POST['surname'];
        }
        else{
            $errSurnameMsg = "W nazwisku nie może być cyfr lub znaków specjalnych.";
            $_SESSION['errSurame'] = $errSurameMsg;
            $err = 1;
        }
    }
    else{
        $errSurnameMsg = "nie ma surname";
        $err = 1;
    }


    if(isset($_POST['email']) && ($_POST['email']!='')){
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if email is used 
            $conn = new mysqli($host, $db_user, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("select id from users where email = ?");
            
            $stmt->bind_param('s', $email);

            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() > 0) {
                $err = 1;
                $errEmailMsg = "Email jest w użyciu!";
                $_SESSION['errMail'] = $errEmailMsg;

            } else {
                echo "Email wolny!";
            }
            $stmt->close();
            $conn->close();
        } else {
            $errEmailMsg = "Email address '$email' is considered invalid.\n";
            $err = 1;
        }
    }
    else{
        $errMailMsg= "nie ma email";
        $_SESSION['errMail'] = $errEmailMsg;
        $err = 1;
    }


    if(isset($_POST['password']) && ($_POST['password']!='')){
        $password = $_POST['password'];
        if(strlen($password) < 8) {
            $errPasswordMsg = 'Hasło powinno mieć conajmniej 8 znaków!';
            $err = 1;
            $_SESSION['errPassword'] = $errPasswordMsg;
        }else{

            $passwordHash = password_hash($password ,PASSWORD_DEFAULT);
            echo $passwordHash;
        }
    }
    else{
        $errPasswordMsg = "nie ma password";
        $_SESSION['errPassword'] = $errPasswordMsg;
        $err = 1;
    }


    if(isset($_POST['password-repeat']) && ($_POST['password-repeat']!='')){
        $passwordRepeat = $_POST['password-repeat'];
        if($password==$passwordRepeat){
        }
        else{
            $errPasswordRepeatMsg = "Hasła się nie zgadzaja";
            $_SESSION['errPasswordRepeat'] = $errPasswordRepeatMsg;
            $err = 1;
        }
    }
    else{
        $errPasswordRepeatMsg = "nie ma password-repeat";
        $_SESSION['errPasswordRepeat'] = $errPasswordRepeatMsg;
        $err = 1;
    }




    if(!$err==0){
        echo "Nie udało się zarejestrować :'(";
        header('Location: ../');
    }
    else{
        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $randomUUID = randHash();
        $verificationCode = random_int(100000, 999999);

        $stmt = $conn->prepare("INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`, `verification_code`) VALUES (?, ?, ?, ?, ?, ?, ?);");

        $stmt->bind_param('sssssss', $randomUUID, $name, $surname, $login, $email, $passwordHash, $verificationCode);

        //Send verification code


        $stmt->execute();
        $stmt->close();
        $conn->close();


        $email2 = "Witaj ".$login."!";
        $message = "Twój kod weryfikacyjny to: ".$verificationCode."\n Jeśli nie chciałeś utworzyć konta w serwisie, po prostu zignoruj tę wiadomość. \n Zespół Quizuz"; 
        $email_moj = $email;
        $subject = "Weryfikacja użytkownika w serwisie Quizuz";

        $mail = mail($email_moj, $subject, $message, $email2);
            if($mail){
                echo "udało się";
                header('Location: ../confirm-email/?userID='.$randomUUID);
            }
            else{
                echo "Nie udało się";
            }
        };
?>