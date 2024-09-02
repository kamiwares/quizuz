
<?php
    require_once "../../../connection.php";
    session_start();
    $code = implode($_POST['code']);
    $userID = $_GET['userID'];
    echo $userID;
    echo $code;


    $conn = new mysqli($host, $db_user, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id` LIKE ? AND `verification_code` = ?
            ");
            
            $stmt->bind_param('ss', $userID, $code);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() > 0) {
                $stmt = $conn->prepare("UPDATE `users` SET verified = 1 WHERE id = ?");
                $stmt->bind_param('s', $userID);
                $stmt->execute();
                header('Location: ../../');
            } else {
                echo "Wystąpił błąd";
                $errVerificationMsg="Wystąpił błąd";
                header('Location: ../?userID='.$userID);
                $_SESSION['errVerification'] = $errVerificationMsg;
            }
            $stmt->close();
            $conn->close();
?>