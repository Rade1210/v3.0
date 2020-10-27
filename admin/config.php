<?php
session_start();
ini_set("display_errors","off");
$host = 'velepocom.ipagemysql.com';
$username = 'rade1289';
$password = 'rade!1289A';
$database = 'rpblog';
$conn = new MySQLi($host, $username, $password, $database);
if($conn->connect_error)
{
	die("Error: " . $conn->connect_error);
}
?>