<?php
// Set timezone to Vietnam
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once '../config/database.php';
require_once '../config/auth_unified.php';

// Kiểm tra đăng nhập với vai trò admin
requireAdmin('/CSMVB/customer/auth/login.php');

$db = new Database();
$conn = $db->getConnection();
$currentUser = getCurrentUser();

// ==================== HANDLE AJAX REQUESTS ====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    
    $action = $_POST['action'] ?? '';
    
    // Delete booking
    if ($action === 'delete') {
        try {
            $bookingId = $_POST['booking_id'] ?? null;
            if (!$bookingId) throw new Exception('ID không hợp lệ');
            
            $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
            $stmt->execute([$bookingId]);
            
            echo json_encode(['status' => 'success', 'message' => 'Xóa thành công']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }
    
    // Update booking status
    if ($action === 'update_status') {
        try {
            $bookingId = $_POST['booking_id'] ?? null;
            $status = $_POST['status'] ?? null;
            
            if (!$bookingId || !$status) throw new Exception('Dữ liệu không hợp lệ');
            
            $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
            $stmt->execute([$status, $bookingId]);
            
            echo json_encode(['status' => 'success', 'message' => 'Cập nhật thành công']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }
}

// ==================== GET BOOKINGS ====================
try {
    $search = $_GET['search'] ?? '';
    $status_filter = $_GET['status'] ?? '';
    
    $query = "SELECT * FROM bookings WHERE 1=1";
    $params = [];
    
    if ($search) {
        $query .= " AND (customer_name LIKE ? OR email LIKE ? OR phone LIKE ?)";
        $searchTerm = "%$search%";
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    }
    
    if ($status_filter) {
        $query .= " AND status = ?";
        $params[] = $status_filter;
    }
    
    $query .= " ORDER BY created_at DESC";
    
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $bookings = $stmt->fetchAll();
} catch (Exception $e) {
    $error_message = "Lỗi: " . $e->getMessage();
    $bookings = [];
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MamaCore</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Header/Navbar -->
    <nav class="navbar navbar-dark bg-danger shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h5">❤️ MamaCore Admin</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white">Xin chào, <strong><?php echo htmlspecialchars($currentUser['full_name'] ?? $currentUser['username']); ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4 mb-4">
        <!-- Dashboard Header with Search -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 text-danger mb-3">📊 Quản lý Đặt lịch</h1>
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-md-6 col-lg-4">
                        <input type="text" name="search" placeholder="Tìm theo tên, email, SĐT..." 
                               class="form-control" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Chờ xác nhận</option>
                            <option value="confirmed" <?php echo $status_filter === 'confirmed' ? 'selected' : ''; ?>>Đã xác nhận</option>
                            <option value="completed" <?php echo $status_filter === 'completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                            <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Huỷ</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-search"></i> Tìm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Tổng đặt lịch</h5>
                        <p class="display-6 text-danger fw-bold"><?php echo count($bookings); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Chờ xác nhận</h5>
                        <p class="display-6 text-warning fw-bold">
                            <?php 
                            $pending = count(array_filter($bookings, fn($b) => $b['status'] == 'pending'));
                            echo $pending;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Đã xác nhận</h5>
                        <p class="display-6 text-info fw-bold">
                            <?php 
                            $confirmed = count(array_filter($bookings, fn($b) => $b['status'] == 'confirmed'));
                            echo $confirmed;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Hoàn thành</h5>
                        <p class="display-6 text-success fw-bold">
                            <?php 
                            $completed = count(array_filter($bookings, fn($b) => $b['status'] == 'completed'));
                            echo $completed;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <?php if (empty($bookings)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fs-1 mb-3 d-block"></i>
                        <p>📭 Không có đặt lịch nào</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Dịch vụ</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><strong>#<?php echo $booking['id']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['email']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['service_name']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['service_price']); ?> VNĐ</td>
                                        <td>
                                            <select style="border: 2px solid red;" onchange="updateStatus(<?php echo $booking['id']; ?>, this.value)" class="form-select form-select-sm w-auto">
                                                <option value="pending" <?php echo $booking['status'] === 'pending' ? 'selected' : ''; ?>>Chờ xác nhận</option>
                                                <option value="confirmed" <?php echo $booking['status'] === 'confirmed' ? 'selected' : ''; ?>>Đã xác nhận</option>
                                                <option value="completed" <?php echo $booking['status'] === 'completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                                                <option value="cancelled" <?php echo $booking['status'] === 'cancelled' ? 'selected' : ''; ?>>Huỷ</option>
                                            </select>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($booking['created_at'])); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button onclick="viewDetails(<?php echo htmlspecialchars(json_encode($booking)); ?>)" 
                                                        class="btn btn-sm btn-primary" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button onclick="deleteBooking(<?php echo $booking['id']; ?>)" 
                                                        class="btn btn-sm btn-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Chi tiết đặt lịch</h5>
                    <button type="button" class="btn-close btn-close-white" onclick="closeModal()"></button>
                </div>
                <div class="modal-body" id="detailsContent">
                    <!-- Nội dung sẽ được thêm qua JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const detailsModalBS = new bootstrap.Modal(document.getElementById('detailsModal'));
        
        function viewDetails(booking) {
            const content = document.getElementById('detailsContent');
            
            content.innerHTML = `
                <div class="mb-3">
                    <label class="form-label fw-bold">ID đặt lịch:</label>
                    <input type="text" class="form-control" readonly value="#${booking.id}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên khách hàng:</label>
                    <input type="text" class="form-control" readonly value="${booking.customer_name}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Số điện thoại:</label>
                    <input type="text" class="form-control" readonly value="${booking.phone}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email:</label>
                    <input type="text" class="form-control" readonly value="${booking.email}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Dịch vụ:</label>
                    <input type="text" class="form-control" readonly value="${booking.service_name}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Giá dịch vụ:</label>
                    <input type="text" class="form-control" readonly value="${Number(booking.service_price).toLocaleString('vi-VN')} VNĐ">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Ghi chú:</label>
                    <textarea class="form-control" readonly rows="3">${booking.note || 'Không có ghi chú'}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Ngày tạo:</label>
                    <input type="text" class="form-control" readonly value="${new Date(booking.created_at).toLocaleString('vi-VN')}">
                </div>
            `;
            
            detailsModalBS.show();
        }
        
        function closeModal() {
            detailsModalBS.hide();
        }
        
        function updateStatus(bookingId, status) {
            if (!confirm('Bạn có chắc muốn cập nhật trạng thái?')) {
                location.reload();
                return;
            }
            
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ajax=1&action=update_status&booking_id=${bookingId}&status=${status}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('✓ ' + data.message);
                    location.reload();
                } else {
                    alert('✗ ' + data.message);
                }
            })
            .catch(err => {
                alert('Lỗi: ' + err);
                location.reload();
            });
        }
        
        function deleteBooking(bookingId) {
            if (!confirm('Xác nhận xóa đặt lịch này? Hành động không thể hoàn tác!')) {
                return;
            }
            
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ajax=1&action=delete&booking_id=${bookingId}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('✓ ' + data.message);
                    location.reload();
                } else {
                    alert('✗ ' + data.message);
                }
            })
            .catch(err => {
                alert('Lỗi: ' + err);
                location.reload();
            });
        }
    </script>
</body>
</html>
