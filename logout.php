<?php
  session_start();

  $message = "";
$loginUsername= $_GET['loginUsername'];
$_SESSION["loginUsername"] = $loginUsername;
$_SESSION["message"] = 
    "Could not connect to the application as '{$loginUsername}'.";

  // An authenticated user has logged out -- be polite and thank them for
  // using your application.
  if (isset($_SESSION["loginUsername"]))
    $message .= "Thanks {$_SESSION["loginUsername"]} for
                 using the Application.<br>";

  // Some script, possibly the setup script, may have set up a 
  // logout message
  if (isset($_SESSION["message"]))
  {
    $message .= $_SESSION["message"];
    unset($_SESSION["message"]);
  }
  // Destroy the session.
  session_destroy();
	echo "$message"; 
?>
