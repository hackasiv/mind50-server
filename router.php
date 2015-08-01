<?php

$rout = explode("/", $_SERVER["REQUEST_URI"]);
$_GET['action'] = isset($rout[1]) ? $rout[1] : '';
