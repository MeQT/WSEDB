<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<div class="container">
    <?php
        require_once 'models/questionaryModel.php';
        require_once 'models/questions.php';
        require_once 'models/questionairy.php';
        if(isset($_SESSION['QuestionairyFailed'])){
            echo $_SESSION['QuestionairyFailed'];
            unset($_SESSION['QuestionairyFailed']);
        }
        echo '<table class="table">';
                echo '<input type="text" class="form-control" id="Title" name="Title" value="'.$data->Questionairy->Title.'"/>';
                echo '<br>';
                echo '<textarea rows="3" class="form-control" id="Description" name="Description">';
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
                echo '<form action="index.php?url=questionaire/DelQuestion" method="POST" name="deleteting">';
                echo '<input type="hidden" name="HiddenQuestionairyToDel" value="'.$data->Questionairy->QuestionairyID.'"/>';
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
                echo '<form action="index.php?url=questionaire/AddQuestion" method="POST" name="adding">';
                echo '<input type="hidden" name="HiddenQuestionairyToAdd" value="'.$data->Questionairy->QuestionairyID.'"/>';
                echo '<input type="hidden" name="id_to_add" value="'.$data->OutQuestions[$i]->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary" value="hinzufügen"/>';
                echo '</form>'; 
                echo '</td>';
                echo '</tr>';               
            }
        }
        echo '</table>';
        echo '<form method="POST" action="index.php?url=questionaire/saveEditQuestionairy" onsubmit="copyQuestionairy()">';
        require_once 'models/course.php';
        echo '<select class="form-control" name="Course">';
        echo '<option value="0"></option>';
         for($j = 0; $j < count($data->Courses);$j++){
            if($data->Questionairy->Course === $data->Courses[$j]->CourseID){
                echo '<option value="'.$data->Courses[$j]->CourseID.'" selected>'.$data->Courses[$j]->Text.'</option>';
            }
            else{
                echo '<option value="'.$data->Courses[$j]->CourseID.'">'.$data->Courses[$j]->Text.'</option>';
            }
        }
        echo '</select>';
        echo '<input type="hidden" name="HiddenDescription" id="HiddenDescription"/>';
        echo '<input type="hidden" name="HiddenTitle" id="HiddenTitle"/>';
        echo '<input type="hidden" name="HiddenModel" value="'. base64_encode(serialize($data)).'"/>'; 
        echo '<input type="hidden" name="HiddenQuestionairyToSave" value="'.$data->Questionairy->QuestionairyID.'"/>';
        echo '<input type="submit" class="btn btn-primary" value="Speichern"/>';
        echo '</form>';
    ?>
</div>


