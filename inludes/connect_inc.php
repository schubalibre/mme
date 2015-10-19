<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 12.10.15
 * Time: 19:18
 */

try
{
    // create PHP Data Object
    $pdo = new PDO('mysql:host=localhost;dbname=mme', 'root', 'qpal10');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
    $error = 'Unable to connect to the database server: '.$e->getMessage();
    include 'error_inc.php';
    exit();
}