<?php

$distans = 50;

function updateUserPosition($userUID, $lat, $lon) {
    $point = "POINT({$lat} {$lon})";
    /**
     * Проверка существовани пользователя
     */
    $user = mysql_fetch_assoc(mysql_query("SELECT id FROM `user` WHERE id={$userUID}"));
    if (!isset($user['id'])) {
        print json_encode(array('error' => 'uid not exist'));
        exit();
    }
    /**
     * пользователь есть, обновляем его позицию
     */
    mysql_query("UPDATE `user` SET  PointFromText('{$point}') WHERE id={$userUID}");
}

function getCount($lat, $lon) {
    global $distans;
    $countLink = mysql_query("SELECT count(*) AS n
FROM `user` AS u
WHERE (geodist(X(u.geo), Y(u.geo), {$lat}, {$lon})*1000)<={$distans}");
    $count = mysql_fetch_assoc($countLink);
    return $count['n'];
}

/**
 * дистанция опправки в метрах
 */
$mysqlLink = mysql_connect('localhost', 'root', '');
if (!$mysqlLink) {
    die('Ошибка соединения: ' . mysql_error());
}
mysql_select_db('mind50', $mysqlLink);
mysql_query("set names 'utf8'");
