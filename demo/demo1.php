<?php /* Loading time script ->Not included in the Youtube-php-tools library */$loadtime = microtime(); $loadtime = explode(' ', $loadtime); $loadtime = $loadtime[1] + $loadtime[0] ;$start = $loadtime; ?><html>
<html>
	<head>
		<title>YTPHP TOOLS - DEMO 1</title>
	</head>
	<body>
		<center>
			<h3>Demo 1: Basic functions</h3>
			<a href="demo2.php">Next demo</a>
			<form method="get">
				<input type="text" required name="youtube-url" placeholder="Youtube URL">
				<input type="submit" name="submit" value="Test">
			</form>
		<?php require('../youtube-php-tools.php'); 
		if(isset($_GET['submit'])){
			$id = getVideoId($_GET['youtube-url']);
			if(checkVideoId($id)) {
			echo '<img src="'.getVideoThumbnail($id).'"> <br>';
			echo "Video ID: $id <br>"; 
			echo 'Title: '.getVideoTitle($id);
			echo '<br>Views: '.getVideoViews($id);
			echo '<br>Likes: '.getVideoLikes($id).' - Dislikes: '.getVideoDislikes($id);
			echo '<br>Comments: '.getVideoComments($id); 
			} else echo 'ERROR: Youtube URL error. You must use this format: http://youtube.com/watch?v=youtubeid';
			
			// Loading time script ->Not included in the Youtube-php-tools library
			$loadtime = microtime();
			$loadtime = explode(' ', $loadtime);
			$loadtime = $loadtime[1] + $loadtime[0];
			$finish = $loadtime;
			$total_time = round(($finish - $start), 4);
			echo '<br><br>Page generated in '.$total_time.' seconds.';
		}
		?>
		</center>
	</body>
</html>