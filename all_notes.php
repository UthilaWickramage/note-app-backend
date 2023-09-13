<?php
require "connection.php";
$userDetails = json_decode(file_get_contents("php://input"));
$mobile = $userDetails->mobile;
$notesArr = array();
$noteRow = Database::select("SELECT * FROM `note` WHERE `user_mobile`='".$mobile."'");
if($noteRow!=null){
$notes= $noteRow->num_rows;
for($i=0;$i<$notes;$i++){
    $noteSingle = $noteRow->fetch_assoc();
    $note = new stdClass();
    $note->title=$noteSingle["title"];
    $note->desc=$noteSingle["description"];
    $note->date_time=$noteSingle["date_time"];
    $note->note_text=$noteSingle["note_category"];
    array_push($notesArr,$note);
}
    
    echo json_encode($notesArr);
}else{
    $note = new stdClass();
    $note->message="error";
    echo json_encode($note);
}


?>