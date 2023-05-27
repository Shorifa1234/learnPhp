<?php
session_start();
$name ="";
$email ="";
$region ="";
$seasion="";
$interests="";
$participant=0;
$message ="";
$token ="";
$data =[];
/* validation is highly importants
lets go though each of the fields and check them
*/
$error =[];
// 0 .Token
// 1. name required alphaphets and space only
if(!empty($_POST['name'])){
    $name =$_POST['name'];
    if(ctype_alpha(str_replace("","",$name))===false){
        $error[] = "Name should contain alphabets and space";
    }
}else{
    $error[] ="Name field cannot be empty";
}
// 2.required,validated using filter_var function
if(!empty($_POST['email'])){
    $email= $_POST['email'];
    if(filter_var($email,FILTER_VALIDATE_EMAIL)!==$email){
        $error[]="email is not valid";
    }
}else{
    $error[]="email cannot be empty";
}
// 3.region, required value should be list
if(!empty($_POST['region'])){
     $region =$_POST['region'];
     $allowed_region=['Asia','Oceania','Africa','Europe','North America','Latin America'];
     if(!in_array($region,$allowed_region)){
        $error[]="Region not in the list";
     }
}else{
    $error[]="select a region from the list";
}
// 4. seasion ,not required ,but must be selected
if(!empty($_POST['seasion'])){
    $seasion = $_POST['seasion'];
    $allowed_seasion =['Summer','Winter','Spring','Autumn','Monsoon'];
    if(!in_array($seasion ,$allowed_seasion)){
        $error[]="Invalid seasion";
    }
}
// 5.interest not required
if(!empty($_POST['interests'])){
    $interests =$_POST['interests'];
    $allowed_interests =['Photography','Trekking','Star-gazing','Bird-watching','Camping'];
    foreach ($interests as $value) {
        if(!in_array($value ,$allowed_interests)){
            $error[]="The activity you selected is not in our list";
            break;
        }
    }
}
// 6. participants required 
if(!empty($_POST['participant'])){
      $participant = (int)$_POST['participant'];
      if($participant<1 || $participant>10){
        $error[]="No. of the participant mast be 1-10";
      }

}else{
    $error[]="Specify no. of participant";
}
// 7. message required, no htmltag ,js code just normal text
if(!empty($_POST['message'])){
    // $message = htmlentities($_POST['message'] ,ENT_QUOTES ,"UTF-8");
    // this is escaping ,we will do it  when outputting
    $message = $_POST['message'];
}else{
    $error[]= "Tell me about your message";
}
if($error){
    $_SESSION['status'] ='errors';
    $_SESSION['error'] =$error ;
    header('location:index.php?result=validation_errors');
}else{
    echo "All field correct";
    $data =[
      "name" => $name,
      "email" => $email,
      "region" => $region,
      "seasion" =>$seasion,
      "interests"=> implode(", ",$interests),
      "participant" =>$participant,
      "message" =>$message
    ];
    $_SESSION['status']='success';
    $_SESSION['data']=$data;
    header('location:index.php?result=success');
    die();
}
