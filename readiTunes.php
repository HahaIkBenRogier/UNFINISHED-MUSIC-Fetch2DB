<?php

require __DIR__ . '/conn_mysql.php';

$string = file_get_contents("iTunesLibr.json");
$json_a = json_decode($string, true);


foreach ($json_a as $key => $value) {
    if ($value["Kind"] == "MPEG-4-videobestand" || $value["Kind"] == "MPEG-4 video file") {
        continue;
    }
    
    $Album = mysqli_real_escape_string($conn, $value["Album"]);
    if ($value["Album Artist"]) {
        $AlbumArtist = mysqli_real_escape_string($conn, $value["Album Artist"]);
    } else {
        $AlbumArtist = mysqli_real_escape_string($conn, $value["Artist"]);
    }
    $Title = mysqli_real_escape_string($conn, $value["Name"]);
    $Duration_sec = $value["Total Time"]/1000;
    $Date_added = date("U",strtotime($value["Date Added"]));
    $Date_last_listened = -2082844800 + $value["Play Date"];
    $source = "iTunes";
    $source_id = $value["Track ID"];
    
    //echo $Date_added."\r\n";
    
    $count = $value["Play Count"];
    for($i=0; $i<$count; $i++) {
        $sql = "INSERT INTO music (title, artist, album, source, source_id, duration_sec, date_added, date_last_listened)
        VALUES ('".$Title."', '".$AlbumArtist."', '".$Album."', '".$source."', '".$source_id."', '".$Duration_sec."', '".$Date_added."', '".$Date_last_listened."')";
        if (mysqli_query($conn, $sql)) {
            echo $source_id." created successfully \r\n";
        } else {
            echo "Error ".$source_id.": " . $sql . "\r\n" . mysqli_error($conn);
        }
        echo "\r\n";
    }
}



?>