<?php
error_reporting(0);
// CONFIG
$googlekey = ''; // Please enter google key
$error = '';
// END CONFIG
function getVideoId($videourl) {
	if (strpos($videourl,"v=") !== false)
    {
        return substr($videourl, strpos($videourl, "v=") + 2, 11);
    }
    elseif(strpos($videourl,"embed/") !== false)
    {
        return substr($videourl, strpos($videourl, "embed/") + 6, 11);
    }
}
function checkVideoId($videoid)
{
	global $googlekey;
	$videocheck = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet");
	if($videocheck) {
		$json = json_decode($videocheck, true);
		if(empty($json['items'])) return 0;
		else return 1;
	} else {
	echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php '); exit; }
}
function getVideoThumbnail($videoid, $type = 0) {
		if($type == 0) return "http://img.youtube.com/vi/$videoid/0.jpg";
	elseif($type == 1) return "http://img.youtube.com/vi/$videoid/1.jpg";
	elseif($type == 2) return "http://img.youtube.com/vi/$videoid/2.jpg";
	elseif($type == 3) return "http://img.youtube.com/vi/$videoid/3.jpg";
	elseif($type == 4) return "http://img.youtube.com/vi/$videoid/3.jpg";
	elseif($type == 'hq') return "http://img.youtube.com/vi/$videoid/hqdefault.jpg";
	elseif($type == 'mq') return "http://img.youtube.com/vi/$videoid/mqdefault.jpg";
	elseif($type == 'sd') return "http://img.youtube.com/vi/$videoid/sddefault.jpg";
	elseif($type == 'max') return "http://img.youtube.com/vi/$videoid/maxresdefault.jpg";
}
function getVideoTitle($videoid) {
	global $googlekey;
	$videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoTitle) {
		$json = json_decode($videoTitle, true);
		return $json['items'][0]['snippet']['title'];
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php ');
}
function getVideoViews($videoid) {
	global $googlekey;
	$videoViews = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoViews) {
		$json = json_decode($videoViews, true);
		return $json['items'][0]['statistics']['viewCount'];
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php ');
}
function getVideoLikes($videoid) {
	global $googlekey;
	$videoLikes = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoLikes) {
		$json = json_decode($videoLikes, true);
		return $json['items'][0]['statistics']['likeCount'];
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php');
}
function getVideoDislikes($videoid) {
	global $googlekey;
	$videoDislikes = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoDislikes) {
		$json = json_decode($videoDislikes, true);
		return $json['items'][0]['statistics']['dislikeCount'];
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php');
}
function getVideoComments($videoid) {
	global $googlekey;
	$videoComments = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoComments) {
		$json = json_decode($videoComments, true);
		return $json['items'][0]['statistics']['commentCount'];
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php');
}
function getVideoStatistics($videoid, $title = 0, $views = 0, $likes = 0, $dislikes = 0, $comments = 0)
{
	global $googlekey;
	$videoStatistics = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoStatistics) {
		$json = json_decode($videoStatistics, true);
			if($title == 1 && $views == 0 && $likes == 0 && $dislikes == 0 && $comments == 0)	
				return $json['items'][0]['snippet']['title'];
		elseif($title == 0 && $views == 1 && $likes == 0 && $dislikes == 0 && $comments == 0)
				return $json['items'][0]['statistics']['viewCount'];
		elseif($title == 0 && $views == 0 && $likes == 1 && $dislikes == 0 && $comments == 0)
				return $json['items'][0]['statistics']['likeCount'];
		elseif($title == 0 && $views == 0 && $likes == 0 && $dislikes == 1 && $comments == 0)
				return $json['items'][0]['statistics']['dislikeCount'];
		elseif($title == 0 && $views == 0 && $likes == 0 && $dislikes == 0 && $comments == 1)
				return $json['items'][0]['statistics']['commentCount'];
		else {
			$return = array('title' => '', 'views' => '', 'likes' => '', 'dislikes' => '', 'comments' => '');
			if($title)
				$return['title'] = $json['items'][0]['snippet']['title'];
			if($views)
				$return['views'] = $json['items'][0]['statistics']['viewCount'];
			if($likes)
				$return['likes'] = $json['items'][0]['statistics']['likeCount'];
			if($dislikes)
				$return['dislikes'] = $json['items'][0]['statistics']['dislikeCount'];
			if($comments)
				$return['comments'] = $json['items'][0]['statistics']['commentCount'];
			return $return;
		}		
	} else echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php');
}
/*
Created by Cosimo Diviesti aka acer620 - Download youtube-php-tools on Github!
https://github.com/cosimodivi/youtube-php-tools
Please do not delete this string, it's a little help to know my library to other people
*/
?>