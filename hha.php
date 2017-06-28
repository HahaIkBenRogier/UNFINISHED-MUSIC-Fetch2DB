<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script
		src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		crossorigin="anonymous"></script>
		<script src="Untitled 2.js" charset="utf-8"></script>
		<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
		</style>
	</head>
	<body>
		<?php
		require __DIR__ . '/vendor/autoload.php';
		require __DIR__ . '/conn_mysql.php';
		$offset = 0;
		$max = 20;
		if (isset($_GET['offset'])) {
			$offset = (int)$_GET['offset'];
		}
		$next = $offset + $max;
			
		$sql = 'SELECT *, CONCAT(title, " ", artist, " ", album) AS total FROM `music` GROUP BY CONCAT(title, " ", artist, " ", album) LIMIT '.$offset.','.$max;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) { ?>
			<div>
				<h1><?php echo $row['total'] ?></h1>
				<table id="<?php echo $row['id'] ?>" style="width:100%; border:1px solid black;">
				<?php $external = unserialize($row['external_ids']); ?>
					<tr>
						<th>Spotify</th>
						<th>iTunes</th> 
						<th>DB</th>
					</tr>
					<tr>
						<td class="spotify thumb"><img src="#" alt="description" width="250px" height="250px"></td>
						<td class="itunes thumb"><img src="#" alt="description" width="250px" height="250px"></td> 
						<td class="db thumb">
							<form method="post" enctype="multipart/form-data">
								<input type="file" name="fileToUpload" id="fileToUpload">
							</form>
						</td>
					</tr>
					<tr>
						<td class="spotify id"><?php echo $external[0]['Spotify'] ?></td>
						<td class="itunes id"><?php echo $external[1]['iTunes'] ?></td> 
					</tr>
					<tr>
						<td class="spotify query"><input type="text" value="<?php echo $row['total'] ?>" style="width:100%"></td>
						<td class="itunes query"><input type="text" value="<?php echo $row['total'] ?>" style="width:100%"></td> 
					</tr>
					<tr>
						<td class="spotify title"></td>
						<td class="itunes title"></td> 
						<td class="db title"><input type="text" value="<?php echo $row['title'] ?>" style="width:100%"></td>
					</tr>
					<tr>									
						<td class="spotify artist"></td>
						<td class="itunes artist"></td> 
						<td class="db artist"><input type="text" value="<?php echo $row['artist'] ?>" style="width:100%"></td>
					</tr>
					<tr>
						<td class="spotify album"></td>
						<td class="itunes album"></td> 
						<td class="db album"><input type="text" value="<?php echo $row['album'] ?>" style="width:100%"></td>
					</tr>
				</table>
				<input type="submit" id="doorvoeren" value="Opslaan">
				<hr>
				</div>
	<?php	}
		} else {
			echo "geen results";
		}
		$conn->close();
		?>
		<p><a href="<?php echo strtok($_SERVER["REQUEST_URI"],'?') . "?offset=" . $next; ?>">Volgende pagina</a></p>
	</body>
</html>