<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<link href="css/chartDesign.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-left: 5%">
<form action="index.php?url=result/nextQuestion" method="Post">
<?php

if (!empty($data)) {
	@session_start();
	
	$sum = $_SESSION['sum'];
	
	$number = $_SESSION['sum']+1;
	
	$answerCount = 0;
	
	for ($x = 0; $x < count($data[$sum]); $x++ ) {
		$answerCount++;
	}
	
	if (is_numeric($data[$sum][0])) {
		echo '<table id="q-graph">';
		echo '<caption style="width:calc('.$answerCount.'*80px);">Frage '.$number.'</caption>';
		echo '<thead>';
		echo '<tr style="margin-left:calc('.$answerCount.'*10%)" >';
		echo '<th></th>';		
		echo '<th class="button"><input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
		//$height = 0.8;
		$left = 0;
		//$count = 1;
		$size = 0;
	
		$answerCount = 1;
	
		for ($x = 0; $x < count($data[$sum]); $x++ ) {
			$size += $data[$sum][$x];
		}
	
		for ($y = 0; $y < count($data[$sum]); $y++) {
			echo '<tr class="qtr" style="margin-left:calc('.$left.'*1px);" id="">';
			echo '<th scope="row">A'.$answerCount++.'</th>';
			echo '<td class="answer bar" style="height: calc('.$data[$sum][$y].'/'.$size.' * 100%);"><p>'.$data[$sum][$y].'</p></td>';
			echo '</tr>';
	
			//$count++;
			//$height -= 0.4;
			$left += 70;
		}
	
		echo '</tbody>';
		echo '</table>';
	
		$answerCount--;
	
		echo '<div id="ticks">';
		echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.$size.'</p></div>';
		echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-$size/5).'</p></div>';
		echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-2*$size/5).'</p></div>';
		echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-3*$size/5).'</p></div>';
		echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-4*$size/5).'</p></div>';
		echo '</div>';
	}
	else {
		echo '<table border=0 cellpadding=8 id="">';
		echo '<caption style="margin-bottom:10%">Frage '.$number.'</caption>';
		echo '<tbody>';
	
		for ($y = 0; $y < count($data[$sum]); $y++) {
			echo '<tr>';
			echo '<td>'.utf8_encode($data[$sum][$y]).'</td>';
			echo '</tr>';
		}
		echo '<tr>';
		echo '<td class=""><input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input></td>';
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
	}
}
?>
</form>
</div>
</body>
</html>


