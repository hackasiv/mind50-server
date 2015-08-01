<?php

function updateUserPosition($userUID, $lat, $lon) {
    $point = "POINT({$lat} {$lon})";
    mysql_query("UPDATE `user` SET  PointFromText('{$point}') WHERE id={$userUID}");
}

$mysqlLink = mysql_connect('localhost', 'root', '');
if (!$mysqlLink) {
    die('Ошибка соединения: ' . mysql_error());
}
mysql_select_db('mind50', $mysqlLink);
mysql_query("set names 'utf8'");
