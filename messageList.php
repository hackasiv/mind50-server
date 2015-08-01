<?php

if (isset($rout[2]) and isset($rout[3]) and isset($rout[4])) {
    $uid = intval($rout[2]);
    $lat = floatval($rout[3]);
    $lon = floatval($rout[4]);
    updateUserPosition($uid, $lat, $lon);
    $mesLink = mysql_query("SELECT m.*, u.nick
FROM `user_message` AS um
JOIN `message` AS m ON (um.message_id=m.id)
JOIN `user` AS u ON (u.id = m.user_id)
WHERE um.user_id={$uid}
ORDER BY m.created_time desc");
    $sendMessages = array();
    $delList = array();
    while ($message = mysql_fetch_assoc($mesLink)) {
        $sendMessages[] = array('message' => $message['message'], 'nick' => $message['nick'],
            'uid' => $message['user_id'], 'time' => $message['created_time']);
        $delList[] = $message['id'];
    }
    mysql_query("DELETE FROM user_message " .
            "WHERE user_id={$uid} and message_id in (" . implode(', ', $delList) . ")");
    print json_encode($sendMessages);
}