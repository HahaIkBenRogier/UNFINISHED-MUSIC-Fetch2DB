<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/conn_mysql.php';


		
	$sql = 'SELECT title, artist, album, CONCAT(title, " ", artist, " ", album) AS total FROM `music` WHERE `spotify_id` LIKE "" GROUP BY CONCAT(title, " ", artist, " ", album)';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "\r\n";
			echo "--------- \r\n";
			echo $row['total']."\r\n";
			$id = searchSpotify($row["title"], $row["artist"], $row["album"]);
			if (empty($id)) {
				echo "--------- \r\n";
				continue;
			} else {
				echo $id."\r\n";
				echo "--------- \r\n";
				echo "\r\n";
			}
			$sql2 = "SELECT id FROM `music` WHERE CONCAT(title, ' ', artist, ' ', album) = '".mysqli_real_escape_string($conn, $row['total'])."'";
			$result2 = $conn->query($sql2);
			if ($result2->num_rows > 0) {
				// output data of each row
				//echo $row['total']."\r\n";
				
				while($row2 = $result2->fetch_assoc()) {
					//print_r($row2);
					$sql3 = "UPDATE music SET spotify_id='".$id."' WHERE id=".$row2['id'];

					if ($conn->query($sql3) === TRUE) {
						echo $row['total']." (".$row2['id'].") updated successfully \r\n";
					} else {
						echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
					}				
				}
			} else {
				echo "\r\n";
				echo "0 results > ".$row['total'];
				echo "\r\n";
			}
			//echo $sql."\r\n";
			//print_r($row);	

		}
	} else {
		echo "geen results";
	}
	$conn->close();

	function searchSpotify($title, $artist, $album = NULL) {
		include __DIR__ . '/conn_spotify.php';
		$q = $title." ".$artist." ".$album;
		$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);
		
		if (!$results->tracks->items[0]->id) {
			$q = stripQuery($title, $artist, $album);
			$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);
		}
		
		if (!$results->tracks->items[0]->id) {
			$q = stripQuery($title, $artist);
			$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);

		}
		
		//print_r($results->tracks->items[0]);

		return $results->tracks->items[0]->id;
	}

	function stripQuery($title, $artist, $album = NULL){
		if (strpos($artist, " feat")) {
			$newartist = explode(" feat", $artist);
			$artist = $newartist[0];
		}
		if (strpos($artist, " featuring")) {
			$newartist = explode(" featuring", $artist);
			$artist = $newartist[0];
		}
		if (strpos($artist, " x ")) {
			$newartist = explode(" x ", $artist);
			$artist = $newartist[0];
		}
		if (strpos($artist, " ft.")) {
			$newartist = explode(" ft.", $artist);
			$artist = $newartist[0];
		}
		if (strpos($artist, "&")) {
			$newartist = explode("&", $artist);
			$artist = $newartist[0];
		}
		
		if (strpos($artist, " by")) {
			$newartist = explode(" by", $artist);
			$artist = $newartist[0];
		}
		
		if (strpos($title, " feat")) {
			$newartist = explode(" feat", $title);
			$title = $newartist[0];
		}
		
		if (strpos($title, " ft.")) {
			$newartist = explode(" ft.", $title);
			$title = $newartist[0];
		}
		
		if (strpos($title, "(")) {
			$newtrack = explode("(", $title);
			$title = $newtrack[0];
		}
		
		if (strpos($title, "-")) {
			$newtrack = explode("-", $title);
			$title = $newtrack[0];
		}
		
		if (strpos($title, "[")) {
			$newtrack = explode("[", $title);
			$title = $newtrack[0];
		}
		
		if (strpos($album, "(")) {
			$newtrack = explode("(", $album);
			$album = $newtrack[0];
		}
		
		if (strpos($album, "-")) {
			$newtrack = explode("-", $album);
			$album = $newtrack[0];
		}
		
		if (strpos($album, "[")) {
			$newtrack = explode("[", $album);
			$album = $newtrack[0];
		}
		
		$q = $title." ".$artist." ".$album;
		echo $q."\r\n";
		return $q;

	}
		
	?>