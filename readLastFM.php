<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/conn_mysql.php';
	require __DIR__ . '/conn_lastfm.php';
	
	$api = new LastFm();
	$page = 1;
	
	do {
		$call = $api->getTracks("rogiersangers", $page, "1493942400");
		echo "\r\n";
		echo "---------- Begin van pagina ".$page." ---------- \r\n";
		foreach ($call as $key => $value) {
			
			$Album = mysqli_real_escape_string($conn, $value["album"]["name"]);
			$AlbumArtist = mysqli_real_escape_string($conn, $value['artist']['name']);
			$Title = mysqli_real_escape_string($conn, $value["name"]);
			$Date_Listened = $value["date"];
			$source = "LastFM";
			$source_id = $value["mbid"];

			$sql = "INSERT INTO music (title, artist, album, source, source_id, date_listened)
			VALUES ('".$Title."', '".$AlbumArtist."', '".$Album."', '".$source."', '".$source_id."', '".$Date_Listened."')";
			if (mysqli_query($conn, $sql)) {
				echo $page." - ".$key." - ".$Title." created successfully \r\n";
			} else {
				echo "Error ".$page." - ".$key." - ".$Title.": " . mysqli_error($conn);
				echo "\r\n";
			}
			//echo $Date_Listened. "\r\n";
			
			//echo $page." - ".$value['name']."\r\n";
		}
		echo "---------- Einde van pagina ".$page." ---------- \r\n";
		echo "\r\n";
		$page++;
	} while ($page > 0)
	
	//
	
	//print_r($call)

?>