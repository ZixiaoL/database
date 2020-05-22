<?php
   // This file is the same as example 6-7, but includes mysqlclean() and shellclean() 

   $hostName = "localhost";
   $databaseName = "winestore";
   $username = "fred";
   $password = "shhh";

   function showerror()
   {
      die("Error " . mysqli_errno() . " : " . mysqli_error());
   }

   function mysqlclean($array, $index, $maxlength, $connection)
   {
     if (isset($array["{$index}"]))
     {
        $input = substr($array["{$index}"], 0, $maxlength);
        $input = mysqli_real_escape_string($connection,$input);
        return ($input);
     }
     return NULL;
   }

   function shellclean($array, $index, $maxlength)
   {
     if (isset($array["{$index}"]))
     {
       $input = substr($array["{$index}"], 0, $maxlength);
       $input = EscapeShellCmd($input);
       return ($input);
     }
     return NULL;
   }
?>
