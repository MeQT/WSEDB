<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   
if(isset($_SESSION['User'])){
        header("Location: index.php?url=home");
    }
?>
<div class = container >
<h2> Bitte Daten eingeben </h2></br>
<form action="index.php?url=home/login" method="Post">
    <div class ="form-group">
    <label class="control-label" for="Username">Username</label>
    <input type="text" class="form-control" name="Username" placeholder =" Username" value="<?php echo filter_input(INPUT_POST, 'Username')?>">
     <?php 
              if(isset($_SESSION['UsernameCheck'])){
                echo $_SESSION['UsernameCheck'];
              }
              ?>
    </div>
    <div class ="form-group">
    <label class="control-label" for="Username">Password</label>
    <input type="password" class="form-control" name="Password" placeholder =" Password" value="<?php echo filter_input(INPUT_POST, 'Password')?>">
     <?php 
              if(isset($_SESSION['PasswordCheck'])){
                echo $_SESSION['PasswordCheck'];
              }
              ?>
    </div> 
              <input type="submit" class="btn btn-primary" value="einloggen"/> 
              <a href="index.php?url=nav/lostpw" class="btn btn-primary">Login zurücksetzen</a>
              <?php 
              if(isset($_SESSION['LoginValidation'])){
                echo $_SESSION['LoginValidation'];
              }
              ?>
</form>
</div>

