<?php // connect to database

$conn = mysqli_connect("mysql.ccacolchester.com", "andreiioanb4889", "AB1494889", "andreiioanb4889");

if(!$conn) { //show error if unable to connect
    die("Connection failed:". mysqli_connect_error());
}
?>