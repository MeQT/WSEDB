<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   
if(isset($_SESSION['User'])){
        header("Location: index.php?url=home");
    }
?>
<div class ="container" >
<h3> Bitte geben Sie hier Ihre Daten ein </h3></br>
<form action="index.php?url=home/login" method="Post">
    <div class ="form-group">
    <label class="control-label" for="Username">Benutzername</label>
    <input type="text" class="form-control" name="Username" placeholder ="Benutzername" value="<?php echo filter_input(INPUT_POST, 'Username')?>">
     <?php 
              if(isset($_SESSION['UsernameCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['UsernameCheck'];
                echo '</span>';
              }
              ?>
    </div>
    <div class ="form-group">
    <label class="control-label" for="Username">Passwort</label>
    <input type="password" class="form-control" name="Password" placeholder ="Passwort" value="<?php echo filter_input(INPUT_POST, 'Password')?>">
     <?php 
              if(isset($_SESSION['PasswordCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['PasswordCheck'];
                echo '</span>';
              }
              ?>
    </div> 
    <input type="submit" class="btn btn-primary" value="Einloggen"/> 
              <a href="index.php?url=nav/lostpw" class="btn btn-primary">Passwort zurücksetzen</a>
              <?php 
              if(isset($_SESSION['LoginValidation'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['LoginValidation'];
                echo '</span>';
              }
              ?>
</form>
</div>

