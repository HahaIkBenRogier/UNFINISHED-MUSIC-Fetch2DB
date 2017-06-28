<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/conn_mysql.php';
	
	$external = array();
	$SpotifyID = array("Spotify" => $_POST['spotify_id']);
	$iTunesID = array("iTunes" => $_POST['itunes_id']);
	array_push($external, $SpotifyID, $iTunesID);
	
	//print_r($_POST);
	
	$sql2 = "SELECT id FROM `music` WHERE CONCAT(title, ' ', artist, ' ', album) = '".mysqli_real_escape_string($conn, $_POST['total'])."'";
	//echo $sql2;
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
		
		while($row2 = $result2->fetch_assoc()) {
			//print_r($row2);
			$sql3 = "UPDATE music SET `external_ids` = '".serialize($external)."' WHERE id=".$row2['id'];
			if ($conn->query($sql3) === TRUE) {
				echo $row['total']." (".$row2['id'].") updated successfully \r\n";
			} else {
				echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
			}
			
			$sql3 = "UPDATE music SET `title` = '".mysqli_real_escape_string($conn,$_POST['db_title'])."' WHERE id=".$row2['id'];
			if ($conn->query($sql3) === TRUE) {
				echo $row['total']." (".$row2['id'].") updated successfully \r\n";
			} else {
				echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
			}
			
			$sql3 = "UPDATE music SET `artist` = '".mysqli_real_escape_string($conn,$_POST['db_artist'])."' WHERE id=".$row2['id'];
			if ($conn->query($sql3) === TRUE) {
				echo $row['total']." (".$row2['id'].") updated successfully \r\n";
			} else {
				echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
			} 
			
			$sql3 = "UPDATE music SET `album` = '".mysqli_real_escape_string($conn,$_POST['db_album'])."' WHERE id=".$row2['id'];
			if ($conn->query($sql3) === TRUE) {
				echo $row['total']." (".$row2['id'].") updated successfully \r\n";
			} else {
				echo "Error updating record ".$row2['id'].": " . $conn->error."\r\n";
			}
		}
	} else {
		echo "0 results";
	}

?>