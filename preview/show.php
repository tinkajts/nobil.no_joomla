<?php
$csid=null;
if(isset($_GET['csid'])){
	$csid = htmlentities(trim($_GET['csid']));
}
$mal =file_get_contents('mal.html');
$mal = str_replace("IDEEEN", $csid, $mal);
echo $mal;