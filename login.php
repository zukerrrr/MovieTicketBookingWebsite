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
session_start();
function login_form($message)
{
    echo <<<EOD
  <body style="font-family: Arial, sans-serif;">

  <h2>Login Page</h2>
  <p>$message</p>
  <form action="login.php" method="POST">
    <p>Username: <input type="text" name="username"></p>

    <p>Password: <input type="text" name="password"</p>
    <input type="submit" value="Login">
  </form>
  </body>
EOD;
}
if(!isset($_POST['username'])||!isset($_POST['password']))
{
    login_form('welcome');

}
    $conn = oci_connect("system", "vibha", "localhost/XE");
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

    } else
        print ".\nconnection successfull!!!!!!!!!!!";
    $sql = 'SELECT username FROM AUTH WHERE username= :usr AND password= :pass';
    $stid = oci_parse($conn, $sql);
    $a=$_POST['username'];
    $b=$_POST['password'];
    oci_bind_by_name($stid,':usr',$a);
    oci_bind_by_name($stid,':pass',$b);

    oci_execute($stid, OCI_DEFAULT);
    $row = oci_fetch_array($stid, OCI_ASSOC);
    if ($row) {
        // The password matches: the user can use the application
        // Set the user name to be used as the client identifier in
        // future HTTP requests:
        echo $row['username'] . "<br>";
        $_SESSION['username'] = $_POST['username'];
        //   oci_close($conn);

        echo <<<EOD
    <body style="font-family: Arial, sans-serif;">

    <h2>Login was successful</h2>
    <p><a href ="index.html"></a>
EOD;
        exit;
    }

?>
</html>