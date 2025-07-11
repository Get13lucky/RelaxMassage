<?php

session_start();


require_once $_SERVER['DOCUMENT_ROOT'] . '/Relax/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');

   
    $errors = [];

    
    if (empty($name)) {
        $errors[] = 'Имя обязательно для заполнения';
    } elseif (strlen($name) > 100) {
        $errors[] = 'Имя слишком длинное (максимум 100 символов)';
    }

   
    if (empty($email)) {
        $errors[] = 'Email обязателен для заполнения';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Укажите корректный email';
    } elseif (strlen($email) > 255) {
        $errors[] = 'Email слишком длинный (максимум 255 символов)';
    }

    
    if (empty($phone)) {
        $errors[] = 'Телефон обязателен для заполнения';
    } elseif (!preg_match('/^\+?[0-9\s\-\(\)]{10,20}$/', $phone)) {
        $errors[] = 'Укажите корректный номер телефона';
    }

   
    if (empty($password)) {
        $errors[] = 'Пароль обязателен для заполнения';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Пароль должен содержать не менее 6 символов';
    } elseif (strlen($password) > 72) { 
        $errors[] = 'Пароль слишком длинный (максимум 72 символа)';
    }

  
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM profile WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Пользователь с таким email уже зарегистрирован';
        }
    }

    
    if (empty($errors)) {
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            
            $stmt = $pdo->prepare("INSERT INTO profile (name, phone, email, password) VALUES (?, ?, ?, ?)");
            
            
            $stmt->execute([$name, $phone, $email, $passwordHash]);

            $userId = $pdo->lastInsertId();

            
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_phone'] = $phone;

           
            header('Location: profile.php');
            exit();
        } catch (PDOException $e) {
           
            error_log('Ошибка регистрации: ' . $e->getMessage());
            $errors[] = 'Ошибка при регистрации. Пожалуйста, попробуйте позже.';
        }
    }

   
    if (!empty($errors)) {
        $_SESSION['reg_errors'] = $errors;
        $_SESSION['reg_data'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];
        header('Location: profile.php#register-form');
        exit();
    }
} else {
   
    header('Location: index.php');
    exit();
}