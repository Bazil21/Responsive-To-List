<?php 
if(isset($_POST['id'])){
    require '../db_con.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo 'error';
        
    }else{
        $todos = $conn->prepare("SELECT id, checked FROM  todos WHERE id=?");
        
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $amb = $todo['id'];
        $checked = $todo['checked'];
        $uncheck = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uncheck WHERE id=$amb");
        
        if($res){
            echo $checked;
        }
        else{
            echo "error";
        }
        $conn =null;
        exit();
    }
}else{
    header("Location: ../index.php?Invalid=Input");
}




?>