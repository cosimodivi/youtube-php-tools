<?php /* Loading time script ->Not included in the Youtube-php-tools library */$loadtime = microtime(); $loadtime = explode(' ', $loadtime); $loadtime = $loadtime[1] + $loadtime[0] ;$start = $loadtime; ?>
<html>
	<head>
		<title>YTPHP TOOLS - DEMO 2</title>
	</head>
	<body>
		<center>
			<h3>Demo 2: Optimization with getVideoStatistics</h3>
			<a href="demo1.php">Previous demo</a>
			<form method="get">
				<input type="text" required name="youtube-url" placeholder="Youtube URL">
				<input type="submit" name="submit" value="Test">
			</form>
		<?php require('../youtube-php-tools.php'); 
		if(isset($_GET['submit'])){
			$id = getVideoId($_GET['youtube-url']);
			if(checkVideoId($id)) {
				/* getVideoStatistics($videoid, $title, $views, $likes, $dislikes, $comments)*/
				$vs = getVideoStatistics($id, 1, 1, 1, 1, 1);
				echo '<img src="'.getVideoThumbnail($id).'"> <br>';
				echo "Video ID: $id <br>"; 
				echo "Title: $vs[title]";
				echo "<br>Views: $vs[views]";
				echo "<br>Likes: $vs[likes] - Dislikes: $vs[dislikes]";
				echo "<br>Comments: $vs[comments]"; 
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