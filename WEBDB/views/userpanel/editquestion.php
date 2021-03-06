<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<?php
require_once 'models/answerModel.php';
require_once 'models/answers.php';
require_once 'models/questions.php';
$answerModel = unserialize($data);
?>
<div class="container">
<form action="index.php?url=question/saveQuestion" method="Post" class="">
    <table class="table" id="editTable">
        <tr>
            <td>
                Ihre Frage:
            </td>
            <td>
                <input type="text" class="form-control" name="QuestionText" 
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
                        
            </td>
            <td>
                <select name="SelectionType" class="form-control">
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
            </td>
            <td>
                <?php
                if (isset($_SESSION['SelectionTypeMissing'])) {
                    echo $_SESSION['SelectionTypeMissing'];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
            <td>
                <select name="Time" class="form-control">
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
            </td>
        <?php
        if (isset($_SESSION['RightAnswerMissing'])) {
            echo $_SESSION['RightAnswerMissing'];
        }
        if (isset($_SESSION['TimeMissing'])) {
            echo $_SESSION['TimeMissing'];
        }?>
            
        </tr>
            <?php
            if(isset($answerModel->Answers)){
                for ($i = 1; $i <= count($answerModel->Answers); $i++) {
                    $valueText = "";
                    if (isset($answerModel->Answers[$i - 1]->Text)) {
                        $valueText = $answerModel->Answers[$i - 1]->Text;
                    }
                    echo '<tr id="'.$i.'">';
                    echo '<td>';
                    echo '<label for"Antwort" class="">Antwort '.$i.'</label>';
                    echo '</td>';
                    echo '<td>';
                    echo '<input type="Text" class="form-control" name="AnswerText' . $i . '" value="' . $valueText . '"/>';
                    echo '</td>';
                    echo '<td>';
                    if(isset($answerModel->Answers[$i - 1]->IsRight)){
                        if ($answerModel->Answers[$i - 1]->IsRight) {
                            echo '<input type="checkbox" class="form-control" name="RightOrWrong' . $i . '" checked="checked"/>';
                        } else {
                            echo '<input type="checkbox" class="form-control" name="RightOrWrong' . $i . '"/>';
                        }
                    }
                    echo '</td>';
                    echo '<td>';
                    echo '<input type="button" class="btn btn-primary" onclick="deleteRow('.$i.')" value="entfernen"/>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tr>
    </table>
    <?php
      if(isset($answerModel->Question)){
      echo '<input type="hidden" name ="QuestionID" value="'.$answerModel->Question->QuestionID.'"/>'; 
      }
    ?>
    <input type="hidden" name="QuestionID" value="<?php echo $answerModel->Question->QuestionID ?>"/>
    <input type="button" class="btn btn-primary" onclick="addRowsWithButton('editTable')" value="Möglichkeit hinzufügen"/>
    <input type="submit" class="btn btn-primary" value="Speichern"/>
</form>
        <?php
        if (isset($_SESSION['AnswerMissing'])) {
            echo $_SESSION['AnswerMissing'];
        }
        ?>
</div>
