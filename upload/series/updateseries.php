<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$handle = opendir('/series/updates/');
while (false !== ($file = readdir($handle))){
  print $file."\n";
  $xml = simplexml_load_file("/series/updates/".$file);
  if($xml != FALSE) {
	print "Parsing $file\n";
	mysql_connect("localhost","dow","8WWzzxbhv59mGPJT");
	mysql_select_db("tt2");
	
	$series = $xml->Series;
	foreach($xml->Episode as $episode) {
		$name = mysql_real_escape_string($episode->EpisodeName);
		$guests = mysql_real_escape_string($episode->GuestStars);
		$overview = mysql_real_escape_string($episode->Overview);
		$airdate = mysql_real_escape_string($episode->FirstAired);
		$epid = $episode->id;
		$season = $episode->SeasonNumber;
		$seriesid = $episode->seriesid;
		$episode = $episode->EpisodeNumber;
		$result = SQL_Query_exec("select tvdbid from episodes where tvdbid = $epid");
		if(mysql_num_rows($result) < 1)
			$query = "insert into episodes(tvdbid,seriesid,name,number,season,gueststars,overview,firstaired) values ($epid,$seriesid,'$name',".(string)$episode.",".(string)$season.",'$guests','$overview','$airdate')";
		else
			$query = "update episodes set name='$name',number=".(string)$episode.",season=".(string)$season.",gueststars='$guests',overview='$overview',firstaired='$airdate' where tvdbid=$epid";
		print $query."<br>";
		//$res = SQL_Query_exec($query);
	}
  }
}
?>
