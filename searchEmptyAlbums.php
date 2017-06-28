<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/conn_mysql.php';


	
$sql = 'SELECT id, title, artist, album, CONCAT(title, " ", artist, " ", album) AS total FROM `music` WHERE `album` LIKE "s:%"';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		//print_r($row);
		$id = searchSpotify($row["title"], $row["artist"]);

				$sql3 = "UPDATE music SET album = '".mysqli_real_escape_string($conn,$id)."' WHERE id=".$row['id'];

				if ($conn->query($sql3) === TRUE) {
					echo $row['total']." (".$row2['id'].") updated successfully \r\n";
				} else {
					echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
				}				
		//echo $sql."\r\n";
		//print_r($row);	 */

	}
} else {
	echo "geen results";
}
$conn->close();

function searchSpotify($title, $artist, $album = NULL) {
	include __DIR__ . '/conn_spotify.php';
	$q = $title." ".$artist." ".$album;
	$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);
	
	if (!$results->tracks->items[0]->album->name) {
		$q = stripQuery($title, $artist, $album);
		$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);
	}
	
	if (!$results->tracks->items[0]->album->name) {
		$q = stripQuery($title, $artist);
		$results = $api->search($q, 'track', ['limit' => 1, 'market' => 'NL']);

	}
	
	//print_r($results->tracks->items[0]);

	return $results->tracks->items[0]->album->name;
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