<?php
?>
<form action="index.php?url=question/saveQuestion" method="Post" class="">
    <select name="SelectionType">
        <option value="9"></option>
        <option value="0">Single Choice</option>
        <option value="1">Multiple Choice</option>
        <option value="2">Freetext</option>
    </select>
    <?php 
        if(isset($_SESSION['SelectionTypeMissing'])){
            echo $_SESSION['SelectionTypeMissing'];
        }
    ?>
    <table>
        <tr>
            <td>
                Ihre Frage:
            </td>
            <td>
                <input type="text" class="" name="QuestionText"/>
            </td>
            <td>
                <?php 
                    if(isset($_SESSION['QuestionMissing'])){
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
            for ($i = 1; $i <= $data->Count;$i++){
                echo '<tr>';
                echo '<td>';
                echo $i.".";
                echo '</td>';
                echo '<td>';
                echo '<input type="text" class="" name="AnswerText'.$i.'"/>';
                echo '</td>';
                echo '<td>';
                echo '<input type="checkbox" class="" name="RightOrWrong'.$i.'"/>';
                echo '</td>';
                echo '</tr>';                
            }
            ?>
        <tr>
            <td>
            </td>
            <td>
                <?php 
                    if(isset($_SESSION['AnswerMissing'])){
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
        <option value="10">10 Sek.</option>
        <option value="20">20 Sek.</option>
        <option value="30">30 Sek.</option>
        <option value="60">1 Minute</option>
        <option value="120">2 Minuten</option>
        <option value="300">5 Minuten</option>
    </select>
    <?php 
        if(isset($_SESSION['TimeMissing'])){
            echo $_SESSION['TimeMissing'];
        }
    ?>
    <input type="submit" class="" value="Speichern"/>
</form>
