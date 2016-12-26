<?php 
$db = mysqli_connect('projekt.wi.fh-flensburg.de','projekt2016a','pkn_2404','projekt2016a',3306);
mysqli_set_charset($db, 'utf8');
$query = "SELECT CONCAT_WS(' ', FirstName, LastName) as 'Name', eMail, isValidated FROM Person;";
$result = mysqli_query($db, $query);

if ($result)
{	
    echo'<div class="container" >';
	echo '<table class="table"></br>' ;
	
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>eMail</th>";
	echo "<th>Zulassen</th>";
	echo "<th>Löschen</th>";
	echo "</tr>";	
	
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";		
		echo '<td  class="col-md-3">'.$row[0].'</td>';
		echo '<td  class="col-md-3">'.$row[1].'</td>';
		echo '<td align = center><input type="checkbox" checked="false"></td>';
		echo '<td><a class="btn btn-primary btn-xs" href="bsp_dbdelete_001.php">L&ouml;schen</a></td>';
		echo "</tr>";		
	}
	echo "</table>\n";
        echo '</div>';
}
mysqli_close($db);
?>
