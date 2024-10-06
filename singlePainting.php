<?php
include('read_text_files.php');

$painting_id = $_GET['id'];
$painting = null;
foreach ($paintings as $p) {
    if ($p['painting_id'] == $painting_id) {
        $painting = $p;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $painting['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo $painting['title']; ?></h1>
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
        <div>
            <img src="resources/paintings/large/<?php echo $painting['painting_id']; ?>.jpg" alt="<?php echo $painting['title']; ?>">
            <p>Artist: <?php echo $painting['artist_name']; ?></p>
            <p>Year: <?php echo $painting['year']; ?></p>
            <p>Dimensions: <?php echo $painting['width']; ?> x <?php echo $painting['height']; ?></p>
            <p>Price: <?php echo $painting['price']; ?></p>
            <p>Genre: <?php echo $painting['genre_name']; ?></p>
            <p>Description: <?php echo $painting['description']; ?></p>
            <p><a href="<?php echo $painting['wiki_link']; ?>">More Info</a></p>
        </div>
    </div>
</body>
</html>



