<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
      <div>
          <a href="index.php" class="btn btn-default">Home</a>              
          <?php 
          if(isset($_SESSION['User'])){
              echo '<a href="index,php?url=home/logout" class="btn btn-default">Logout</a>';
          }
          else{
              echo '<a href="index,php?url=home/showLogin" class="btn btn-default">Login</a>';
              echo '<a href="index,php?url=home/showRegister" class="btn btn-default">Registrieren</a>';
          }?>
          <a href="index,php?url=help" class="btn btn-default">Hilfe</a> 
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

