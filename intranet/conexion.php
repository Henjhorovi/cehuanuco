<?php

try {
    $bd = new PDO("mysql:host=localhost;dbname=fabio_cehuanuco_intranet","fabio_cehuanuco","Pwd$2019");
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
