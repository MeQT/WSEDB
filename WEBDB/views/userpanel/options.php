<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<div class="container">
<h3>Hier können Sie ihre Einstellungen tätigen </h3></br>
<h4>Passwort ändern</h4>

<form action="index.php?url=userpanel/updatePassword" method="Post">
    
<div class="form-group">
<label for="oldPassword">Altes Passwort</label>
<input type="password" class="form-control" name="oldPassword" placeholder="Altes Passwort" value="<?php if(!isset($_SESSION['OldPasswordCheck'])){ echo filter_input(INPUT_POST, 'oldPassword');}?>"/>
<?php 
              if(isset($_SESSION['OldPasswordCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['OldPasswordCheck'];
                echo '</span>';
              }              
             ?>
</div>

<div class="form-group">
<label for="newPassword">Neues Passwort</label>
<input type="password" class="form-control" name="newPassword" placeholder="Neues Passwort" value="<?php if(!isset($_SESSION['NewPasswordCheck'])){ echo filter_input(INPUT_POST, 'newPassword');}?>"/>
<?php 
              if(isset($_SESSION['NewPasswordCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['NewPasswordCheck'];
                echo '</span>';
              }
              if(isset($_SESSION['PasswordPairCheck'])){
              	echo  '<span id="hilfeText" class="help-block">';
              	echo $_SESSION['PasswordPairCheck'];
              	echo '</span>';
              }
             ?>
</div>

<div class="form-group">
<label for="confirmPassword">Neues Passwort wiederholen</label>
<input type="password" class="form-control" name="confirmPassword" placeholder="Neues Passwort" value="<?php echo filter_input(INPUT_POST, 'confirmPassword')?>"/>
<?php 
              if(isset($_SESSION['ConfirmPasswordCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['ConfirmPasswordCheck'];
                echo '</span>';
              }              
             ?>
</div>

<input type="submit" class="btn btn-primary" value="Speichern"/>
<?php 
              if(isset($_SESSION['UpdatePassword'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['UpdatePassword'];
                unset($_SESSION['UpdatePassword']);
                echo '</span>';
              }
              ?>
</form></br>

<h4> Email ändern</h4>
<form action="index.php?url=userpanel/updateEmail" method="Post">
<div class = "form-group">
<label for="newEmail">E-Mail-Adresse</label>
<input type="text" class="form-control" name="newEmail" placeholder="Neue E-Mail" value="<?php if(!isset($_SESSION['EmailCheck'])){ echo filter_input(INPUT_POST, 'newEmail');}?>"/>
<?php 
              if(isset($_SESSION['EmailCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['EmailCheck'];
                echo '</span>';
              }              
             ?>
</div>
<input type="submit" class="btn btn-primary" value="Speichern"/>
<?php 
              if(isset($_SESSION['UpdateEmail'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['UpdateEmail'];
                unset($_SESSION['UpdateEmail']);
                echo '</span>';
              }
              ?>
</form>

</div>



