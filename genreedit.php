<?php
include('connection.php');

if(isset($_POST['back'])){
    header("Location: genre.php");
}

if(isset($_POST['save'])){
    $id = $_GET['id'];
    $genre_name = $_POST['genre_name'];
    $results = mysqli_query($connection, "SELECT * FROM genreTBL WHERE genre_name = '$genre_name'");
    $row = mysqli_fetch_array($results);

    if(mysqli_num_rows($results) > 0){
        echo'<script>alert("Genre Already Exists!")</script>';
    } else {
        mysqli_query($connection, "UPDATE genreTBL SET genre_name='$genre_name' WHERE id = '$id'");
        echo '<script>alert("Genre Saved!")</script>';
        echo '<script>window.location.href = "genre.php"</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre Edit</title>
    <!-- LINK LATEST BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- LINK BOOTSRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
<form method="POST">
        <div class="vh-100">
            <div class="d-flex justify-content-start p-3">
            <button class="btn btn-primary" name="back">Back</button>
            </div>

            <?php
            $id = $_GET['id'];
            $results = mysqli_query($connection, "SELECT * FROM genreTBL WHERE id = '$id'");
            $row = mysqli_fetch_array($results);
            ?>

            <div class="d-flex justify-content-center align-items-center" style="height: 100%; padding-bottom: 150px !important;">
                <div class="row row-cols-1 gy-3 gx-0" style="width: 300px;">
                    <label for="">Genre Name</label>
                    <input type="text" name="genre_name" id="" placeholder="<?php echo $row['genre_name']?>" class="p-2 rounded">
                    <button class="btn btn-success" name="save">Save</button>
                </div>
            </div>
        </div>

    </form>



    <!-- LINK LATEST BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>