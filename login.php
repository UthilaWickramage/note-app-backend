<?php
require "connection.php";
$registerDetails = json_decode(file_get_contents("php://input"));
$mobile = $registerDetails->mobile;
$password = $registerDetails->password;
$user = new stdClass();

if(empty($mobile)){
    $user->message="error";
}else if(empty($password)){
$user->message="error";
}else{
    $userRow = Database::select("SELECT * FROM `user` WHERE `user`.`mobile`='".$mobile."' AND `user`.`password`='".$password."'");
    if($userRow!=null){
        $arr = $userRow->fetch_assoc();
        
        $user->first_name=$arr["first_name"];
        $user->last_name=$arr["last_name"];
        $user->mobile=$arr["mobile"];
        $user->password=$arr["password"];
        $user->user_type=$arr["user_type"];
        $user->message="success";
        
    }else{
        $user->message="error";
    }
}


echo json_encode($user);

?>