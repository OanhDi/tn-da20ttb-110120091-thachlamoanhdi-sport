<?php
// Thay vì kết nối cơ sở dữ liệu, trả về dữ liệu mẫu
header('Content-Type: application/json');
echo json_encode([
    'daily' => 12000,  // Doanh thu ngày hiện tại
    'weekly' => 45000, // Doanh thu tuần này
    'monthly' => 200000, // Doanh thu tháng này
    'yearly' => 1500000 // Doanh thu năm này
]);
?>