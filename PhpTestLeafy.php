
<?php

require 'vendor/autoload.php';
$appID = "app_id:c7004b77";
$appKEY = "app_key:5634765e35bb30cc8068863bb21eeff5";
$leafly = new Leafly\Leafly($appID,$appKEY);
$leafly->location()->getMenu('location-slug');

?>

