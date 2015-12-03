<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST) {

    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';

    $result = null;

    try {
        $sql = "SELECT * FROM department";
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo 'QUERY ERROR: '.$sql.': '.$e->getMessage();
        exit();
    }

    $departments = [];

    foreach ($result as $row) {
        array_push($departments, $row);
    }


    echo json_encode($departments);
}