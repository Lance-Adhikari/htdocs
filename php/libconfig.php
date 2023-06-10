<?php

function GetServerInfo()
{
        $filepath = $_SERVER['DOCUMENT_ROOT']."/conf/bookshare.xml";
        $xml = simplexml_load_file($filepath) or die("Error: Cannot read bookshare.xml file");
        return $xml;
}

?>