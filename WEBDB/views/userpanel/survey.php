<?php
    require_once 'models/surveyModel.php';
    require_once 'models/survey.php';
    require_once 'models/questionairy.php';
    require_once 'models/questionaryModel.php';
    require_once 'models/questions.php';
    ?>
<div class="container">
    <form action="" method="POST">
        <select name="Questionairies" class="form-control">
            <option value="0"></option>
            <?php 
                for($i = 0; $i < count($data); $i++){
                    echo '<option value="'.$data->QuestionairyID.'">'.$data->Text.'</option>';
                }
            ?>
        </select>
    </form>
</div>
