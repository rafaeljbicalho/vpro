<?php

$DB_host = "192.168.5.102";
$DB_user = "sa";
$DB_pass = "Hahafdpvsf0@";
$DB_name = "projeto";


try
{
	$DB_con = new PDO("sqlsrv:server={$DB_host};Database={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

include_once 'class.crud.php';

$crud = new crud($DB_con);

?>