<?php
// đảm bảo PHP session đã được khởi tạo trước khi sử dụng
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra tài khoản đã đăng nhập hay chưa
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['role']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function isCustomer() {
    return isLoggedIn() && $_SESSION['role'] === 'customer';
}

function isStaff() {
    return isLoggedIn() && $_SESSION['role'] === 'staff';
}

// Nếu chưa đăng nhập thì quay về trang đăng nhập
function requireLogin($redirectTo = '/CSMVB/admin/login.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectTo);
        exit();
    }
}

function requireAdmin($redirectTo = '/CSMVB/admin/login.php') {
    if (!isAdmin()) {
        header('Location: ' . $redirectTo);
        exit();
    }
}

// function requireCustomer($redirectTo = '/CSMVB/admin/login.php') {
//     if (!isCustomer()) {
//         header('Location: ' . $redirectTo);
//         exit();
//     }
// }

// function requireAdminOrStaff($redirectTo = '/CSMVB/admin/login.php') {
//     if (!isAdmin() && !isStaff()) {
//         header('Location: ' . $redirectTo);
//         exit();
//     }
// }

// function requireStaff($redirectTo = '/CSMVB/admin/login.php') {
//     if (!isStaff()) {
//         header('Location: ' . $redirectTo);
//         exit();
//     }
// }


// lấy đầy đủ thông tin người dùng đang đăng nhập
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }

    // Try to get from session first
    if (isset($_SESSION['user_data_complete'])) {
        return $_SESSION['user_data_complete'];
    }

    // Fetch complete user data from database
    try {
        require_once __DIR__ . '/database.php';
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if ($user) {
            // Cache complete user data in session
            $_SESSION['user_data_complete'] = $user;
            return $user;
        }
    } catch (Exception $e) {
        // Fallback to session data
    }

    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'] ?? '',
        'full_name' => $_SESSION['full_name'] ?? '',
        'email' => $_SESSION['email'] ?? '',
        'role' => $_SESSION['role'],
        'phone' => '',
        'address' => '',
        'created_at' => '',
        'password' => ''
    ];
}
// // Chuyển hướng người dùng theo vai trò
// function redirectByRole() {
//     if (!isLoggedIn()) {
//         return '/CSMVB/admin/login.php';
//     }

//     switch ($_SESSION['role']) {
//         case 'admin':
//             return '/CSMVB/admin/dashboard.php';
//         case 'staff':
//             return '/CSMVB/admin/dashboard/';
//         case 'customer':
//             return '/CSMVB/index.php';
//         default:
//             return '/CSMVB/admin/login.php';
//     }
// }

// Xử lý việc đăng nhập thành công
// function loginUser($userData) {
//     $_SESSION['user_id'] = $userData['id'];
//     $_SESSION['username'] = $userData['username'];
//     $_SESSION['full_name'] = $userData['full_name'];
//     $_SESSION['email'] = $userData['email'];
//     $_SESSION['role'] = $userData['role'];

//     // Cache complete user data
//     $_SESSION['user_data_complete'] = $userData;

//     // Regenerate session ID for security
//     session_regenerate_id(true);
// }

// Xử lý đăng xuất
function logout() {
    session_destroy();
    header('Location: /CSMVB/admin/login.php');
    exit();
}

// Phân quyền chức năng chi tiết
// function hasPermission($permission) {
//     if (!isLoggedIn()) {
//         return false;
//     }

//     $rolePermissions = [
//         'admin' => ['*'], // Admin has all permissions
//         'staff' => [
//             'view_orders', 'edit_orders', 'view_products', 'edit_products',
//             'view_customers', 'view_reports', 'manage_content'
//         ],
//         'customer' => [
//             'view_profile', 'edit_profile', 'view_orders', 'place_orders'
//         ]
//     ];

//     $userRole = $_SESSION['role'];
//     $permissions = $rolePermissions[$userRole] ?? [];

//     return in_array('*', $permissions) || in_array($permission, $permissions);
// }
?>