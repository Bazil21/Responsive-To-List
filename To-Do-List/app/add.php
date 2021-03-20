<?php 
if(isset($_POST['title'])){
    require '../db_con.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../index.php?Invalid=Input");
        
    }else{
        $prepare = $conn->prepare("INSERT INTO todos(title) VALUE
        (?)");
        $exe = $prepare->execute([$title]);

        if($exe){
            header("Location: ../index.php?valid=input");
        }
        else{
            header("Location: ../index.php");
        }
        $conn =null;
        exit();
    }
}else{
    header("Location: ../index.php?Invalid=Input");
}




?>