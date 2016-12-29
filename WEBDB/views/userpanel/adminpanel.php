<form action="index.php?url=home/deleteUser" method="Post">
<?php 
if (!empty($data) && $data != -1)
{	
    echo'<div class="container" >';
	echo '<table class="table"></br>' ;
	
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
		echo '<td  class="col-md-3"><input type = "hidden" name="email" value ="'.$entry->eMail.'">'.$entry->eMail.'</td>';
		if ($entry->isValidated == true){
			echo '<td align = center><input type="checkbox" checked></td>';
		}	
		else{
			echo '<td align = center><input type="checkbox"></td>';
		}
		echo '<td><input type="submit" class="btn btn-primary btn-xs" value = "l&ouml;schen"/></td>';
		echo "</tr>";		
	}
	echo "</table>\n";
        echo '</div>';
}
?>
</form>

