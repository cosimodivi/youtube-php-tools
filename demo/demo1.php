<html>
	<head>
		<title>YTPHP TOOLS - DEMO 1</title>
	</head>
	<body>
		<center>
			<form method="get">
				<input type="text" required name="youtube-url" placeholder="Youtube URL">
				<input type="submit" name="submit" value="Test">
			</form>
		<?php require('../youtube-php-tools.php'); 
		if(isset($_GET['submit'])){
			$id = getVideoId($_GET['youtube-url']);
			echo '<img src="'.getVideoThumbnail($id).'"> <br>';
			echo "Video ID: $id <br>"; 
			echo 'Title: '.getVideoTitle($id);
		}
		?>
		</center>
	</body>
</html>