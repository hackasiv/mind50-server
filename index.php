<?php

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
}

mysql_close($mysqlLink);