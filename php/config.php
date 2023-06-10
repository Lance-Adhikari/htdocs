<?php

include 'libconfig.php';

function GetConnection()
{
    $xml = GetServerInfo();

    $url = $xml->Databaseinfo->host;

    $username = $xml->Databaseinfo->username;

    $password = $xml->Databaseinfo->password;

    $name = $xml->Databaseinfo->name;

    $lconn = new mysqli($url,$username,$password,$name);

    if ($lconn->connect_errno) {
        echo "Failed to connect to MySQL: " . $lconn->connect_error; 
        exit(); 
    }

    return $lconn;
}

?>