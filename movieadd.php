<?php
include('connection.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $movie_name = $_POST['movie_name'];
    $movie_description = $_POST['movie_description'];
    $genre_ids = $_POST['genre_ids'];

    // Insert the data into the movieTBL table
    $stmt = $connection->prepare('INSERT INTO movieTBL (movie_name, movie_description, movie_genre) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $movie_name, $movie_description, $genre_string);
    $genre_string = implode(',', $genre_ids);
    if ($stmt->execute()) {
        echo 'Movie added successfully.';
    } else {
        echo 'Error adding movie: ' . $stmt->error;
    }
}

// Get the list of genres from the genreTBL table
$genres = [];
$result = $connection->query('SELECT id, genre_name FROM genreTBL');
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
}

// Close the database connection
$connection->close();

/**
 * Returns HTML markup for a list of checkboxes with the given name and options.
 *
 * @param string $name The name of the checkbox group.
 * @param array $options An array of options, where each option is an array with 'id' and 'name' keys.
 * @param array $selected_ids An array of IDs of the options that should be selected.
 * @return string The HTML markup for the checkbox group.
 */
function checkbox_group($name, $options, $selected_ids)
{
    $html = '';
    foreach ($options as $option) {
        $checked = in_array($option['id'], $selected_ids) ? 'checked' : '';
        $html .= '<input type="checkbox" name="' . $name . '[]" value="' . $option['id'] . '" ' . $checked . '> ' . $option['genre_name'] . '<br>';
    }
    return $html;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Movie</title>
</head>

<body>

    <h1>Add Movie</h1>

    <form method="POST" action="movieadd.php">
        <label for="movie_name">Movie Name:</label>
        <input type="text" name="movie_name" required>
        <br>
        <label for="movie_description">Movie Description:</label>
        <textarea name="movie_description" required></textarea>
        <br>
        <label for="genre_ids[]">Genres:</label>
        <?php echo checkbox_group('genre_ids', $genres, []); ?>
        <br>
        <button type="submit">Add Movie</button>
    </form>

</body>

</html>