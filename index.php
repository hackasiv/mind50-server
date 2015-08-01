<?php

include('bd.php');
include('router.php');
if ($_GET['action'] == 'uid') {
    include('uid.php');
} else if ($_GET['action'] == 'message') {
    include('message.php');
} else if ($_GET['action'] == '') {
    include('position.php');
}

mysql_close($mysqlLink);