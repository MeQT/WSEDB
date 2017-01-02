<?php 
if (!empty($data) && $data != -1)
{	    
	echo'<div class="container" >';
	echo '<table class="table"></br>';
	
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>eMail</th>";
	echo "<th>Zulassen</th>";
	echo "<th>Löschen</th>";
	echo "</tr>";	
	
	require_once 'models/user.php';
	foreach ($data as $entry)	
	{
		echo "<tr>";		
		echo '<td  class="col-md-3">'.$entry->firstName." ".$entry->lastName.'</td>';
		echo '<td  class="col-md-3">'.$entry->eMail.'</td>';
		echo '<form action="index.php?url=adminpanel/validateUser" method="Post">';
		echo '<input type = "hidden" name="personID" value ="'.$entry->id.'">';
		if ($entry->isAdmin == 0){
			if ($entry->isValidated == true){
				echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "validiert"/></td>';
				$validate = true;
			}
			else{
				echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "validieren "/></td>';
				$validate = false;
			}
		}
		else{
			if ($entry->isValidated == true){
				echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "validiert" disabled/></td>';
			}
			else{
				echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "validieren" disabled/></td>';
			}
		}
		echo '</form>';
		echo '<form action="index.php?url=adminpanel/deleteUser" method="Post">';
		echo '<input type = "hidden" name="personID" value ="'.$entry->id.'">';
		if ($entry->isAdmin == 0){
			echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "l&ouml;schen"/></td>';
		}
		else{
			echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "l&ouml;schen" disabled/></td>';
		}
		echo '</form>';
		echo "</tr>";		
	}
	echo "</table>\n";
	if (isset($_SESSION['DeleteUser'])){
		echo '<label>'.$_SESSION['DeleteUser'].'</label>';
		unset($_SESSION['DeleteUser']);
	}	
	if (isset($_SESSION['ValidateUser'])){
		echo '<label>'.$_SESSION['ValidateUser'].'</label>';
		unset($_SESSION['ValidateUser']);
	}
    echo '</div>';
}
?>


