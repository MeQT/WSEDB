<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/tables.js"></script>
</head>
<body >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Waschlappen</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
  <?php   
		if (session_status() == PHP_SESSION_NONE) {          	
          	@session_start();          	
          }
            require_once 'models/user.php';
            if(isset($_SESSION['User'])){
                $user = unserialize($_SESSION['User']);
                if($user->title == ""){
                    
                    echo"<font color='585858'>Benutzer: $user->firstName $user->lastName</br></font>";
                }
                else{
                    echo 'Willkommen '.$user->title.' '.$user->lastName.'</br>';
                }
                //buttons die eingeloggter sieht;
                echo '<li class="active"><a href="index.php?url=nav/questions">Meine Fragen<span class="sr-only">(current)</span></a></li>';
                echo '<li><a href="index.php?url=nav/questionairies">Meine Fragebögen</a></li>';
                echo '<li class="active"><a href="index.php?url=nav/courses">Meine Kurse<span class="sr-only">(current)</span></a></li>';
                echo '<li><a href="index.php?url=nav/showSurveys">Meine Umfragen</a></li>';
                echo '<li class="active"><a href="index.php?url=nav/options">Einstellungen<span class="sr-only">(current)</span></a></li>';
                echo '<li><a href="index.php?url=nav/adminpanel">Administration</a></li>';
                echo '<li class="active"><a href="index.php?url=home/logout">Logout<span class="sr-only">(current)</span></a></li>';                
            }
            else{
                 echo '<li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>';
                 echo '<li><a href="index.php?url=nav/registration">Registrieren</a></li>';
                 echo '<li class="active"><a href="index.php?url=nav/login">Login<span class="sr-only">(current)</span></a></li>';               
            }               
            ?>   
       <ul class="nav navbar-nav navbar-right">
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="index.php?url=nav/help">Hilfe</a></li>
            <li><a href="#">Impressum</a></li>
            <li><a href="#">Platzhalter</a></li>
            </ul>
         </li>
      </ul>
      </ul>
    </div><!-- /.navbar-collapse --> 
  </div><!-- /.container-fluid -->
</nav>

        

   
                
