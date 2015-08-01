<?php

if (!isset($_GET['uid'])) {
    /**
     * создание пользователя
     * lat и len храним в секундах, 1 секунда это ~30,83м
     */
    $lat = floatval(isset($rout[2]) ? $rout[2] : 0);
    $lon = floatval(isset($rout[3]) ? $rout[3] : 0);
    $name = mysql_real_escape_string($_GET['name']);
    $point = "POINT({$lat} {$lon})";
    mysql_query("INSERT INTO `user` VALUES (null, '{$name}', PointFromText('{$point}'), null)");
    $userUID = mysql_insert_id();
    print json_encode(array('uid' => $userUID));
} else {
    /**
     * пользователь есть
     */
    $userUID = intval($_GET['uid']);
    $lat = floatval($_GET['lat']);
    $lon = floatval($_GET['lon']);
    $point = "POINT({$lat} {$lon})";
    mysql_query("UPDATE `user` SET  PointFromText('{$point}') WHERE id={$userUID}");
    print json_encode(array('uid' => $userUID));
}
