<?php
require "connection.php";
$registerDetails = json_decode(file_get_contents("php://input"));
$message = new stdClass();
$mobile = $registerDetails->mobile;
$first_name = $registerDetails->first_name;
$last_name = $registerDetails->last_name;
$user_type = $registerDetails->user_type;
$password = $registerDetails->password;

if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
    $message->text="Invalid Mobile No";
}else if($first_name==null){
$message->text="Enter first name";
}else if($last_name==null){
    $message->text="Enter last name";
    }else if($user_type==null){
        $message->text="Select user type";
        }else if($password==null){
            $message->text="Enter password";
            }else{
                Database::uid("INSERT INTO `user`(`mobile`,`first_name`,`last_name`,`password`,`user_type`) VALUES
                ('".$mobile."','".$first_name."','".$last_name."','".$password."','".$user_type."') ");
               
               
               $message->text="success";
            }

echo json_encode($message);
