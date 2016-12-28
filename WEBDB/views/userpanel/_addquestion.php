<?php 
?>
<form action="index.php?url=question/saveQuestion" method="Post" name="QuestionForm" id="QuestionForm" onsubmit="countRows('dataTable')">
    <select name="SelectionType" >
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
                <input type="text" class="" name="QuestionText" value="<?php echo filter_input(INPUT_POST, 'QuestionText')?>"/>
            </td>
            <td>
                <?php 
                    if(isset($_SESSION['QuestionMissing'])){
                        echo $_SESSION['QuestionMissing'];
                    }
                ?>
            </td>
        </tr>
    </table>
    <table id="dataTable">
            <tr>
                <td>
                    Antwort
                </td>
                <td>
                    <input type="text" class="" name="AnswerText[]">
                </td>
                <td>
                    <input type="checkbox" class="" id="chk" name="RightOrWrong[]" checked="checked">
                </td>
            </tr>
    </table>
<input class="" onclick="addRow('dataTable')" value="Möglichkeit hinzufügen"/>
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
    <input type="hidden" value="" name="Checked" id="Checked"/>   
    <input type="submit" class="btn btn-default btn-xs" value="Speichern"/>
</form>
<?php if(isset($_POST['Checked'])){
    echo 'jub';
    print_r($_POST);
}?>