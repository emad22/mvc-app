<?php
$pdo = null;
$dsn = 'mysql:host=localhost;dbname=employees';
$username = 'root';
$passwd = '';
$options = array(
    PDO::ATTR_PERSISTENT => true
    );
try {
    $pdo = new PDO($dsn, $username, $passwd, $options);
} catch (PDOException $ex) {
//    echo $ex;
}
