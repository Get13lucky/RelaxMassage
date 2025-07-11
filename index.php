<?php 
$pageTitle = "RelaxMassage - Главная";
include 'templates/header.php';
include 'templates/top-bar.php';
include 'templates/navigation.php';

include 'db.php';  


$sql = "SELECT * FROM services_category";
$result = $pdo->query($sql); 

$sql = "SELECT * FROM massagers";
$result_2 = $pdo->query($sql);
?>

<main>
  <div class="main_photo">
    <img src="images/MainPhoto.png" alt="Главное фото салона RelaxMassage">
  </div>

  <section class="intro">
    <h1>Услуги</h1>
  </section>

  
  <section class="service-boxes">
    <?php
    if ($result->rowCount() > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $service_name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $service_photo = htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8');
            
            echo "<div class='service-box'>";
            echo "<a href='/Relax/pages/services.php' class='service-link'>";
            echo "<img src='" . $service_photo . "' alt='" . $service_name . "'>";
            echo "<p>" . $service_name . "</p>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<p>На данный момент услуги недоступны.</p>";
    }
    ?>
  </section>
  
  <section id="about-massage" class="intro">
    <h2>СПА салон тайского массажа RelaxMassage</h2>
    <h3>Тайский СПА-салон «RelaxMassage» - это место в Екатеринбурге, где комфортно взрослым и детям. 
    Здесь красивый интерьер, приятные запахи, ненавязчивые услуги, низкие цены.</h3>
    
    <h3>В нашем тайском SPA-салоне прилагают все усилия, чтобы сделать гостей своими постоянными клиентами!
    Посетителей ждут не только искусство тайских мастеров и качественный сервис, но и разнообразные бонусные программы, 
    подарочные сертификаты, скидки в день рождения.</h3>
    
    <h3>Любой массаж полезен для здоровья, а тайский – особенно. 
    Это удовольствие, полноценный уход за телом, тонус в мышцах,
    эластичная кожа. Совмещая современные медицинские знания и древние практики,
    он завоевал мир своим расслабляющим и оздоравливающим действием.</h3>
    
    <h2>Тайский СПА в Екатеринбурге - с любовью и заботой</h2>
    <h3>Настоящий тайский массаж требует от мастера профессионализма, полной отдачи, 
    больших затрат физической энергии. Но результат стоит того!
    Преображаясь после посещения тайского салона буквально на глазах,
    человек испытывает радость от своего обновленного тела и стремится привести сюда своих близких.</h3>
    
    
    <h2>Наши мастера тайского массажа</h2>
   
    <div class="masters-photos">
      <?php
      if ($result_2->rowCount() > 0) {
          while($row = $result_2->fetch(PDO::FETCH_ASSOC)) {
              $master_photo = htmlspecialchars($row['photo'], ENT_QUOTES, 'UTF-8');
              $master_name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
              
              echo "<img src='" . $master_photo . "' alt='Мастер " . $master_name . "'>";
          }
      } else {
          echo "<p>Информация о мастерах временно недоступна.</p>";
      }
      ?>
    </div>
    
    <h4>Почему выбирают нас?</h4>
    <div class="why-choice-us-photos">
      <div class="photo-item">
        <img src="images/map.png" alt="Удобное расположение">
        <p>Удобное расположение</p>
      </div>
      <div class="photo-item">
        <img src="images/king.png" alt="Персональный подход">
        <p>Персональный подход</p>
      </div>
      <div class="photo-item">
        <img src="images/people.png" alt="Профессиональная команда">
        <p>Профессиональная команда</p>
      </div>
    </div>
  </section>
</main>

<?php
include 'templates/footer.php';

?>