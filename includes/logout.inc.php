<?php //sessions 
session_start();
session_unset();
session_destroy();

header("location: ../index.php"); //when logged out redirect to index page
exit();