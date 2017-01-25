<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<link href="css/chartDesign.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin:auto; width: 60%; padding: 10%">
<h3><?php echo $_SESSION['questionText']?></h3>
<form action="index.php?url=result/nextQuestion" method="Post">
<?php

if ($_SESSION['questionNumber'] != '-1') {
	if (!empty($data)) {
		@session_start();
	
		$questionNumber = $_SESSION['questionNumber'];
	
		$number = $_SESSION['sum']+1;
	
		$answerCount = 0;
	
		$answerTop = -100;
	
		for ($x = 0; $x < count($data[$questionNumber]); $x++ ) {
			$answerCount++;
		}
	
		$size = 0;
	
		for ($x = 0; $x < count($data[$questionNumber]); $x++ ) {
			$size += $data[$questionNumber][$x];
		}
	
		if (is_numeric($data[$questionNumber][0])) {
			if ($size != '0') {
				echo '<table id="q-graph">';
				//echo '<caption style="width:calc('.$answerCount.'*80px);">'.$_SESSION['questionText'].'</caption>';
				echo '<thead>';
				echo '<tr style="margin-left:calc('.$answerCount.'*10%)" >';
				echo '<th></th>';
				//echo '<th class="button"><input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input></th>';
					
				$answerCounter = 1;
				for ($i = 0; $i < $answerCount; $i++) {
					echo '<th style="width:350px; text-align: left; top:calc('.$answerTop.'*1px)">'.$answerCounter++.' '.$_SESSION['answerText'][$questionNumber][$i].'</th>';
					$answerTop += 20;
				}
				echo '<th style="width:250px; text-align: left; top:160px">Teilnehmer: '.$_SESSION['personSum'].'</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
					
				//$height = 0.8;
				$left = 0;
				//$count = 1;
					
				$answerCount = 1;
					
				for ($y = 0; $y < count($data[$questionNumber]); $y++) {
					echo '<tr class="qtr" style="margin-left:calc('.$left.'*1px);" id="">';
					echo '<th scope="row">'.$answerCount++.'</th>';
					echo '<td class="answer bar" style="height: calc('.$data[$questionNumber][$y].'/'.$_SESSION['personSum'].' * 100%);"><p><font color="black"size="3"><b>'.$data[$questionNumber][$y].'</b></font></p></td>';
					echo '</tr>';
						
					//$count++;
					//$height -= 0.4;
					$left += 70;
				}
					
				echo '</tbody>';
				echo '</table>';
					
				$answerCount--;
					
				// 			echo '<div id="ticks">';
				// 			echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.$size.'</p></div>';
				// 			echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-$size/5).'</p></div>';
				// 			echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-2*$size/5).'</p></div>';
				// 			echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-3*$size/5).'</p></div>';
				// 			echo '<div class="tick" style="height: 59px; width:calc('.$answerCount.'*75px);"><p>'.($size-4*$size/5).'</p></div>';
				// 			echo '</div>';
			}
			else {
				echo '<br/><br/>';
				echo 'Auswertung nicht möglich!';
				echo '<hr/>';
				//echo '<input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input>';
			}
		}
		else {
			// 		echo '<table border=0 cellpadding=8 id="">';
			// 		echo '<caption style="margin-bottom:10%">'.$_SESSION['questionText'].'</caption>';
			// 		echo '<tbody>';
	
			// 		for ($y = 0; $y < count($data[$questionNumber]); $y++) {
			// 			echo '<tr>';
			// 			echo '<td>'.utf8_encode($data[$questionNumber][$y]).'</td>';
			// 			echo '</tr>';
			// 		}
			// 		echo '<tr>';
			// 		echo '<td class=""><input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input></td>';
			// 		echo '</tr>';
			// 		echo '</tbody>';
			// 		echo '</table>';
			echo '<br/><br/>';
			if ($data[$questionNumber][0] == 'null') {
				echo '<br>Auswertung nicht möglich!</br>';
				echo '<hr/>';
				//echo '<input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input>';
			}
			else {
				$count = 1;
				for ($y = 0; $y < count($data[$questionNumber]); $y++) {
					echo '<b>Antwort '.$count++.': </b>'.'<div>'.utf8_encode($data[$questionNumber][$y]).'</div>';
					echo '<hr/>';
				}
			}
	
		}
		echo '<br/><br/>';
		echo '<input type="submit" class="btn btn-primary btn-xs" value="Nächste Frage"></input>';
	}
}
?>
</form>
</div>
</body>
</html>


