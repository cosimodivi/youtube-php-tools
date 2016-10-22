<?php
error_reporting(0);
// CONFIG
$googlekey = 'AIzaSyBhOjB06tYP0WpXzQwczp_22sBv6y22mW4'; // Please enter google key
// END CONFIG


/*	========================================================
	getVideoId Function:
		This function return the id of a youtube video url.
	========================================================   */
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
/*	========================================================
	getVideoThumbnail Function:
		This function return the thumbnail of a youtube video id.
	Arguments:
		videoid = Youtube video id;
		type = 0-1-2-3-4-hq-mq-sd-max (optional)
	========================================================   */
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
/*	========================================================
	getVideoTitle Function:
		This function return the title of a youtube video
	Arguments:
		videoid = Youtube video id;
	Required Google API Key (change it at top in config section)
	========================================================   */
function getVideoTitle($videoid) {
	global $googlekey;
	$videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=$videoid&key=$googlekey&fields=items(id,snippet(title),statistics)&part=snippet,statistics");
	if ($videoTitle) {
		$json = json_decode($videoTitle, true);
		return $json['items'][0]['snippet']['title'];
	} else {
		echo '<b>ERROR:</b> Error with Google Youtube API key! Change it in file '.dirname(__FILE__).'/'.basename(__FILE__, '.php');
	}
}

?>