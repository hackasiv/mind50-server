<?php

/**
 * создание пользователя
 * lat и len храним в секундах, 1 секунда это ~30,83м
 */
$lat = floatval(isset($rout[2]) ? $rout[2] : 0);
$lon = floatval(isset($rout[3]) ? $rout[3] : 0);
$name = urldecode(isset($rout[4]) ? $rout[4] : '');
$name = mysql_real_escape_string($name);
$point = "POINT({$lat} {$lon})";
mysql_query("INSERT INTO `user` VALUES (null, '{$name}', PointFromText('{$point}'), null)");
$userUID = mysql_insert_id();
if ($name == '') {
    $name = 'Гость_' . $userUID;
    $name = mysql_real_escape_string($name);
    mysql_query("UPDATE `user` SET nick='{$name}' WHERE id={$userUID}");
}
print json_encode(array('uid' => $userUID));
