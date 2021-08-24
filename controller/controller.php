<?php 
    require_once('model/model.php');

    $userModel = new model1();

    $listUsers = $userModel -> getUserData();

    require_once('views/index.php');
?>