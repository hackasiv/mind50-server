<?php

if (isset($_REQUEST['message']) and isset($_REQUEST['uid']) and isset($_REQUEST['lat']) and isset($_REQUEST['lon'])) {
    $message = strip_tags($_REQUEST['message']);
    $message = mysql_real_escape_string($message);
    if ($message == '' or strlen($message) > 2000) {
        return;
    }
    $uid = intval($_REQUEST['uid']);
    $lat = floatval($_REQUEST['lat']);
    $lon = floatval($_REQUEST['lon']);
    /**
     * обновление позиции пользователя
     */
    updateUserPosition($uid, $lat, $lon);
    /**
     * сохраняем сообщение
     */
    mysql_query("INSERT INTO `message` VALUES (null, {$uid}, '{$message}', null); ");
    $messageId = mysql_insert_id();
    mysql_query("UPDATE `user` SET lat={$lat}, lan={$lon} WHERE id={$uid}");
    /**
     * выбираем пользователей которые получать сообщение
     */
    $userLink = mysql_query("SELECT id
FROM `user` AS u
WHERE (geodist(X(u.geo), Y(u.geo), {$lat}, {$lon})*1000)<={$distans}");
    while ($user = mysql_fetch_assoc($userLink)) {
        mysql_query("INSERT INTO `user_message` VALUES ({$user['id']}, {$messageId}); ");
    }
    print json_encode(array('message' => 'accepted'));
} else {
    print json_encode(array('error' => 'incorect parametrs'));
}