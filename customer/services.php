<?php
/* ================= HANDLE AJAX FIRST ================= */
require_once '../config/database.php';
$db = new Database();
$conn = $db->getConnection();

// ================= HANDLE INSERT =================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    try {
        $stmt = $conn->prepare("
            INSERT INTO bookings (
                service_name,
                service_price,
                customer_name,
                phone,
                email,
                note,
                created_at
            ) VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $_POST['service_name'],
            $_POST['service_price'],
            $_POST['customer_name'],
            $_POST['customer_phone'],
            $_POST['customer_email'],
            $_POST['customer_note']
        ]);

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
    }
    exit;
}

/* ================= NORMAL PAGE ================= */
require_once __DIR__ . '/components/header.php';
renderHeader('Dịch Vụ - MamaCore');
?>


<!-- Services Hero Banner -->
<section class="py-5" style="background: linear-gradient(135deg, #FFE1EC 0%, #FFFFFF 50%, #f7e0f4 100%);">
    <div class="container py-lg-5 text-center">
        <h1 class="display-3 fw-bold mb-3">Các Dịch Vụ Của Chúng Tôi <span style="color: #F06292; font-family: 'Pacifico', cursive;">MamaCore</span></h1>
        <p class="lead text-muted mb-4">Dịch vụ chăm sóc sức khỏe mẹ và bé toàn diện, chuyên nghiệp và tận tâm</p>
        <div style="width: 60px; height: 3px; background-color: #F06292; margin: 0 auto;"></div>
    </div>
</section>

<!-- Services Detail -->
<section class="py-5">
    <div class="container py-lg-5">
        <!-- Service 1 -->
        <div class="row align-items-center mb-5 g-5">
            <div class="col-lg-6">
                <img src="https://benhvienphuongdong.vn/public/uploads/2023/thang-7/cau-hoi-thang-7/kham-thai-dinh-ky-nhu-the-nao-la-hop-ly-1.jpg" alt="Khám Thai" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Khám Thai Định Kỳ</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Khám sức khỏe toàn diện cho mẹ bầu từ giai đoạn đầu đến cuối thai kỳ, giúp phát hiện sớm các vấn đề bất thường.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Siêu âm thai định kỳ</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Xét nghiệm máu và nước tiểu</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Đo huyết áp và cân nặng</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn dinh dưỡng</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hướng dẫn vận động an toàn</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 300.000 - 500.000 VNĐ/lần</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Khám Thai Định Kỳ" 
                        data-price="300.000 - 500.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">
                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>

        <!-- Service 2 -->
        <div class="row align-items-center mb-5 g-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="https://cdn-assets-eu.frontify.com/s3/frontify-enterprise-files-eu/eyJwYXRoIjoiaWhoLWhlYWx0aGNhcmUtYmVyaGFkXC9maWxlXC82bUxQMjVRTHA2N0RVQ0ZBMU5DWi5qcGcifQ:ihh-healthcare-berhad:CjsNhFgI6H2chfxft2Rp6osWNH5uqh-DDusT7Jnlgdo?format=webp" alt="Chăm Sóc Sau Sinh" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Chăm Sóc Sau Sinh</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Hỗ trợ toàn diện cho mẹ sau khi sinh, giúp phục hồi sức khỏe, tâm lý và hỗ trợ nuôi con bằng sữa mẹ.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Kiểm tra vết mổ/chỉ</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hướng dẫn tập luyện phục hồi</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn nuôi con bằng sữa mẹ</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Giúp xử lý tình trạng trầm cảm sau sinh</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn dinh dưỡng để tăng sữa</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 500.000 - 800.000 VNĐ/liệu trình</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Chăm Sóc Sau Sinh" 
                        data-price="500.000 - 800.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">
                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>

        <!-- Service 3 -->
        <div class="row align-items-center mb-5 g-5">
            <div class="col-lg-6">
                <img src="https://www.matsaigon.com/wp-content/uploads/2018/03/kham-mat-cho-tre-3-e1524565768759.jpg" alt="Khám Sơ Sinh" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Khám Sơ Sinh & Tiêm Chủng</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Kiểm tra sức khỏe chi tiết cho bé sơ sinh, phát hiện sớm bất thường, hướng dẫn chăm sóc bé.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Khám tổng quát cho bé sơ sinh</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Sàng lọc sơ sinh (Guthrie test)</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tiêm chủng đầy đủ theo lịch</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hướng dẫn chăm sóc bé hàng ngày</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Xử lý các tình trạng thường gặp</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 200.000 - 400.000 VNĐ/lần</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Khám Sơ Sinh & Tiêm Chủng" 
                        data-price="200.000 - 400.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">
                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>

        <!-- Service 4 -->
        <div class="row align-items-center mb-5 g-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="https://www.friso.com.vn/sites/default/files/2022-11/cach-nuoi-day-con-thong-minh-thumbnail.jpg" alt="Tư Vấn Nuôi Dạy" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Tư Vấn Nuôi Dạy Con</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Hướng dẫn cha mẹ cách nuôi dạy con khỏe mạnh, phát triển toàn diện và hạnh phúc.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn dinh dưỡng theo độ tuổi</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hướng dẫn phát triển tâm lý</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Xử lý các vấn đề hành vi</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn giáo dục sớm</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hỗ trợ điều hành áp lực làm cha mẹ</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 250.000 - 400.000 VNĐ/buổi</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Tư Vấn Nuôi Dạy Con" 
                        data-price="250.000 - 400.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">
                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>

        <!-- Service 5 -->
        <div class="row align-items-center mb-5 g-5">
            <div class="col-lg-6">
                <img src="https://medlatec.vn/media/9861/content/20210813_Khi-nao-nen-cho-be-di-kham-suc-khoe-tong-quat-4.jpg" alt="Khám Tổng Quát" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Khám Tổng Quát Định Kỳ</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Khám sức khỏe toàn diện cho trẻ em từ sơ sinh đến 18 tuổi, phát hiện sớm các vấn đề sức khỏe.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Kiểm tra toàn thân chi tiết</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Đánh giá sự phát triển</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Xét nghiệm y tế định kỳ</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn sức khỏe tổng quát</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hướng dẫn phòng bệnh</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 350.000 - 600.000 VNĐ/lần</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Khám Tổng Quát Định Kỳ" 
                        data-price="350.000 - 600.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">
                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>

        <!-- Service 6 -->
        <div class="row align-items-center g-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="https://cdn.prod.website-files.com/5c93193a199a685a12dd8142/6096000b98ae6506677fcc99_tv.jpg" alt="Tư Vấn Trực Tuyến" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-6 mb-3" style="color: #F06292;">Tư Vấn Trực Tuyến 24/7</h2>
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">Dịch vụ tư vấn sức khỏe qua video call, chat hoặc điện thoại với bác sĩ bất kỳ lúc nào.</p>
                <h4 class="fw-bold mb-3">Bao Gồm:</h4>
                <ul class="list-unstyled mb-4">
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Tư vấn trực tuyến 24/7</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Ghi chú y tế điện tử</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Kê đơn thuốc trực tuyến</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Theo dõi sức khỏe</li>
                    <li style="padding: 8px 0; color: #555;"><i class="fas fa-check" style="color: #F06292; margin-right: 10px;"></i> Hỗ trợ ứng phó khẩn cấp</li>
                </ul>
                <p class="fw-bold mb-3" style="color: #F06292; font-size: 1.1rem;">Giá: 150.000 - 250.000 VNĐ/buổi</p>
                <button class="btn-book btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color: #F06292; border: none; cursor: pointer; transition: 0.3s;" 
                        data-service="Tư Vấn Trực Tuyến 24/7" 
                        data-price="150.000 - 250.000 VNĐ"
                        onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';" onclick="openBookingModal(this)">

                    <i class="fas fa-calendar-check"></i> Đặt Lịch Ngay
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Booking Section -->
<section class="py-5" style="background-color: #FFF3F7;">
    <div class="container py-5 text-center">
        <h2 class="fw-bold display-5 mb-3">Sẵn Sàng Đặt Lịch?</h2>
        <p class="lead text-muted mb-4">Hãy liên hệ với chúng tôi để đặt lịch khám và tư vấn miễn phí</p>
        <button class="btn text-white rounded-pill px-5 py-3 shadow-sm" 
        style="background-color: #F06292; border: none; font-weight: 700; cursor: pointer; transition: 0.3s;" 
        onclick="window.location.href='contact.php'" onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';" onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';">Đặt Lịch Ngay</button>
    </div>
</section>
<!-- Booking Modal -->
<div id="bookingModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4); overflow-y: auto;">
    <div style="position: relative; margin: 10% auto; width: 90%; max-width: 500px;">
        <div class="bg-white rounded-4 p-4 shadow-lg" style="border: 1px solid #ddd; position: relative;">
            <span class="close" style="position: absolute; top: 20px; right: 25px; font-size: 32px; font-weight: bold; cursor: pointer; transition: all 0.3s; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; line-height: 1; color: #aaa;" onclick="closeBookingModal()" onmouseover="this.style.border='1px solid #d84374'; this.style.color='#ee008f';" onmouseout="this.style.border='none'; this.style.color='#aaa';">&times;</span>

            <h2 class="mb-4" style="color: #F06292;"><i class="fas fa-calendar-plus"></i> Đặt Lịch Dịch Vụ</h2>
            
            <form id="bookingForm">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Dịch vụ:</label>
                    <input type="text" id="serviceName" name="service_name" readonly style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; background-color: #f9f9f9;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Giá dịch vụ:</label>
                    <input type="text" id="servicePrice" name="service_price" readonly style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; background-color: #f9f9f9;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Họ và tên: <span style="color: #F06292;">*</span></label>
                    <input type="text" id="customerName" name="customer_name" required placeholder="Nguyễn Văn A" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; transition: 0.3s;" onfocus="this.style.borderColor='#F06292'; this.style.boxShadow='0 0 10px rgba(240, 98, 146, 0.2)';" onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Số điện thoại: <span style="color: #F06292;">*</span></label>
                    <input type="tel" id="customerPhone" name="customer_phone" required placeholder="0912345678" pattern="[0-9]{10,11}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; transition: 0.3s;" onfocus="this.style.borderColor='#F06292'; this.style.boxShadow='0 0 10px rgba(240, 98, 146, 0.2)';" onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Email:</label>
                    <input type="email" id="customerEmail" name="customer_email" placeholder="email@example.com" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; transition: 0.3s;" onfocus="this.style.borderColor='#F06292'; this.style.boxShadow='0 0 10px rgba(240, 98, 146, 0.2)';" onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Ghi chú:</label>
                    <textarea id="customerNote" name="customer_note" rows="3" placeholder="Thời gian mong muốn, yêu cầu đặc biệt..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Quicksand', sans-serif; transition: 0.3s;" onfocus="this.style.borderColor='#F06292'; this.style.boxShadow='0 0 10px rgba(240, 98, 146, 0.2)';" onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';"></textarea>
                </div>
                
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button class="close" type="button" style="flex: 1; padding: 10px; border: none; border-radius: 50px; font-weight: 700; cursor: pointer; background-color: #ddd; color: #333; transition: 0.3s;" onmouseover="this.style.backgroundColor='#bbb';" onmouseout="this.style.backgroundColor='#ddd';">
                        Hủy
                    </button>
                    <button type="submit" style="flex: 1; padding: 10px; border: none; border-radius: 50px; font-weight: 700; cursor: pointer; background-color: #F06292; color: white; transition: 0.3s;" onmouseover="this.style.backgroundColor='#d84374';" onmouseout="this.style.backgroundColor='#F06292';">
                        <i class="fas fa-check"></i> Xác Nhận Đặt Lịch
                    </button>
                </div>
            </form>
            

            <div id="successMessage" style="display: none; text-align: center; padding: 20px;">
                <i class="fas fa-check-circle" style="color: #28a745; font-size: 3rem;"></i>
                <h3 style="margin-top: 15px; font-weight: 700; color: #333;">Đặt lịch thành công!</h3>
                <p style="color: #666;">Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Booking Script -->
<script>

$(function () {

    const modal = $('#bookingModal');
    const form = $('#bookingForm');
    const successMessage = $('#successMessage');

    const SCRIPT_URL = 'https://script.google.com/macros/s/AKfycbwEtPaKAx9AJdxdEl6WGGE4RS5-52x3MUoF6TJjSBYJ8ex0yXnTGHbOeAN4uGenkPay/exec';

    /* ================= OPEN MODAL ================= */
    $(document).on('click', '.btn-book', function (e) {
        e.preventDefault();

        $('#serviceName').val($(this).data('service'));
        $('#servicePrice').val($(this).data('price'));

        form.show();
        successMessage.hide();
        modal.fadeIn(300);
    });

    /* ================= CLOSE MODAL ================= */
    $('.close, #cancelBtn').on('click', function () {
        modal.fadeOut(300);
        form[0].reset();
        form.show();
        successMessage.hide();
    });

    /* ================= SUBMIT ================= */
    form.on('submit', function (e) {
        e.preventDefault();

        const bookingData = {
            service: $('#serviceName').val(),
            price: $('#servicePrice').val(),
            name: $('#customerName').val().trim(),
            phone: $('#customerPhone').val().trim(),
            email: $('#customerEmail').val().trim(),
            note: $('#customerNote').val().trim()
        };

        if (!bookingData.name || !bookingData.phone) {
            alert('Vui lòng nhập họ tên và số điện thoại!');
            return;
        }

        /* ===== 1. SAVE GOOGLE SHEET ===== */
        $.ajax({
            url: SCRIPT_URL,
            method: 'POST',
            contentType: 'text/plain;charset=utf-8',
            data: JSON.stringify(bookingData)
        });

            /* ===== 2. SAVE DATABASE (PHP) ===== */
    $.post('', {
        ajax: 1,
        service_name: bookingData.service,
        service_price: bookingData.price,
        customer_name: bookingData.name,
        customer_phone: bookingData.phone,
        customer_email: bookingData.email,
        customer_note: bookingData.note
    }, function (res) {
        // res đã là một Object nhờ Header JSON từ PHP, không cần JSON.parse
        if (res.status === 'success') {
            form.hide();
            successMessage.fadeIn(300);

            setTimeout(() => {
                modal.fadeOut(300);
                form[0].reset();
                form.show();
                successMessage.hide();
            }, 2500);
        } else {
            alert('Lỗi DB: ' + (res.msg || 'Không rõ lỗi'));
        }
    }, 'json').fail(function() {
        alert('Không thể kết nối với server');
    });
        });

        /* ================= PHONE NUMBER ================= */
        $('#customerPhone').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

    });

</script>

<?php
require_once __DIR__ . '/components/footer.php';
renderFooter();
?>
