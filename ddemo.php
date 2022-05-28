<html>
<body>

<h1>Welcome to my home page!</h1>
<?php
echo "I have a color car.";
$conn = oci_connect('system', 'vibha', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else
{ print "connected to oracle!";
}
$stid = oci_parse($conn, 'SELECT * FROM MOVIES');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";










}
echo "</table>\n";
oci_close($conn);
$conn = oci_connect('system', 'vibha', 'localhost/XE');
$sql="select movie_img from MOVIES where MOVIE_ID='1'";
$query= oci_parse($conn, $sql);
oci_execute($query);
$showrow = oci_fetch_row($query);
if(!$showrow){
    return;
}else{
    $image=$showrow['0']->load();
    header("Content-type: image/JPEG");
    print $image;
}
?>
</body>
</html>