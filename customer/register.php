<?php
require __DIR__.'/bootstrap.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();
 $name=trim($_POST['name']??'');
 $email=strtolower(trim($_POST['email']??''));
 $password=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($password)<12){$error='Enter a valid name, email and password (12+ characters).';}
 else {
  try {
   $q=$db->prepare('INSERT INTO customers(name,email,password_hash) VALUES(?,?,?)');
   $q->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
   session_regenerate_id(true);
   $_SESSION['customer_id']=(int)$db->lastInsertId();
   header('Location: account.php');exit;
  }catch(PDOException $e){$error='Unable to register. Check whether this email is already used.';}
 }
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register | Yummy House</title><link rel="stylesheet" href="../assets/style.css"></head><body><header class="top"><a class="brand" href="../index.php">The Yummy House</a></header><main class="container"><div class="panel"><h1>Create account</h1><p><?=h($error)?></p><form method="post"><input type="hidden" name="csrf" value="<?=h(csrf())?>"><label>Name<input name="name" required maxlength="150"></label><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="12" required></label><p><button type="submit">Register</button></p></form><a href="login.php">Already have an account?</a></div></main></body></html>