<?php
if(isset($_SESSION['User'])){
        header("Location: index.php?url=home");
    }
?>
<form action="index.php?url=home/login" method="Post">
  <table>
      <tr>
          <td>
              <p class="text">Username</p>
          </td>
          <td>
              <input type="text" class="" name="Username" value="<?php echo filter_input(INPUT_POST, 'Username')?>">
          </td>
          <td>
              <?php 
              if(isset($_SESSION['UsernameCheck'])){
                echo $_SESSION['UsernameCheck'];
              }
              ?>
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Password</p>
          </td>
          <td>
              <input type="password" class="" name="Password" value="<?php echo filter_input(INPUT_POST, 'Password')?>">
          </td>
          <td>
              <?php 
              if(isset($_SESSION['PasswordCheck'])){
                echo $_SESSION['PasswordCheck'];
              }
              ?>
          </td>
      </tr>
      <tr>
          <td></td>
          <td>
              <input type="submit" class="btn btn-primary" value="einloggen!"/>
          </td>
          <td>
              <?php 
              if(isset($_SESSION['LoginValidation'])){
                echo $_SESSION['LoginValidation'];
              }
              ?>
          </td>
      </tr>
  </table>
</form>
<div>
    <a href="index.php?url=home/login" class="button" value="Password vergessen?">Password vergessen?</a>
</div>

