<?php 
session_start();

$pageTitle = "RelaxMassage - Профиль";
include '../templates/header.php';
include '../templates/top-bar.php';
include '../templates/navigation.php';

$regErrors = $_SESSION['reg_errors'] ?? [];
$loginErrors = $_SESSION['login_errors'] ?? [];
$regData = $_SESSION['reg_data'] ?? [];

$activeTab = 'login'; 
if (!empty($regErrors)) {
    $activeTab = 'register';
} elseif (!empty($loginErrors)) {
    $activeTab = 'login';
}

unset($_SESSION['reg_errors']);
unset($_SESSION['login_errors']);
unset($_SESSION['reg_data']);
?>

<main>
    <section class="intro">
        <h1>Профиль</h1>
    </section>
    <section>
        <?php if (isset($_SESSION['user_id'])): ?>
            <div>
                <div class="profile-info">
                    <p class="profile-data" style="font-size: 30px; color:black"><strong>Имя:</strong> <?= htmlspecialchars($_SESSION['user_name']) ?></p>
                    <p class="profile-data" style="font-size: 30px; color:black"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user_email']) ?></p>
                    <p class="profile-data" style="font-size: 30px; color:black"><strong>Телефон:</strong> <?= htmlspecialchars($_SESSION['user_phone']) ?></p>
                </div>
                <form action="logout.php" method="post">
                    <button type="submit" style="background-color: #6C3600; color: #E0BF88; width: 15%; margin-left: 45px; margin-top: 15px; padding: 12px 0; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer;">Выйти из профиля</button>
                </form>
            </div>
        <?php else: ?>
            <div class="profile-content">
                <div class="form-switcher">
                    <input type="radio" id="login-tab" name="form-tab" <?= $activeTab === 'login' ? 'checked' : '' ?>>
                    <input type="radio" id="register-tab" name="form-tab" <?= $activeTab === 'register' ? 'checked' : '' ?>>
                    
                    <div class="tab-labels-container">
                        <label for="login-tab" class="tab-label">Вход</label>
                        <label for="register-tab" class="tab-label">Регистрация</label>
                    </div>
                    
                    <div class="forms-container">
                        <form id="login-form" class="auth-form" method="post" action="/Relax/pages/login_handler.php">
                            <?php if (!empty($loginErrors)): ?>
                                <div class="errors">
                                    <?php foreach ($loginErrors as $error): ?>
                                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($regData['email'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background-color: #6C3600; color: #E0BF88; width: 80%; margin-top: 10px; padding: 12px 0; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer;">Войти</button>
                        </form>
                        
                        <form id="register-form" class="auth-form" method="post" action="/Relax/pages/register_handler.php">
                            <?php if (!empty($regErrors)): ?>
                                <div class="errors">
                                    <?php foreach ($regErrors as $error): ?>
                                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label for="reg-name">Имя</label>
                                <input type="text" id="reg-name" name="name" required value="<?= htmlspecialchars($regData['name'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="reg-email">Email</label>
                                <input type="email" id="reg-email" name="email" required value="<?= htmlspecialchars($regData['email'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="reg-phone">Телефон</label>
                                <input type="tel" id="reg-phone" name="phone" required value="<?= htmlspecialchars($regData['phone'] ?? '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="reg-password">Пароль</label>
                                <input type="password" id="reg-password" name="password" required>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background-color: #6C3600; color: #E0BF88; width: 80%; margin-top: 10px; padding: 12px 0; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer;">Зарегистрироваться</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
include '../templates/footer.php';
?>