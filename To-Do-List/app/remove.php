<?php 
if(isset($_POST['id'])){
    require '../db_con.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo 0;
        
    }else{
        $prepare = $conn->prepare("DELETE FROM todos WHERE id=?");
        $exe = $prepare->execute([$id]);

        if($exe){
            echo 1;
        }
        else{
            echo 0;
        }
        $conn =null;
        exit();
    }
}else{
    header("Location: ../index.php?Invalid=Input");
}




?>