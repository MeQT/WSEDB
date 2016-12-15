<?php
if(null !== (filter_input(INPUT_POST, 'User'))){
        echo 'loggedin';
    }
?>


<form action="index.php?url=home/login" method="Post">
  <table>
      <tr>
          <td>
              <p class="text">Username</p>
          </td>
          <td>
              <input type="text" class="" name="Username">
          </td>
      </tr>
      <tr>
          <td>
              <p class="text">Password</p>
          </td>
          <td>
              <input type="password" class="" name="Password">
          </td>
      </tr>
      <tr>
          <td></td>
          <td>
              <input type="submit" class="button" value="einloggen!"/>
          </td>
      </tr>
  </table>
</form>
<div>
    <a href="index,php?url=home/login" class="button" value="Password vergessen?">Password vergessen?</a>
</div>

