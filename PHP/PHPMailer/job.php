<?php

require_once '/home/kabilan/cs2062/Project/Master/CS2062/PHP/Result/Database.php';

require_once '/home/kabilan/cs2062/Project/Master/CS2062/PHP/PHPMailer/Mail.php';

$mailDatabase = Database::getdb();
$mailList = $mailDatabase->getMailUser();

foreach ($mailList as $mailDetail) {
    $email = $mailDetail[0];
    $hospital = $mailDetail[1];
    $facility = $mailDetail[2];
    $sTime = $mailDetail[3];
    $eTime = $mailDetail[4];
    $id = $mailDetail[5];
    var_dump("{$id}");
    $subject = "Requested Hospital Facility Notification";
    $body = "You requested for a reminder notification for {$facility} in {$hospital} at " . getTimeFormat($sTime) . ", which will close at ". getTimeFormat($eTime).".";
    
    $mail = new Mail($email, $subject, $body);
    if($mail->send()){
        $mailDatabase->updateRow("{$id}");

    }
}


function getTimeFormat(string $time): string
{
    $timeTempArray = explode(":", $time);
    $hour = (int)$timeTempArray[0];
    $min = (int)$timeTempArray[1];
    $format = "A.M";

    if($hour>12){
        $hour -= 12;
        $format = "P.M";
    }elseif($hour == 12 && $min>=0){
        $format = "P.M";
    }

    if($min < 10){
        $min = "0{$min}";
    }

    $output = "{$hour}:{$min} {$format}";

    return $output;
}

?>