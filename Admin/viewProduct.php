<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: center; }
        th { background-color: #343a40; color: #fff; font-weight: bold; font-size: 14px; }
        td { border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        tr:hover { background-color: #f1f1f1; }
        img { max-width: 80px; border-radius: 5px; }
        .action-btns { display: flex; justify-content: center; gap: 10px; }
        .btn { padding: 8px 15px; font-size: 12px; border-radius: 5px; }
        .btn-warning { background-color: #ffc107; color: #fff; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; color: #fff; }
        .btn-danger:hover { background-color: #c82333; }
        .modal-header { background-color: #343a40; color: white; }
        .modal-footer { text-align: center; }
    </style>

</head>
<body>
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <h2>List Products</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr style="border-bottom: 2px solid black;">
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>REGULAR PRICE</th>
                        <th>SALE PRICE</th>
                        <th>IMAGE</th>
                        <th>ADMIN</th>
                        <th>UPDATE AT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include '../connection.php';
                        $sql = "SELECT crud_menu.*, crud_user.profile FROM crud_menu 
                                INNER JOIN crud_user ON crud_menu.user_id = crud_user.userId";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '
                                <tr style="border-bottom: 0.5px solid gray;">
                                    <td>'.$row['menu_id'].'</td>
                                    <td>'.$row['menu_name'].'</td>
                                    <td>'.$row['regular_price'].'</td>
                                    <td>'.$row['sale_price'].'</td>
                                    <td><img width="80" src="../uploads/'.$row['image'].'" alt="Product Image"></td>
                                    <td><img width="80" src="../uploads/'.$row['profile'].'" alt="Admin Profile"></td>
                                    <td>'.$row['update_at'].'</td>
                                    <td>
                                        <a href="edit_product.php?id='.$row['menu_id'].'" class="btn btn-warning" style="color: white;">Edit</a>
                                        <button class="btn btn-danger btnDelete" data-id="'.$row['menu_id'].'" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    </td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>   
    </div>

    <!-- Bootstrap Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <form action="function.php" method="POST">
                        <input type="hidden" name="menu_id" id="delete_id">
                        <button type="submit" class="btn btn-danger" name="delete">Yes, Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Delete Modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btnDelete").forEach(button => {
                button.addEventListener("click", function () {
                    let menuId = this.getAttribute("data-id");
                    document.getElementById("delete_id").value = menuId;
                });
            });
        });
    </script>
</body>
</html>
