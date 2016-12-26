<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/table.js"></script>
  </head>
  <body >
      <div>
          <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            require_once 'models/user.php';
            if(isset($_SESSION['User'])){
                $user = unserialize($_SESSION['User']);
                if($user->title == ""){
                    echo 'Willkommen '.$user->firstName.' '.$user->lastName.'</br>';
                }
                else{
                    echo 'Willkommen '.$user->title.' '.$user->lastName.'</br>';
                }
                echo '<a href="index.php?url=nav/questions" class="btn btn-default">Meine Fragen</a>';
                echo '<a href="index.php?url=nav/questionairies" class="btn btn-default">Meine Fragebögen</a>';
                echo '<a href="index.php?url=nav/options" class="btn btn-default">Einstellungen</a>';
                echo '<a href="index.php?url=nav/adminpanel" class="btn btn-default">Adminpanel</a>';
                echo '<a href="index.php?url=nav/help" class="btn btn-default"><img src="assets/help_user.png" style="width:24px;height:24px;">Hilfe</a>';
                echo '<a href="index.php?url=home/logout" class="btn btn-default">Logout</a>';
                echo '<br>';
            }
            else{
                echo '<a href="index.php" class="btn btn-default">Home</a>';
                echo '<a href="index.php?url=nav/login" class="btn btn-default">Login</a>';
                echo '<a href="index.php?url=nav/registration" class="btn btn-default">Registrieren</a>';
                echo '<a href="index.php?url=nav/help" class="btn btn-default"><img src="assets/help_user.png" style="width:24px;height:24px;">Hilfe</a>';
                echo '<br>';
            }
            ?>
      </div>
