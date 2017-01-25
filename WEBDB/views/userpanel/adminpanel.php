<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">   
    <script src="js/bootstrap-toggle.min.js"></script>     
</head>
<body>
<?php 
if (!empty($data) && $data != -1)
{	    
	echo'<div class="container" >';
        echo'<h3>Administration</h3>';
            if(isset($_SESSION['DeleteUser'])){
                echo '<div>';
                echo '<span id="hilfeText" class="help-block">';
                echo $_SESSION['DeleteUser'];
                unset($_SESSION['DeleteUser']);
                echo '</span>';
                echo '</div>';
            }
            if(isset($_SESSION['ValidateUser'])){
                echo '<div>';
                echo '<span id="hilfeText" class="help-block">';
                echo $_SESSION['ValidateUser'];
                unset($_SESSION['ValidateUser']);
                echo '</span>';
                echo '</div>';
            }
	echo '<table class="table"></br>';
	
	echo "<tr>";
	echo "<th>Name</th>";
        echo "<th>Benutzername</th>";
	echo "<th>E-Mail-Adresse</th>";
	echo "<th>Zulassen</th>";
	echo "<th>Löschen</th>";
	echo "</tr>";	
	
	require_once 'models/user.php';
	foreach ($data as $entry)	
	{		
		echo "<tr>";		
		echo '<td class="col-xs-4">'.$entry->firstName." ".$entry->lastName.'</td>';
                echo '<td class="col-xs-2">'.$entry->userName.'</td>';
		echo '<td class="col-xs-4">'.$entry->eMail.'</td>';
		echo '<form id="form1" action="index.php?url=adminpanel/validateUser" method="Post">';
		echo '<input type = "hidden" id="personID" name="personID" value="'.$entry->id.'">';
		if ($entry->isAdmin == 0){			
			if ($entry->isValidated == true){
				echo '<td class="col-md-3"><input id="'.$entry->id.'" type="checkbox" checked data-toggle="toggle" data-on="zugelassen" data-size="mini" data-width="30%"/></td>';
							
// 				$validate = true;
			}
			else{
				echo '<td class="col-md-3"><input id="'.$entry->id.'" type="checkbox" data-toggle="toggle" data-off="gesperrt" data-size="mini" data-width="30%"/></td>';					
				
// 				$validate = false;
			}
			echo '<script>';
			echo '$(function() {';
			echo '$("#'.$entry->id.'").change(function() {';
			//echo 'var success = confirm(\'Möchten Sie den Benutzer wirklich sperren?\');';
			//echo 'if(success == true) {';
			//echo 'OnChange="return confirm(\'Möchten Sie den Benutzer wirklich löschen?\');"';
			echo 'document.getElementById("personID").value="'.$entry->id.'";';
			//echo '$("#'.$entry->id.'").checked = true;';
			//echo 'document.getElementById("'.$entry->id.'").checked = true;';
			echo 'document.getElementById("form1").submit();';
			//echo 'document.getElementById("'.$entry->id.'").checked = false;';
			
			//echo 'if ('.$entry->isValidated.' == true) {';			
			//echo '}';
			//echo 'else {';			
			//echo '}';
			//echo '$("#'.$entry->id.'").prop("checked",true);';
			echo '	})';
			echo '})';
			echo '</script>';
		}
		else{
			if ($entry->isValidated == true){
				echo '<td class="col-xs-2"><input type="checkbox" checked data-toggle="toggle" data-on="zugelassen" data-size="mini" data-width="30%" disabled/></td>';
			}
			else{
				echo '<td class="col-xs-2"><input type="checkbox" data-toggle="toggle" data-off="gesperrt" data-size="mini" data-width="20%" disabled/></td>';
			}
		}
		echo '</form>';
		echo '<form action="index.php?url=adminpanel/deleteUser" method="Post">';
		echo '<input type = "hidden" name="personID" value ="'.$entry->id.'">';
		if ($entry->isAdmin == 0){
			echo '<td class="col-xs-2"><input type="submit" class="btn btn-primary btn-xs" value = "l&ouml;schen" OnClick="return confirm(\'Möchten Sie den Benutzer wirklich löschen?\');"/></td>';
		}
		else{
			echo '<td class="col-xs-2"><input type="submit" class="btn btn-primary btn-xs" value = "l&ouml;schen" disabled/></td>';
		}
		echo '</form>';
		echo "</tr>";		
	}
	echo "</table>\n";
    echo '</div>';
}
?>


</body>
</html>



