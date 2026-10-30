<?php
declare(strict_types=1);
ini_set('display_errors','0');
session_set_cookie_params(['httponly'=>true,'secure'=>!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off','samesite'=>'Lax']);
session_start();
if (!file_exists(dirname(__DIR__).'/config.php')) { http_response_code(503); exit('Database configuration required.'); }
$c=require dirname(__DIR__).'/config.php';
try { $db=new PDO('mysql:host='.$c['host'].';dbname='.$c['database'].';charset=utf8mb4',$c['username'],$c['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]); }
catch(PDOException $e){http_response_code(503);exit('Database unavailable.');}
function h($v):string {return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function csrf():string {return $_SESSION['csrf']??=bin2hex(random_bytes(32));}
function check_csrf():void {if(!hash_equals(csrf(),(string)($_POST['csrf']??''))){http_response_code(403);exit('Invalid request token.');}}
function require_admin():void {if(empty($_SESSION['admin_id'])){header('Location: login.php');exit;}}
