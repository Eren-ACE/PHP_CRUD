<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmfgEsISgcMna9mdI-t_XY7o-WkAI0ctitvg&s">
    <link rel="icon" href="icon_path" type="../logo/programmer-code-logo-in-a-modern-style-Graphics-7189077-1-copy.jpg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    form{
        width: 380px;
        padding: 30px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        margin:80px auto;
        
    }
</style>
<body>
   <div class="container-fluid">
        <form action="function.php" method="post">
            <h3 class="text-center">Login</h3>
            <div class="form-group">
                <label for="name_email" class="form-label">Username/Email</label>
                <input type="text" name="name_email" id="name_email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group mt-3 d-flex flex-column align-items-center">
                <a href="register.php">Don`t have account?</a>
                <button type="submit" class="btn btn-primary mt-3 w-100" name="login">Login</button>
            </div>
        </form>
   </div> 
</body>
</html>


