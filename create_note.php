<?php
require "connection.php";
$noteDetails = json_decode(file_get_contents("php://input"));
$title = $noteDetails->title;
$category = $noteDetails->category;
$description = $noteDetails->description;
$userMobile = $noteDetails->mobile;
$message = new stdClass();

 if(empty($title)){
    $message->text="Please enter title";
 }else if(empty($category)){
    $message->text="Please select a category";
 }else if(empty($category)){
    $message->text="Please enter description";
 }else{
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    
    Database::uid("INSERT INTO `note`(`title`,`description`,`date_time`,`note_category`,`status`,`user_mobile`) VALUES
     ('".$title."','".$description."','".$date."','".$category."',0,'".$userMobile."') ");
    
    $message->text="success";
 }

echo json_encode($message);

?>