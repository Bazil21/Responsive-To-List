<?php 

require 'db_con.php';


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>TO-DO List</title>
</head>
<body>
<div>
<span class="text">To Do List</span>
    <div class="container main-section">
        <div class="row add-section">
        <div class="col-md-8  mx-auto">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['Invalid']) && $_GET['Invalid'] == 'Input'){?>
                    <input  type="text"
                        name="title"
                        style="border: 2px solid #ff6666;"
                        placeholder="This field is required" 
                    />
                    <button type="submit">Add &nbsp; <spna>&#43;</span></button>
                <?php }else { ?>
                    <input  type="text"
                            name="title"
                            placeholder="What do you need to do ?" 
                    />
                    <button type="submit">Add &nbsp; <spna>&#43;</span></button>
                <?php } ?>
            </from>
        </div>
        </div>
        <?php 
            $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>
        <div class="row show-todo-section">
            <?php if($todos->rowCount() <= 0) { ?>
                <div class="col-md-6 mx-auto todo-item">
                    <div class="empty">
                    <img src="img/pexels-pixabay-236111.jpg" width="100%">
                    <img src="img/icon.gif" width="100%">
                    </div>
                </div>
            <?php } ?>  

        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) {?>

            <div class="col-md-8 todo-item">
            <span id="<?php echo $todo['id'];?>" class="remove-to-do">x</span>

                <?php if($todo['checked']) {?>
                <span><?php echo $todo['id'] ?></span>
                    <input type="checkbox"  data-todo-id="<?php echo $todo['id'];?>" class="check-box" checked />
                    <h2 class="checked"><?php echo $todo['title'] ?></h2>
                <?php }else { ?>
                    <span><?php echo $todo['id'] ?></span>
                    <input type="checkbox" data-todo-id="<?php echo $todo['id'];?>" class="check-box"/>
                    <h2><?php echo $todo['title']?></h2>
                <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time']?></small>
            </div>
        <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-git.js"></script>
    <script>
    $(document).ready(function(){
        $('.remove-to-do').click(function(){
        const id = $(this).attr('id');
        
        $.post("app/remove.php",
        {
            id: id
        },
        (data) => {
          
            if(data){
                $(this).parent().hide(600);
            }}
        );
});
    $(".check-box").click(function(e){
        const id = $(this).attr('data-todo-id');
        
        $.post('app/check.php',
        {
            id: id
        },
        (data) =>{
            if(data != 'error'){
                const h2 = $(this).next();
                if(data === '1'){
                    h2.removeClass('checked');
                }else{
                    h2.addClass('checked');
                }
            }
        }

            
        );
    });

});
</script>
</body>
</html>