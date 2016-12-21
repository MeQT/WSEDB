<?php 

$db = mysqli_connect('projekt.wi.fh-flensburg.de:3306','projekt2016a','pkn_2404','projekt2016a');
mysqli_set_charset($db, 'utf8');
$query = "SELECT CONCAT_WS(' ', FirstName, LastName) as 'Name', eMail, isValidated FROM Person;";
$result = mysqli_query($db, $query);

if ($result)
{	
	echo "<table border=1 cellspacing=0>\n";
	
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>eMail</th>";
	echo "<th>Zulassen</th>";
	echo "<th>Löschen</th>";
	echo "</tr>";	
	
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";		
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td align = center><input type='checkbox'></td>";
		echo "<td><a href='","bsp_dbdelete_001.php","?Name=",$row[0],"'>L&ouml;schen</a></td>";
		echo "</tr>";		
	}
	echo "</table>\n";
}
mysqli_close($db);
?>



