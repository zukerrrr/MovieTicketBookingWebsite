<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    echo "ggj";
    $conn = oci_connect("system","vibha","localhost/XE");
if(!$conn)
    {
        $e=oci_error();
        trigger_error(htmlentities($e['messege'],ENT_QUOTES),E_USER_ERROR);

    }
    else
        print ".\n...........connection successfull!!!!!!!!!!!";

    $stid = oci_parse($conn,'select * from BOOKTICKET');
    oci_execute($stid);
    oci_close($conn);
    echo "<table border='1'>\n";
    while ($row= oci_fetch_array($stid,OCI_ASSOC+OCI_RETURN_NULLS))
    {
        echo "<tr>\n";
        foreach($row as $item)
        {
            echo "<td>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;")."</td>\n";


        }
echo "</tr>\n";
    }
    echo "</table>\n";
?>
</html>
