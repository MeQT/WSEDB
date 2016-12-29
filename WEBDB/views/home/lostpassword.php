<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   
if(isset($_SESSION['User'])){
        header("Location: index.php?url=home");
    }
?>
<div class="container">
<form method="POST" action="index.php?url=home/resetLogin">
    <?php 
        if(isset($_SESSION['PasswordChanged'])){
            echo $_SESSION['PasswordChanged'];
        }
    ?>
    <table>
        <tr>
            <td>Email-Adresse</td>
            <td><input type="text" name="Email"></td>
            <td><?php if(isset($_SESSION['EmailCheck'])){echo $_SESSION['EmailCheck'];}?></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Password zurücksetzen"></td>
        </tr>
    </table>
</form>
</div>