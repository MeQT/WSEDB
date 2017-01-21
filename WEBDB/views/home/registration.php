<?php 
    if(isset($_SESSION['MailError'])){
        echo $_SESSION['MailError'];
    }
    if(isset($_SESSION['EmailAlreadyUsed'])){
        echo $_SESSION['EmailAlreadyUsed'];
    }
?>
<div class = container >
<h3> Bitte geben Sie hier Ihre Daten ein </h3></br>
<form action="index.php?url=home/register" method="Post">
    <div class ="form-group">
        <label for ="Title">Titel</label>
        <select name="Title" class="form-control">
                <option value=""> </option>
                <option value="Dr.">Dr.</option>
		<option value="Prof.">Prof.</option>
                <option value="Prof. Dr.">Prof. Dr.</option>
		<option value="Prof. Dipl.Kfm.">Prof. Dipl.-Kfm.</option>
        </select>
    </div>
    <div class ="form-group">
    <label for="Vorname">Vorname</label>
    <input type="text" class="form-control" name="FirstName" placeholder ="Vorname" value="<?php echo filter_input(INPUT_POST, 'FirstName')?>">
    <?php 
              if(isset($_SESSION['FirstNameCheck'])){
                    echo '<span id="hilfeText" class="help-block">';
                    echo $_SESSION['FirstNameCheck'];
                    echo '</span>';
              }
             ?>
    
    </div>
    <div class ="form-group">
    <label for="Nachname">Nachname</label>
    <input type="text" class="form-control" name="LastName" placeholder ="Nachname" value="<?php echo filter_input(INPUT_POST, 'LastName')?>">
    <?php 
              if(isset($_SESSION['LastNameCheck'])){
                echo  '<span id="hilfeText" class="help-block">';
                echo $_SESSION['LastNameCheck'];
                echo '</span>';
              }
             ?>
    </div>
    <div class ="form-group">
    <label for="Password">Passwort</label>
    <input type="password" class="form-control" name="Password" placeholder ="Passwort" value="<?php if(!isset($_SESSION['PasswordCheck'])){ echo filter_input(INPUT_POST, 'Password');}?>">    
    <?php 
              if(isset($_SESSION['PasswordCheck'])){
                  echo  '<span id="hilfeText" class="help-block">';
                  echo $_SESSION['PasswordCheck'];
                  echo '</span>';
              }
              if(isset($_SESSION['PasswordPairCheck'])){
                  echo  '<span id="hilfeText" class="help-block">';
                  echo $_SESSION['PasswordPairCheck'];
                  echo '</span>';
              }
             ?>
    </div>
    <div class ="form-group">
    <label for="RepeatPassword">Passwort wiederholen</label>
    <input type="password" class="form-control" name="RepeatPassword" placeholder ="Passwort" value="<?php echo filter_input(INPUT_POST, 'RepeatPassword')?>">
    <?php 
              if(isset($_SESSION['RepeatPasswordCheck'])){
                  echo  '<span id="hilfeText" class="help-block">';
                  echo $_SESSION['RepeatPasswordCheck'];
                  echo '</span>';
              }
             ?>
    </div>
    <div class ="form-group">
    <label for="Email">E-Mail-Adresse</label>
    <input type="text" class="form-control" name="Email" placeholder ="E-Mail" value="<?php if(!isset($_SESSION['EmailCheck'])){ echo filter_input(INPUT_POST, 'Email');}?>">
    <?php 
              if(isset($_SESSION['EmailCheck'])){
                  echo  '<span id="hilfeText" class="help-block">';
                  echo $_SESSION['EmailCheck'];
                  echo '</span>';
              }
              if(isset($_SESSION['EmailPairCheck'])){
                  echo  '<span id="hilfeText" class="help-block">';
                  echo $_SESSION['EmailPairCheck'];
                  echo '</span>';
              }
             ?>            
    </div>
     <div class ="form-group">
    <label for="Email">E-Mail-Adresse wiederholen</label>
    <input type="text" class="form-control" name="RepeatEmail" placeholder ="E-Mail" value="<?php if(!isset($_SESSION['RepeatEmailCheck'])){ echo filter_input(INPUT_POST, 'RepeatEmail');}?>">
             <?php 
              if(isset($_SESSION['RepeatEmailCheck'])){
                 echo  '<span id="hilfeText" class="help-block">';
                 echo $_SESSION['RepeatEmailCheck'];
                 echo '</span>';
              }
             ?>           
    </div>    
              <input type="submit" class="btn btn-primary" value="Registrieren"/>
</form>
</div>

