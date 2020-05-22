<?php
require 'authentication.inc';
require 'db.inc';

if (!$connection = @ mysqli_connect("localhost", "lucy", "secret","project1"))
  die("Cannot connect");

// Clean the data collected in the <form>
$loginUsername = mysqlclean($_POST, "loginUsername", 20, $connection);
$password = mysqlclean($_POST, "password", 20, $connection);
session_start();
// Authenticate the user
if (authenticateUser($connection,$loginUsername,$password))
{
  // Register the loginUsername
  $_SESSION["loginUsername"] = loginUsername;
  $_SESSION["password"] = password;
  // Register the IP address that started this session
  $_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];

  // Relocate back to the first page of the application
  header("Location: get-input-example.php?loginUsername=".$loginUsername);
  exit;
}
else
{
  // The authentication failed: setup a logout message
  //$_SESSION["message"] = 
    "Could not connect to the application as '{$loginUsername}'";

  // Relocate to the logout page
  header("Location: logout.php?loginUsername=".$loginUsername);
  exit;
}
?>
