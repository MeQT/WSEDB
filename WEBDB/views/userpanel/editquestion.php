<?php
require_once 'models/answerModel.php';
require_once 'models/answers.php';
require_once 'models/questions.php';
$answerModel = unserialize($data);
?>
<div class="container">
<form action="index.php?url=question/saveEditedQuestion" method="Post" class="">
        <select name="SelectionType" class="s">
        <option value="9"></option>
        ^   <?php
        if ($answerModel->Question->SelectionType == 0) {
            echo '<option value="0" selected>Single Choice</option>';
        } else {
            echo '<option value="0">Single Choice</option>';
        }
        if ($answerModel->Question->SelectionType == 1) {
            echo '<option value="1" selected>Multiple Choice</option>';
        } else {
            echo '<option value="1">Multiple Choice</option>';
        }
        if ($answerModel->Question->SelectionType == 2) {
            echo '<option value="2" selected>Freetext</option>';
        } else {
            echo '<option value="2">Freetext</option>';
        }
        ?>
    </select>
        <?php
        if (isset($_SESSION['SelectionTypeMissing'])) {
            echo $_SESSION['SelectionTypeMissing'];
        }
        ?>
    <table>
        <tr>
            <td>
                Ihre Frage:
            </td>
            <td>
                <input type="text" class="" name="QuestionText" 
                       value="<?php
                        if (isset($answerModel->Question->Text)) {
                            echo $answerModel->Question->Text;
                        }
                        ?>"/>
            </td>
            <td>
                       <?php
                       if (isset($_SESSION['QuestionMissing'])) {
                           echo $_SESSION['QuestionMissing'];
                       }
                       ?>
            </td>
        </tr>
        <tr>
            <td>
                Ihre Antwortmöglichkeiten:
            </td>
        </tr>
<?php
for ($i = 1; $i <= count($answerModel->Answers); $i++) {
    $valueText = "";
    if (isset($answerModel->Answers[$i - 1]->Text)) {
        $valueText = $answerModel->Answers[$i - 1]->Text;
    }
    echo '<tr>';
    echo '<td>';
    echo $i . ".";
    echo '</td>';
    echo '<td>';
    echo '<input type="text" class="" name="AnswerText' . $i . '" value="' . $valueText . '"/>';
    echo '</td>';
    echo '<td>';
    if ($answerModel->Answers[$i - 1]->IsRight) {
        echo '<input type="checkbox" class="" name="RightOrWrong' . $i . '" checked="checked"/>';
    } else {
        echo '<input type="checkbox" class="" name="RightOrWrong' . $i . '"/>';
    }
    echo '</td>';
    echo '</tr>';
}
?>
        <tr>
            <td>
            </td>
            <td>
        <?php
        if (isset($_SESSION['AnswerMissing'])) {
            echo $_SESSION['AnswerMissing'];
        }
        ?>
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                <a href="index.php?url=question/addAnswer" class="btn btn-default btn-xs">Möglichkeit hinzufügen</a>
            </td>
        </tr>
    </table>
    <select name="Time">
        <option value="0"></option>
<?php
if ($answerModel->Question->Time == 10) {
    echo '<option value="10" selected>10 Sek.</option>';
} else {
    echo '<option value="10">10 Sek.</option>';
}
if ($answerModel->Question->Time == 20) {
    echo '<option value="20" selected>20 Sek.</option>';
} else {
    echo '<option value="20">20 Sek.</option>';
}
if ($answerModel->Question->Time == 30) {
    echo '<option value="30" selected>30 Sek.</option>';
} else {
    echo '<option value="30">30 Sek.</option>';
}
if ($answerModel->Question->Time == 60) {
    echo '<option value="60" selected>1 Minute</option>';
} else {
    echo '<option value="60">1 Minute</option>';
}
if ($answerModel->Question->Time == 120) {
    echo '<option value="120" selected>2 Minuten</option>';
} else {
    echo '<option value="120">2 Minuten</option>';
}
if ($answerModel->Question->Time == 300) {
    echo '<option value="300" selected>5 Minuten</option>';
} else {
    echo '<option value="300">5 Minuten</option>';
}
?>
    </select>
        <?php
        if (isset($_SESSION['RightAnswerMissing'])) {
            echo $_SESSION['RightAnswerMissing'];
        }
        if (isset($_SESSION['TimeMissing'])) {
            echo $_SESSION['TimeMissing'];
        }
      if(isset($answerModel->Question)){
      echo '<input type="hidden" name ="QuestionID" value="'.$answerModel->Question->QuestionID.'"/>'; 
      }
    ?>
    <input type="submit" class="" value="Speichern"/>
</form>
</div>
