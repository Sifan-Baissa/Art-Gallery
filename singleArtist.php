<?php
include('read_text_files.php');

$artist_id = $_GET['id'];
$artist = null;
$artist_paintings = [];

// Find the selected artist by ID
foreach ($artists as $a) {
    if ($a['artist_id'] == $artist_id) {
        $artist = $a;
        break;
    }
}

// If the artist is not found, show an error
if ($artist === null) {
    die('Artist not found.');
}

// Find all paintings by the selected artist
foreach ($paintings as $painting) {
    if ($painting['artist_name'] == $artist['artist_name']) {
        $artist_paintings[] = $painting;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($artist['artist_name']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($artist['artist_name']); ?></h1>
    <nav>
        <h2><a href="index.php">Home</a></h2>
        <h2>Genres</h2>
        <ul>
            <?php
            $genres = array_unique(array_column($paintings, 'genre_name'));
            foreach ($genres as $genre) {
                echo "<li><a href=\"index.php?genre=" . htmlspecialchars($genre) . "\">" . htmlspecialchars($genre) . "</a></li>";
            }
            ?>
        </ul>
        <h2>Artists</h2>
        <ul>
            <?php
            foreach ($artists as $nav_artist) {
                echo "<li><a href=\"singleArtist.php?id=" . htmlspecialchars($nav_artist['artist_id']) . "\">" . htmlspecialchars($nav_artist['artist_name']) . "</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="container">
        <div>
            <img src="resources/artists/large/<?php echo htmlspecialchars($artist['artist_id']); ?>.jpg" alt="<?php echo htmlspecialchars($artist['artist_name']); ?>">
            <p>Nationality: <?php echo htmlspecialchars($artist['nationality']); ?></p>
            <p>Born: <?php echo htmlspecialchars($artist['birth_year']); ?></p>
            <p>Died: <?php echo htmlspecialchars($artist['death_year']); ?></p>
            <p>Description: <?php echo htmlspecialchars($artist['description']); ?></p>
            <p><a href="<?php echo htmlspecialchars($artist['wiki_link']); ?>">More Info</a></p>
        </div>
        <div>
            <h2>Paintings</h2>
            <ul>
                <?php
                // Display paintings by the selected artist
                foreach ($artist_paintings as $painting) {
                    echo "<li><a href=\"singlePainting.php?id=" . htmlspecialchars($painting['painting_id']) . "\">" . htmlspecialchars($painting['title']) . "</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>


