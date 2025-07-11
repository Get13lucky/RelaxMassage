<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'RelaxMassage'; ?></title>
    <link rel="stylesheet" href="/Relax/style.css">
</head>
<body> 

<?php 
$pageTitle = "RelaxMassage - Контакты";
include '../templates/header.php'; 
include '../templates/top-bar.php'; 
include '../templates/navigation.php'; 
?>

<main>
  <section class="intro">
    <h1>Контакты</h1>
    <h5>Предоставление услуг осуществляется на основании лицензии № 66-01-12345</h5>

    <div class="phone-numbers">
        <p>+7 (123) 456-78-90</p>
        <p>+7 (987) 654-32-10</p>
    </div>

    <div class="address">
        <p>г. Екатеринбург, крауля 168</p>
        <p>Часы работы: ПН-ВС с 10:00 до 22:00 </p>
    </div>

    <div class="social-icons">
        <a href="https://telegram.org/" target="_blank"><img src="/Relax/images/telegram.png" alt="Telegram"></a>
        <a href="https://www.whatsapp.com/" target="_blank"><img src="/Relax/images/whatsup.png" alt="WhatsApp"></a>
    </div>

    <div class="payment-container">
        <div class="payment">
            <p>Реквизиты:</p>
            <p>ООО "Рога и копыта"</pз>
            <p>ИНН 123456789</p>
            <p>ОГРН 987654321</p>
            <p>почтовый адрес 620131, Екатеринбург, ул. Крауля 168</p>
            <p>RelaxMassage@gmail.com</p>
        </div>
        <img class="img-qr-code" src="/Relax/images/qr-code_2.png" alt="QR код">
    </div>
  </section>
</main>

<?php include '../templates/footer.php'; ?> 

</body> 
</html>
