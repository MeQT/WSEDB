<!--  --><!DOCTYPE html>
<!-- <!-- -->
<!-- To change this license header, choose License Headers in Project Properties. -->
<!-- To change this template file, choose Tools | Templates -->
<!-- and open the template in the editor. -->
<!-- -->
<!-- <html> -->
<!--     <head> -->
<!--         <meta charset="UTF-8"> -->
<!--         <title></title> -->
<!--     </head> -->
<!--     <body> -->
<!--         <h2> Lets Try something1 </h2> -->
       <?php
//         phpinfo();
//         lets
//         ?>
<!--     </body> -->
<!-- </html> -->

<?php 
//erstellte Klassen einbinden
include('classes/controller.php');
include('classes/model.php');
include('classes/view.php');

$request = array_merge($_GET, $_POST);
// Controller erstellen
$controller = new Controller($request);
// Inhalt der Webanwendung ausgeben
echo $controller->display();
?>
