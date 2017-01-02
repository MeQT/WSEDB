<div class="container">
<h3> Passwort ändern </h3></br>

<form action="index.php?url=userpanel/updatePassword" method="Post">
<div class="">
<label class="" for="oldPassword">altes Passwort:</label>
<input type="text" class="" name="oldPassword" placeholder="altes Passwort" value="<?php if(!isset($_SESSION['OldPasswordCheck'])){ echo filter_input(INPUT_POST, 'oldPassword');}?>"/>
<?php 
              if(isset($_SESSION['OldPasswordCheck'])){
                echo  '<span id="hilfeText" class="">';
                echo $_SESSION['OldPasswordCheck'];
                echo '</span>';
              }              
             ?>
</div>

<div class="">
<label class="" for="newPassword">neues Passwort:</label>
<input type="text" class="" name="newPassword" placeholder="neues Passwort" value="<?php if(!isset($_SESSION['NewPasswordCheck'])){ echo filter_input(INPUT_POST, 'newPassword');}?>"/>
<?php 
              if(isset($_SESSION['NewPasswordCheck'])){
                echo  '<span id="hilfeText" class="">';
                echo $_SESSION['NewPasswordCheck'];
                echo '</span>';
              }
              if(isset($_SESSION['PasswordPairCheck'])){
              	echo  '<span id="hilfeText" class="">';
              	echo $_SESSION['PasswordPairCheck'];
              	echo '</span>';
              }
             ?>
</div>

<div class="">
<label class="" for="confirmPassword">neues Passwort wiederholen:</label>
<input type="text" class="" name="confirmPassword" placeholder="Passwort" value="<?php echo filter_input(INPUT_POST, 'confirmPassword')?>"/>
<?php 
              if(isset($_SESSION['ConfirmPasswordCheck'])){
                echo  '<span id="hilfeText" class="">';
                echo $_SESSION['ConfirmPasswordCheck'];
                echo '</span>';
              }              
             ?>
</div>

<input type="submit" class="" value="Speichern"/>
<?php 
              if(isset($_SESSION['UpdatePassword'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['UpdatePassword'];
                unset($_SESSION['UpdatePassword']);
                echo '</span>';
              }
              ?>
</form></br>

<h3> Email ändern</h3></br>
<form action="index.php?url=userpanel/updateEmail" method="Post">
<div>
<label class="" for="newEmail">Email:</label>
<input type="text" class="" name="newEmail" placeholder="neue Email" value="<?php if(!isset($_SESSION['EmailCheck'])){ echo filter_input(INPUT_POST, 'newEmail');}?>"/>
<?php 
              if(isset($_SESSION['EmailCheck'])){
                echo  '<span id="hilfeText" class="">';
                echo $_SESSION['EmailCheck'];
                echo '</span>';
              }              
             ?>
</div>

<input type="submit" class="" value="Speichern"/>
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



