<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="dashboard">
        <?php
            include 'sidebar.php';
        ?>
        <div class="main-content">
            <h2>Add Product</h2>
            <form action="function.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="r_price" class="form-label">Regular Price</label>
                    <input type="number" name="r_price" id="r_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="s_price" class="form-label">Sale Price</label>
                    <input type="number" name="s_price" id="s_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Image" class="form-label">Image</label>
                    <input type="file" name="Image" id="Image" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-3 me -2" name="insert">Save</button>
                    <button class="btn btn-danger mt-3 me -2"><a href="viewProduct.php" style="text-decoration: none; color: white;">Cancel</a></button>
                </div>
            </form>
        </div>   
    </div>
     
</body>
</html>