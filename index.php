<?php
include('read_text_files.php'); // Ensure this file contains the readPaintings and readArtists functions
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Art Gallery</h1>
    <nav>
        <h2><a href="index.php">Home</a></h2>
        <h2>Genres</h2>
        <ul>
            <?php
            $genres = array_unique(array_column($paintings, 'genre_name'));
            foreach ($genres as $genre) {
                echo "<li><a href=\"index.php?genre=$genre\">$genre</a></li>";
            }
            ?>
        </ul>
        <h2>Artists</h2>
        <ul>
            <?php
            foreach ($artists as $artist) {
                echo "<li><a href=\"singleArtist.php?id={$artist['artist_id']}\">{$artist['artist_name']}</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="container">
        <?php
        foreach ($paintings as $painting) {
            if (!isset($_GET['genre']) || $_GET['genre'] === $painting['genre_name']) {
                // Find the correct artist for the current painting
                $artist = array_filter($artists, function($a) use ($painting) {
                    return $a['artist_name'] === $painting['artist_name'];
                });
                $artist = reset($artist); // Get the first element of the filtered array

                echo "<div>";
                echo "<a href=\"singlePainting.php?id={$painting['painting_id']}\"><img src=\"resources/paintings/large/{$painting['painting_id']}.jpg\" alt=\"{$painting['title']}\"></a>";
                echo "<p><a href=\"singlePainting.php?id={$painting['painting_id']}\">{$painting['title']}</a> by <a href=\"singleArtist.php?id={$artist['artist_id']}\">{$artist['artist_name']}</a></p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
<?php
// Fetching data from files, assuming these functions exist in read_text_files.php
$paintings = readPaintings('resources/paintings.txt');
$artists = readArtists('resources/artists.txt');
?>


