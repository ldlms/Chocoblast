<?php
    session_start();
    if(isset($_POST['submit'])){
        $_SESSION['login'] = $_POST['login'];
        $message = $_POST['login']." est connectÃ© !";
    } else {
        $message ='';
    }

    include './App/vue/view_connect_user.php';
?>