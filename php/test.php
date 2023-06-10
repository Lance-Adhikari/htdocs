<?php

include 'library.php';

$xml = GetServerInfo();

echo $xml->Serverinfo->url . "<br>";

?>