<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Tours and travels</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Finds travel</h1>
    <?php if(isset($_SESSION['status']) && $_SESSION['status']==='errors'):
         $error =$_SESSION['error'];
         ?>
         <ul class="errors">
           <?php foreach($error as $e) :?>
            <li><?=$e?></li>
            <?php endforeach;?>
         </ul>
         <?php elseif(isset($_SESSION['status']) && $_SESSION['status']==='success') :
         $data =$_SESSION['data'];
         ?>
         <div class="success">
            <p>message sent successful</p>
            <p>Here are the dtails entered: </p>
            <ul>
                <li>Name :<em><?=esc_str($data['name'])?></em></li>
                <li>Email :<em><?= esc_str($data['email'])?></em></li>
                <li>seasion:<em><?= esc_str($data['seasion'])?></em></li>
                <li>Region:<em><?= esc_str($data['region'])?></em></li>
                <li>participant:<em><?= esc_str($data['participant'])?></em></li>
                <li>interets :<em><?= esc_str($data['interests'])?></em></li>
                <li>message :<em><?= esc_str($data['message'])?></em></li>
            </ul>
         </div>
         <div class="ideas">
            <h2>Here are some travel ideas based on the details you entered :</h2>
            <ul>
                <?php include ('destination.php');?>
                <?php foreach($destination[$data['region']]as $d):?>
                    <li>
                        <a href="#"><img src="<?= $d[0]?>" alt="<?=$d[1]?>"></a>
                        <h3><?=$d[1]?></h3>
                    </li>
                    <?php endforeach; ?>
            </ul>
         </div>
         <?php endif; ?>
    <form action="handle-form.php" method="post">
        <div class="field-group">
        <label for="name" class="field-title">First Name: </label>
        <input type="text" name="name" id="name" placeholder="Enter your name">
        </div>
        <div class="field-group">
        <label for="email" class="field-title">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email for contact">
        </div>
        <div class="field-group">
        <label for="rejion" class="field-title">Whare would you like to Go!</label>
        <select name="region" id="region">
            <option value="">--select a region--</option>
            <option value="Asia">Asia</option>
            <option value="Oceania">Oceania</option>
            <option value="Africa">Africa</option>
            <option value="Europe">Europe</option>
            <option value="North America">North America</option>
            <option value="Latin America">Latin America</option>
        </select>
        </div>
        <div class="field-group">
        <p class="field-title">Preferred seasion</p>
        <input type="radio" id ="summer" name="seasion" value="Summer">
        <label for="summer">Summer</label>
        <input type="radio" id ="winter" name="seasion" value="Winter">
        <label for="winter">Winter</label>
        <input type="radio" id ="spring" name="seasion" value="Spring">
        <label for="spring">Spring</label>
        <input type="radio" id ="autumn" name="seasion" value="Autumn">
        <label for="autumn">Autumn</label>
        <input type="radio" id ="monsoon" name="seasion" value="Monsoon">
        <label for="monsoon">Monsoon</label>
        </div>
        <div class="field-group">
        <p class="field-title">Your interests:</p>
        <input type="checkbox" name="interests[]" id="photography" value="Photography">
        <label for="photography">Photography</label>
        <input type="checkbox" name="interests[]" id="trekking" value="Trekking">
        <label for="trekking">Trekking</label>
        <input type="checkbox" name="interests[]" id="star-gazing" value="Star-gazing">
        <label for="star-gazing">Star-gazing</label>
        <input type="checkbox" name="interests[]" id="bird-watching" value="Bird-watching">
        <label for="bird-watching">Bird-watching</label>
        <input type="checkbox" name="interests[]" id="camping" value="Camping">
        <label for="camping">Camping</label>
        </div>
         <div class="field-group">
        <label for="participant" class="field-title">No. of participant</label>
        <input type="number" name="participant" id="participant">
        </div>
        <div class="field-group">
        <label for="message" class="field-title"> Tell about your requirements:</label>
        <textarea name="message" id="message"></textarea>
        </div>
        <div class="field-group">
        <input type="hidden" name="token" value="">
        <button type="submit">Send</button>
        </div>
    </form>
    </div>
</body>
</html>