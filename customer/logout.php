<?php
require __DIR__.'/bootstrap.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit;}
check_csrf();
unset($_SESSION['customer_id']);
session_regenerate_id(true);
header('Location: login.php');exit;
