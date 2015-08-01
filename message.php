<?php

if (isset($_POST['message']) and isset($_POST['uid']) and isset($_POST['lat']) and isset($_POST['lon'])) {
    $message = mysql_real_escape_string($_POST['message']);
    $uid = intval($_POST['uid']);
    $lat = floatval($_POST['lat']);
    $lon = floatval($_POST['lon']);
    mysql_query("INSERT INTO `message` VALUES (null, {$uid}, '{$message}', null); ");
    mysql_query("UPDATE `user` SET lat={$lat}, lan={$lon} WHERE id={$uid}");
}