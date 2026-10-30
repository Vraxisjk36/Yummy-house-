<?php
require __DIR__.'/bootstrap.php';
if(!empty($_SESSION['customer_id'])){header('Location: account.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();$email=strtolower(trim((string)($_POST['email']??'')));$password=(string)($_POST['password']??'');
 $q=$db->prepare('SELECT id,password_hash FROM customers WHERE email=? LIMIT 1');$q->execute([$email]);$customer=$q->fetch();
 if($customer && password_verify($password,$customer['password_hash'])){session_regenerate_id(true);$_SESSION['customer_id']=(int)$customer['id'];header('Location: account.php');exit;}
 $error='Incorrect email or password.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Sign in | The Yummy House</title><link rel="stylesheet" href="../assets/style.css"></head><body><header class="top"><a class="brand" href="../index.php">The Yummy House</a><nav class="nav"><a href="register.php">Register</a></nav></header><main class="container"><div class="panel"><h1>Welcome back</h1><?php if($error):?><p role="alert"><?=h($error)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=h(csrf())?>"><label for="email">Email</label><input id="email" name="email" type="email" required autocomplete="username"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password"><p><button type="submit">Sign in</button></p></form><p>New here? <a href="register.php">Create an account</a></p></div></main></body></html>
