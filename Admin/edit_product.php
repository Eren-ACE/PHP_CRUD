<?php
include '../connection.php';

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];
    $query = "SELECT * FROM crud_menu WHERE menu_id = $menu_id";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
} else {
    echo "No product selected!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="dashboard">
        <?php
            include 'sidebar.php';
        ?>
        <div class="main-content">
            <h2>Edit Product</h2>
            <form action="function.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="menu_id" value="<?= $row['menu_id']; ?>">
                <div class="form-group">
                    <label for="menu_name" class="form-label">Name:</label>
                    <input type="text" name="menu_name" class="form-control" value="<?php echo $row['menu_name']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="regular_price" class="form-label">Regular Price:</label>
                    <input type="number" name="regular_price" class="form-control" value="<?php echo $row['regular_price']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="sale_price" class="form-label">Sale Price:</label>
                    <input type="number" name="sale_price" class="form-control" value="<?php echo $row['sale_price']; ?>" required>                  
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Current Image:</label><br>
                    <img src="../uploads/<?php echo $row['image']; ?>" width="100"><br>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">New Image:</label>
                    <input type="file" name="image" class="form-control"><br>    
                </div>
                <button type="submit" name="update" class="btn btn-success">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>
