<?php

$mysqlLink = mysql_connect('localhost', 'root', '');
if (!$mysqlLink) {
    die('Ошибка соединения: ' . mysql_error());
}
mysql_select_db('mind50', $mysqlLink);


