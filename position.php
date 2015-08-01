<?php

if (isset($_REQUEST['uid']) and isset($_REQUEST['lat']) and isset($_REQUEST['lon'])) {
    $uid = intval($_REQUEST['uid']);
    $lat = floatval($_REQUEST['lat']);
    $lon = floatval($_REQUEST['lon']);
    updateUserPosition($uid, $lat, $lon);
}