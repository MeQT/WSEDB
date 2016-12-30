<div class="container">
    <?php
        require_once 'models/questionaryModel.php';
        require_once 'models/questions.php';
        require_once 'models/questionairy.php';
        
        echo '<form method="POST" action="index.php?url=questionaire/saveEditQuestionairy">';
        echo '<table class="table">';
                echo '<input type="text" class="form-control" name="Title" value="'.$data->Questionairy->Title.'"/>';
                echo '<br>';
                echo '<textarea rows="3" class="form-control" name="Description">';
                echo $data->Questionairy->Description;
                echo '</textarea>';
                echo '<br><b> Eingebaute Fragen </b><br>';
        for($i = 0;$i < count($data->Questions);$i++)
        {    
            if(isset($data->Questions[$i])){
                echo '<tr>';
                echo '<td>';
                echo $data->Questions[$i]->Text;
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=questionaire/saveDelQuestionairy" method="POST" name="deleteting">';
                echo '<input type="hidden" name="id_to_delete" value="'.$data->Questions[$i]->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary" value="entfernen"/>';
                echo '</form>'; 
                echo '</td>';
                echo '</tr>';               
            }
        }
        echo '</table>';
        echo '<br><b>vorhandene Fragen</b><br>';
        echo '<table class="table">';
        for($i = 0;$i < count($data->OutQuestions);$i++)
        {    
            if(isset($data->OutQuestions[$i])){
                echo '<tr>';
                echo '<td>';
                echo $data->OutQuestions[$i]->Text;
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=questionaire/saveAddQuestionairy" method="POST" name="adding">';
                echo '<input type="hidden" name="id_to_add" value="'.$data->OutQuestions[$i]->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary" value="hinzufügen"/>';
                echo '</form>'; 
                echo '</td>';
                echo '</tr>';               
            }
        }
        echo '</table>';
        echo '<input type="submit" class="btn btn-primary" value="Speichern"/>';
        echo '</form>';
    ?>
</div>


