<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETEC SHOP</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmfgEsISgcMna9mdI-t_XY7o-WkAI0ctitvg&s">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>
<?php 
    include "../connection.php";
    function moveFile($name){
        $image=rand(1,1000).'_'.$_FILES[$name]['name'];
        $tmp_name=$_FILES[$name]['tmp_name'];
        $path='../uploads/'.$image;
        move_uploaded_file($tmp_name,$path);
        return $image;
    }
    function signUp(){
        if(isset($_POST['signup'])){
            $username=htmlspecialchars($_POST['username']);
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $email=$_POST['email'];
            }
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
            $profile=moveFile('profile');
            if($username=='' && $email=='' && $password=='' && $profile==''){
                echo "Error";
            }else{  
                global $con;
                $sql="INSERT INTO `crud_user`( `userName`, `email`, `password`, `profile`) 
                VALUES ('$username','$email','$password','$profile')";
                if($con->query($sql)){
                    echo '<script>window.location.href="login.php"</script>';
                }
            }
        }
    }
    signUp();
    function login(){
        if(isset($_POST['login'])){
            $name_email=htmlspecialchars($_POST['name_email']);
            $password=$_POST['password'];
            global $con;
            $sql="SELECT `userName`, `email`, `password`, `role` FROM `crud_user` WHERE `userName`='$name_email' OR `email`='$name_email'";
            $result=$con->query($sql);
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $hashPassword=$row['password'];
                if(password_verify($password,$hashPassword)){
                   session_start();
                   $_SESSION['name_email']=$name_email;
                   $_SESSION['role']=$row['role'];
                     echo '<script>window.location.href="../index.php"</script>';
                }else{
                    echo '
                        <script>
                            Swal.fire({
                                title: "Not Found!",
                                text: "Invalid Password",
                                icon: "error"
                            }).then(() => {
                                window.location.href = "login.php";
                            });
                        </script>
                    ';
                }
            }else{
                echo '
                    <script>
                        Swal.fire({
                            title: "Not Found!",
                            text: "Invalid Username or Email!",
                            icon: "error"
                        }).then(() => {
                            window.location.href = "login.php";
                        });
                    </script>
                ';
            }
        }
    }
    login();

    function InsertProduct(){
        if(isset($_POST['insert'])){
            session_start();
            global $con;
            $user=$_SESSION['name_email'];
            $userId = "SELECT userId FROM crud_user WHERE username='$user' OR email='$user'";
            $result=$con->query($userId);
            $result = $con->query($userId);

            if ($result->num_rows > 0) {
                $id = $result->fetch_assoc()['userId'];
            } else {
                die("User not found.");
            }

            $pro_name=htmlspecialchars($_POST['name']);
            $r_price=$_POST['r_price'];
            $s_price=$_POST['s_price'];
            $image=moveFile('Image');
            $insert="INSERT INTO `crud_menu`( `menu_name`, `regular_price`, `sale_price`, `image`, `user_id`) 
            VALUES ('$pro_name','$r_price','$s_price','$image','$id')";
            if($con->query($insert)){
                echo '
                    <script>
                        window.location.href= "addProduct.php";
                    </script>
                ';

            }
        }
    }
    InsertProduct();

    function deleteProduct() {
        global $con;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            if (!isset($_POST['menu_id'])) {
                echo "<script>alert('Invalid request!'); window.location.href='viewProduct.php';</script>";
                exit;
            }
    
            $id = $_POST['menu_id'];
    
            $stmt = $con->prepare("DELETE FROM `crud_menu` WHERE `menu_id` = ?");
            $stmt->bind_param("i", $id);
    
            if ($stmt->execute()) {
                echo "<script>alert('Product deleted successfully!'); window.location.href='viewProduct.php';</script>";
            } else {
                echo "<script>alert('Error deleting product!');</script>";
            }
    
            $stmt->close();
            $con->close();
        }
    }
    deleteProduct();
    
    function editProduct() {
        global $con;    
        date_default_timezone_set('Asia/Shanghai');
        if (isset($_POST['update'])) {
            $menu_id = $_POST['menu_id'];
            $menu_name = $_POST['menu_name'];
            $regular_price = $_POST['regular_price'];
            $sale_price = $_POST['sale_price'];
            $update_at = date('Y-m-d H:i:s');
            // Handle Image Upload
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $target = "../uploads/" . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $image_query = ", image='$image'";
            } else {
                $image_query = "";
            }
    
            $update_sql = "UPDATE crud_menu SET update_at='$update_at', menu_name='$menu_name', regular_price='$regular_price', sale_price='$sale_price' $image_query WHERE menu_id=$menu_id";
    
            if ($con->query($update_sql)) {
                header("Location: viewProduct.php");
                exit();
            } else {
                echo "Update Failed: " . $con->error;
            }
        }
    }
    editProduct();
    
?>