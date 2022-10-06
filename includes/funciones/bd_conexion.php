<?php
    define('XENTURIONIT_HOST', 'localhost');
    define('XENTURIONIT_DB_USUARIO', 'robregon_user');
    define('XENTURIONIT_DB_PASSWORD', 'Pa$$w0rd.2022');
    define('XENTURIONIT_DB_DATABASE', 'robregon_xitacademy');

    $conn = new mysqli(XENTURIONIT_HOST, XENTURIONIT_DB_USUARIO, XENTURIONIT_DB_PASSWORD, XENTURIONIT_DB_DATABASE);
    $conn->set_charset('utf8mb4');
    if($conn->connect_error) {
      echo $conn->connect_error;
    }
