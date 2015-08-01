<?php

header('Content-type: text/html; charset=utf8');
include('bd.php');
include('router.php');
if ($_GET['action'] == 'uid') {
    include('uid.php');
} else if ($_GET['action'] == 'message' and isset($_REQUEST['message'])) {
    include('messageInsert.php');
} else if ($_GET['action'] == 'message') {
    include('messageList.php');
} else if ($_GET['action'] == 'position') {
    include('position.php');
} else if ($_GET['action'] == 'web') {
    include("web.html");
}

mysql_close($mysqlLink);