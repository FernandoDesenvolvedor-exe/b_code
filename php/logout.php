<?php 

    unset($_SESSION['user']);
    unset($_SESSION['idUsuario']);
    unset($_SESSION['login']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
    unset($_SESSION['turma']);
    unset($_SESSION['turno']);

    header('location:../login');

?>