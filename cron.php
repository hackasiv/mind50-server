<?php

include('bd.php');


$delList = mysql_query("SELECT id FROM `message` WHERE created_time < (NOW() - interval 5 MINUTE)");
$idList = array();
while ($item = mysql_fetch_assoc($delList)) {
    #$idList[] = $item['id'];
    mysql_query("DELETE FROM user_message WHERE message_id = {$item['id']}");
    mysql_query("DELETE FROM message WHERE id = {$item['id']}");
}
#$idList = implode(', ', $idList);
#mysql_query("DELETE FROM user_message WHERE message_id in ({$idList})");
#mysql_query("DELETE FROM message WHERE id in ({$idList})");
mysql_query("DELETE FROM user WHERE last_time < (NOW() - interval 10 MINUTE) LIMIT 100");
mysql_close($mysqlLink);
