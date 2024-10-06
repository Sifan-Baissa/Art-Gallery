<?php
// Custom implementation of array_column for compatibility with PHP versions < 5.5.0

function readPaintings($file) {
    $paintings = [];
    $file = fopen($file, "r");
    while (($line = fgetcsv($file, 0, "~")) !== FALSE) {
        $paintings[] = [
            'painting_id' => $line[0],
            'artist_name' => $line[1],
            'title' => $line[2],
            'year' => $line[3],
            'width' => $line[4],
            'height' => $line[5],
            'price' => $line[6],
            'description' => $line[7],
            'wiki_link' => $line[8],
            'genre_name' => $line[9],
        ];
    }
    fclose($file);
    return $paintings;
}

if (!function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $result = [];
        foreach ($input as $row) {
            $value = isset($row[$columnKey]) ? $row[$columnKey] : null;
            if ($indexKey !== null) {
                $key = isset($row[$indexKey]) ? $row[$indexKey] : null;
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
}


function readArtists($file) {
    $artists = [];
    $file = fopen($file, "r");
    while (($line = fgetcsv($file, 0, "~")) !== FALSE) {
        $artists[] = [
            'artist_id' => $line[0],
            'artist_name' => $line[1],
            'nationality' => $line[2],
            'birth_year' => $line[3],
            'death_year' => $line[4],
            'description' => $line[5],
            'wiki_link' => $line[6],
        ];
    }
    fclose($file);
    return $artists;
}

$paintings = readPaintings('resources/paintings.txt');
$artists = readArtists('resources/artists.txt');
?>


