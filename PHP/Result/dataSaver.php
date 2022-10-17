<?php
require_once './Database.php';
require_once '../PHPMailer/credential.php';

$db = Database::getdb();
$email = $_POST['email'];
$fac = $_POST['fac'];
$time = $_POST['times'];
$hos = ucwords(strtolower($_POST['hos']));
$sTime = null;
$eTime = null;
$tempArr = stringToTime($time);
$sTime = $tempArr[0];
$eTime = $tempArr[1];

echo $sTime;

$db->saveUsermail($email, $fac, $hos, $sTime, $eTime);

function stringToTime(string $time)
{
    $times = array();
    $temp = explode('-', $time);

    foreach ($temp as $seperateTime) {
        array_push($times, getTimeFormat(trim($seperateTime)));

    }

    return $times;
}

function getTimeFormat($strtime):string
{
    $temp = explode(' ', $strtime);
    $time = $temp[0];
    $format = $temp[1];

    $temp = explode('.', $time);
    $hour = $temp[0];
    $min = $temp[1];
    if(strcmp($format, "p.m") == 0) {
        if($hour != 12){
            $hour+= 12;
        }
    }
    if($min < 10){
        $min = "0{$min}";
    }
    if($hour < 10){
        $hour = "0{$hour}";
    }

    $outputTime = "{$hour}:{$min}:00";

    return $outputTime;
}

?>