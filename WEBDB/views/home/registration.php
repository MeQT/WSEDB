<?php 
    if(isset($_SESSION['MailError'])){
        echo $_SESSION['MailError'];
    }
?>
<form action="index.php?url=home/register" method="Post">
  <table>
      <tr>
          <td>
              <p class="text">Titel</p>
          </td>
          <td>
            <select name="Title">
                <option value=""> </option>
                <option value="Dr.">Dr.</option>
		<option value="Prof.">Prof.</option>
                <option value="Prof. Dr.">Prof. Dr.</option>
		<option value="Prof. Dipl.Kfm.">Prof. Dipl.-Kfm.</option>
            </select>
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Vorname</p>
          </td>
          <td>
              <input type="text" class="" name="FirstName" value="<?php echo filter_input(INPUT_POST, 'FirstName')?>">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['FirstNameCheck'])){
                echo $_SESSION['FirstNameCheck'];
              }
             ?>
          </td>
      </tr>
       <tr>
          <td>
              <p class="text">Nachname</p>
          </td>
          <td>
              <input type="text" class="" name="LastName" value="<?php echo filter_input(INPUT_POST, 'LastName')?>">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['LastNameCheck'])){
                echo $_SESSION['LastNameCheck'];
              }
             ?>
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Password</p>
          </td>
          <td>
              <input type="password" class="" name="Password">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['PasswordCheck'])){
                echo $_SESSION['PasswordCheck'];
              }
              if(isset($_SESSION['PasswordPairCheck'])){
                  echo $_SESSION['PasswordPairCheck'];
              }
             ?>
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Password <br>wiederholen</p>
          </td>
          <td>
              <input type="password" class="" name="RepeatPassword">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['RepeatPasswordCheck'])){
                echo $_SESSION['RepeatPasswordCheck'];
              }
             ?>
          </td>
      </tr>
      <tr>
      <tr>
          <td>
              <p class="text">Email-Adresse</p>
          </td>
          <td>
              <input type="text" class="" name="Email" value="<?php if(!isset($_SESSION['EmailCheck'])){ echo filter_input(INPUT_POST, 'Email');}?>">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['EmailCheck'])){
                echo $_SESSION['EmailCheck'];
              }
              if(isset($_SESSION['EmailPairCheck'])){
                  echo $_SESSION['EmailPairCheck'];
              }
             ?>
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Email-Adresse <br>wiederholen</p>
          </td>
          <td>
              <input type="text" class="" name="RepeatEmail" value="<?php if(!isset($_SESSION['RepeatEmailCheck'])){ echo filter_input(INPUT_POST, 'RepeatEmail');}?>">
          </td>
          <td>
            <?php 
              if(isset($_SESSION['RepeatEmailCheck'])){
                echo $_SESSION['RepeatEmailCheck'];
              }
             ?>
          </td>
      </tr>
      <tr>
      <tr>
          <td>
          </td>
          <td>
              <input type="submit" class="" value="registrieren"/>
          </td>
      </tr>
  </table>
</form>

