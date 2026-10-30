<?php
// Run from the command line only: php scripts/create_admin.php email@example.com
if(PHP_SAPI!=='cli'){http_response_code(403);exit('CLI only');}
if($argc!==2 || !filter_var($argv[1],FILTER_VALIDATE_EMAIL)){fwrite(STDERR,"Usage: php scripts/create_admin.php email@example.com\n");exit(1);}
if(!file_exists(dirname(__DIR__).'/config.php')){fwrite(STDERR,"Configure config.php first.\n");exit(1);}
$c=require dirname(__DIR__).'/config.php';
$db=new PDO('mysql:host='.$c['host'].';dbname='.$c['database'].';charset=utf8mb4',$c['username'],$c['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
fwrite(STDOUT,"Enter admin password: ");
if(strncasecmp(PHP_OS,'WIN',3)!==0){system('stty -echo');}
$password=trim(fgets(STDIN));
if(strncasecmp(PHP_OS,'WIN',3)!==0){system('stty echo');}
fwrite(STDOUT,"\n");
if(strlen($password)<12){fwrite(STDERR,"Password must be at least 12 characters.\n");exit(1);}
$q=$db->prepare('INSERT INTO admins(email,password_hash) VALUES(?,?)');
$q->execute([$argv[1],password_hash($password,PASSWORD_DEFAULT)]);
fwrite(STDOUT,"Admin created.\n");
