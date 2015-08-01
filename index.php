<?php

include('bd.php');
include('router.php');
if ($_GET['action'] == 'uid') {
    include('uid.php');
} else if ($_GET['message'] == 'uid') {
    include('message.php');
} else if ($_GET['position'] == 'uid') {
    include('position.php');
}

mysql_close($mysqlLink);