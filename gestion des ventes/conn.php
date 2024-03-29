<?php

    $server = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "gestion_venets";

    $conn = mysqli_connect($server, $user, $password, $database) or die("connection failed: ".mysqli_connect_error());
