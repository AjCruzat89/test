<?php
include('connection.php');

if (isset($_POST['add'])) {
    header("Location: genreadd.php");
}
    // PAGINATION
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $recordsPerPage = 8;
    $offset = ($page - 1) * $recordsPerPage;
    $query = "SELECT * FROM genreTBL LIMIT $recordsPerPage OFFSET $offset";
    $results = mysqli_query($connection, $query);
    $totalRecords = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM genreTBL"));
    $totalPages = ceil($totalRecords / $recordsPerPage);


    // IF THERES A SEARCH THERE SHOULD BE ONLY THE SAME AMOUNT FOR THE PAGINATION
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM genreTBL WHERE id LIKE '%$search%' OR genre_name LIKE '%$search%' LIMIT $recordsPerPage OFFSET $offset ";
    $results = mysqli_query($connection, $query);
    $totalRecords = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM genreTBL WHERE id LIKE '%$search%' OR genre_name LIKE '%$search%'"));
    $totalPages = ceil($totalRecords / $recordsPerPage);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
    <!-- LINK LATEST BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- LINK BOOTSRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDBOOTSTRAP -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />



</head>

<body>
    <div class="d-flex flex-row justify-content-between px-4 py-3">
        <div class="navbarfirst">
            <form method="GET">
                <input id="search" type="search" class="" name="search" placeholder="Search..." value="" />
            </form>
        </div>
        <form method="POST">
            <div class="navbarsecond">
                <button class="btn btn-primary" name="add">Add</button>
            </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Genre</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($results)) {
                echo '<tr>';
                echo '<th scope="row">' . $row['id'] . '</th>';
                echo '<td>' . $row['genre_name'] . '</td>';
                echo '<td class="">';
                echo '<a href="genreedit.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm crud-btn">Edit</a>';
                echo '<button type="button" class="btn btn-danger btn-sm crud-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteItem(' . $row['id'] . ')">Delete</button>';

                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <?php
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-start px-4">';

    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    ?>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    </form>


    <script>
        function deleteItem(id) {
            var deleteButton = document.getElementById('deleteButton');
            deleteButton.addEventListener('click', function() {
                window.location.href = 'genredelete.php?id=' + id;
            });
        }
    </script>
    <!-- LINK LATEST BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>