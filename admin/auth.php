<?php
include_once '../classes/database.php';
include_once '../classes/user.php';
include_once '../initial.php';

$username = @$_POST['username'];
$password = @$_POST['password'];

$user = new User($db);
$auth = $user->login($username,$password);
if(!empty($auth))
{
	echo @$auth['msg'];
	if(!empty($auth['status']))
	{
		print_r($_SESSION);
		print_r($auth);
		$_SESSION['user'] = $auth['data'];
		header('location: index.php');
	}
}