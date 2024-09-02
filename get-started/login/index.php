<?php
    require_once "../../connection.php";
    $login = $_POST['login'];
    $password =  $_POST['password'];
    //Check if user exist and validate password
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM users where username = ?");
            
    $stmt->bind_param('s', $login);

    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            if(password_verify($password, $data['password'])){
                session_start(); 
                if($data['verified']==false){
                    header('Location: ../confirm-email?userID='.$data['id']);
                }
                else{
                    // Password is correct and user is verified
                    session_start(); 
                    $_SESSION['is_logged']= true; 
                    $_SESSION['userID'] = $data['id'];
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['surname'] = $data['surname'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['verified'] = $data['verified'];
                    header('Location: ../../');
                }
            }
            else{
                session_start();
                $_SESSION['errSingIn']= "Błędny login lub hasło!";
                header('Location: ../');
            }
        }
    }
    else{
        session_start();
        $_SESSION['errSingIn']= "Błędny login lub hasło!";
        header('Location: ../');
    }
    $stmt->close();
    $conn->close();
?>
