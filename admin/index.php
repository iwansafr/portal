<?php
session_start();
if(!empty($_SESSION['user'])){
	include_once('dashboard.php');
}else{
	header('location: login.php');
}