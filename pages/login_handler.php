<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/Relax/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $errors = [];
    
    if (empty($email)) $errors[] = 'Email обязателен';
    if (empty($password)) $errors[] = 'Пароль обязателен';

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM profile WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_phone'] = $user['phone'];
            
            header('Location: profile.php');
            exit();
        } else {
            $errors[] = 'Неверный email или пароль';
        }
    }

    $_SESSION['login_errors'] = $errors;
    header('Location: profile.php#login-form');
    exit();
}

header('Location: profile.php');
exit();
?>