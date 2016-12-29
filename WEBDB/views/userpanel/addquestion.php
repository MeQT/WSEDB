<?php 
?>
<script type="text/javascript">
window.addEventListener("load", function(){
    for(var i = 0; i <1; i++){
        addRows('dataTable');
    }
});;
</script>
<div class="container">
    <form action="index.php?url=question/saveQuestion" method="Post" name="QuestionForm" id="QuestionForm">
        <table id="dataTable" class="table">
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
            <tr>
                <td>
                    QuestionType
                <td>
                    <select name="SelectionType" class="form-control">
                        <option value="9"></option>
                        <option value="0">Single Choice</option>
                        <option value="1">Multiple Choice</option>
                        <option value="2">Freetext</option>
                    </select>
                </td>
                <td>
                <?php 
                    if(isset($_SESSION['SelectionTypeMissing'])){
                        echo $_SESSION['SelectionTypeMissing'];
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Beantwortungszeit</b>
                </td>
                <td>
                    <select name="Time" class="form-control">
                        <option value="0"></option>
                        <option value="10">10 Sek.</option>
                        <option value="20">20 Sek.</option>
                        <option value="30">30 Sek.</option>
                        <option value="60">1 Minute</option>
                        <option value="120">2 Minuten</option>
                        <option value="300">5 Minuten</option>
                    </select>
                </td>
                <td>
                    <?php 
                        if(isset($_SESSION['TimeMissing'])){
                            echo $_SESSION['TimeMissing'];
                        }
                    ?>
                </td>>
        </tr>
        </table>
    <input class="" onclick="addRows('dataTable')" value="Möglichkeit hinzufügen"/>
        <input type="hidden" value="" name="Checked" id="Checked"/>   
        <input type="submit" class="" value="Speichern"/>
    </form>
</div>