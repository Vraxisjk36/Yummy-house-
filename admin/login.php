<?php
require __DIR__.'/bootstrap.php';
if(!empty($_SESSION['admin_id'])){header('Location: index.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();
 $email=trim((string)($_POST['email']??''));$password=(string)($_POST['password']??'');
 $q=$db->prepare('SELECT id,password_hash FROM admins WHERE email=? LIMIT 1');$q->execute([$email]);$admin=$q->fetch();
 if($admin && password_verify($password,$admin['password_hash'])){session_regenerate_id(true);$_SESSION['admin_id']=(int)$admin['id'];header('Location: index.php');exit;}
 $error='Invalid email or password.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin login | Yummy House</title><link rel="stylesheet" href="../assets/style.css"></head><body><header class="top"><a class="brand" href="../index.php">The Yummy House</a></header><main class="container"><div class="panel"><h1>Restaurant administration</h1><p class="muted">Authorised staff only.</p><?php if($error):?><p role="alert"><?=h($error)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=h(csrf())?>"><label for="email">Email</label><input id="email" name="email" type="email" required autocomplete="username"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password"><p><button type="submit">Sign in</button></p></form></div></main></body></html>