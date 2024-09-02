<?php
    require_once "../connection.php";
    session_start();
    $collectionName= $_POST['collection-name'];
    $collectionDesc = $_POST['collection-desc'];


    //Generate random UUID
    function randHash($len=32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
    }
    $randomUUID = randHash();

    //Creating collection

    $err =0; 
    print_r($_POST['collection-name']);
    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    $created_at = time();
    $userID = $_SESSION['userID'];
    $sql = "INSERT INTO `collection_quizuz` (`id`, `title`, `collection_desc`, `created_at`, `owner_id`) VALUES ('$randomUUID', '$collectionName', '$collectionDesc', '$created_at', '$userID');";
    $conn->query($sql);
    
    $elements = count($_POST['answer']);
    for ($i = 0; $i < $elements; $i++) {
        if (($_FILES['image']['name'][$i]!="")){
            $target_dir = "upload/";
            $file = $_FILES['image']['name'][$i];
            $path = pathinfo($file);
            $filename = randHash();
            $ext = $path['extension'];
            $temp_name = $_FILES['image']['tmp_name'][$i];
            $path_filename_ext = $target_dir.$filename.".".$ext;

            move_uploaded_file($temp_name,$path_filename_ext);
            echo "Congratulations! File Uploaded Successfully.";

            $def = $_POST['def'][$i];
            $answer = $_POST['answer'][$i];
            $randomElementUUID = randHash();
            $sql = "INSERT INTO `elements_quizuz` (`id_element`, `id_collection`, `answer`, `image`) VALUES ('$randomElementUUID','$randomUUID', '$answer', '$path_filename_ext');";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                $err = 1;
              }
        }
        else{
            $err = 1;
        }
    }
    $conn->close();
    if($err == 1){
        header('Location: ../?error');
    }
    else{
        header('Location: ../?success');
    }
?>