<?php 
    session_start();
    include 'connection.php';
    if(empty($_SESSION['name_email'])){
        echo '<script>window.location.href="Admin/login.php"</script>';
    }else{
        if($_SESSION['role']=='admin'){
            echo '<script>window.location.href="Admin/dashbord.php"</script>';
        }else{
            echo '<script>window.location.href="User/index.php"</script>';
        }
    }

?>