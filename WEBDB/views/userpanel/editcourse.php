<div class="container">
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['DescriptionMissing'])){
            echo $_SESSION['DescriptionMissing'];
            unset($_SESSION['DescriptionMissing']);
        }
        if(isset($_SESSION['ShortcutMissing'])){
            echo $_SESSION['ShortcutMissing'];
            unset($_SESSION['ShortcutMissing']);
        }
        require_once 'models/course.php';
        if(!empty($data))
        {
            $model = unserialize($data);
        }
    ?>
    <form method="POST" action="index.php?url=courseController/editCourse">        
        <?php if(isset($model)){ 
            echo '<input type="hidden" name="hiddenid" value="'.$model->CourseID.'"/>';
        } ?>
        <input class="btn btn-primary" type="submit" value="Speichern"/>
        <table class="table">
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input class="form-control" type="text" name="description" <?php if(isset($model)){ echo 'value="'.$model->Text.'"';} ?> />
                </td>
            </tr>
            <tr>
                <td>
                    Kürzel
                </td>
                <td>
                    <input class="form-control" type="text" name="shortcut" <?php if(isset($model)){ echo 'value="'.$model->Shortcut.'"';} ?>/>
                </td>
            </tr>
        </table>
    </form>
</div>