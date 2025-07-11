<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/Relax/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $booking_id = $_POST['booking_id'] ?? null;
    
    if (!empty($booking_id)) {
        try {
            
            $stmt = $pdo->prepare("SELECT * FROM future_order WHERE id = ? AND profile_id = ?");
            $stmt->execute([$booking_id, $_SESSION['user_id']]);
            $booking = $stmt->fetch();
            
            if ($booking) {
                
                $updateStmt = $pdo->prepare("UPDATE future_order SET status = 'отмененно' WHERE id = ?");
                $updateStmt->execute([$booking_id]);
                
                $_SESSION['booking_success'] = 'Запись успешно отменена';
            }
        } catch (PDOException $e) {
            $_SESSION['booking_errors'] = ['Ошибка при отмене записи: ' . $e->getMessage()];
        }
    }
}

header('Location: profile.php');
exit();
?>