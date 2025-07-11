<?php 
$pageTitle = "RelaxMassage - Услуги и цены";
include '../templates/header.php';
include '../templates/top-bar.php';
include '../templates/navigation.php';
include '../db.php'; 

try {
    
    $categories = $pdo->query("SELECT * FROM services_category");
?>
<main class="main_services">
    <section class="intro">
        <h1>Услуги</h1>
    </section>

    <section class="services-container">
        <?php if ($categories->rowCount() > 0): ?>
            <?php while($category = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                <?php 
               
                $category_id = $category['id'];
                $stmt = $pdo->prepare("SELECT * FROM service WHERE category_id = ?");
                $stmt->execute([$category_id]);
                $services = $stmt;
                ?>
                
                <div class="category-card">
                    <div class="category-header">
                        <h2><?= htmlspecialchars($category['name']) ?></h2>
                        <img src="<?= htmlspecialchars($category['photo']) ?>" alt="<?= htmlspecialchars($category['name']) ?>">
                    </div>
                    
                    <?php if ($services->rowCount() > 0): ?>
                        <div class="services-list">
                            <?php while($service = $services->fetch(PDO::FETCH_ASSOC)): ?>
                                <div class="service-item">
                                    <h3><?= htmlspecialchars($service['name']) ?></h3>
                                    <div class="service-details">
                                        <span class="price"><?= number_format($service['price'], 0, '', ' ') ?> ₽</span>
                                        <span class="duration"><?= $service['time'] ?> мин.</span>
                                    </div>
                                    <a href="booking.php?service_id=<?= $service['id'] ?>" class="book-btn">Записаться</a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="no-services">Услуги в этой категории временно отсутствуют</p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-categories">Категории услуг временно отсутствуют</p>
        <?php endif; ?>
    </section>
</main>
<?php
} catch (PDOException $e) {
    echo "<p class='error'>Ошибка при загрузке данных: " . $e->getMessage() . "</p>";
}

include '../templates/footer.php';
?>