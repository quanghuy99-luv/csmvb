<?php
/* ================= NORMAL PAGE ================= */
require_once __DIR__ . '/components/header.php';
renderHeader('Dịch Vụ - MamaCore');
?>
 
    <section class="hero-section py-5" style="background: linear-gradient(135deg, #FFE1EC 0%, #FFFFFF 50%, #f7e0f4 100%);">
        <div class="container py-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-3">Chăm Sóc Toàn Diện <br> Cho <span class="text-danger" style="font-family: 'Pacifico', cursive; ">Mẹ và Bé</span></h1>
                    <p class="lead text-muted mb-4">Dịch vụ y tế chuyên nghiệp, tận tâm và chất lượng cao cho sức khỏe của gia đình bạn.</p>
                    <button class="btn text-white rounded-pill btn-lg px-5 py-3" style="background-color:#F06292;" onmouseover="this.style.backgroundColor='#d84374'; this.style.transform='scale(1.05)';"
                            onmouseout="this.style.backgroundColor='#F06292'; this.style.transform='scale(1)';" onclick="window.location.href='customer/contact.php'">Bắt đầu ngay</button>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://babybrezza.vn/wp-content/uploads/2021/01/kawaii-spa-dia-chi-spa-cho-me-va-be-uy-tin-o-sai-gon.jpg" 
                         class="img-fluid rounded-pill shadow-lg" alt="Mẹ và bé" style="width: 500px; height: 450px;">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="text-center fw-bold display-5 mb-5">Tại Sao Chọn MamaCore?</h2>
            <div class="row g-4" id="features-grid">
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="p-5 bg-white rounded-4 shadow-sm h-100 hover-lift feature-card">
                        <div class="mb-4 fs-1 text-danger"><i class="fas fa-user-md"></i></div>
                        <h3 class="h5 fw-bold">Bác Sĩ Chuyên Nghiệp</h3>
                        <p class="text-muted small mb-0">Đội ngũ bác sĩ sản phụ khoa giàu kinh nghiệm.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="p-5 bg-white rounded-4 shadow-sm h-100 hover-lift feature-card">
                        <div class="mb-4 fs-1 text-danger"><i class="fas fa-heartbeat"></i></div>
                        <h3 class="h5 fw-bold">Chăm Sóc 24/7</h3>
                        <p class="text-muted small mb-0">Luôn sẵn sàng phục vụ bạn mọi lúc, mọi nơi.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="p-5 bg-white rounded-4 shadow-sm h-100 hover-lift feature-card">
                        <div class="mb-4 fs-1 text-danger"><i class="fas fa-hospital"></i></div>
                        <h3 class="h5 fw-bold">Thiết Bị Hiện Đại</h3>
                        <p class="text-muted small mb-0">Cơ sở vật chất và thiết bị y tế tân tiến nhất.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="p-5 bg-white rounded-4 shadow-sm h-100 hover-lift feature-card">
                        <div class="mb-4 fs-1 text-danger"><i class="fas fa-smile"></i></div>
                        <h3 class="h5 fw-bold">Dịch Vụ Chân Tình</h3>
                        <p class="text-muted small mb-0">Chúng tôi coi gia đình bạn như gia đình mình.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <h2 class="text-center fw-bold display-5 mb-5">Các Dịch Vụ Chính</h2>
            <div class="row g-4 mb-5" id="services-grid">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-lift">
                        <img src="https://benhvienphuongdong.vn/public/uploads/2023/thang-7/cau-hoi-thang-7/kham-thai-dinh-ky-nhu-the-nao-la-hop-ly-1.jpg" class="card-img-top" alt="Khám Thai" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <h3 class="h5 fw-bold">Khám Thai</h3>
                            <p class="card-text text-muted small">Khám sức khỏe toàn diện cho mẹ bầu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-lift">
                        <img src="https://cdn-assets-eu.frontify.com/s3/frontify-enterprise-files-eu/eyJwYXRoIjoiaWhoLWhlYWx0aGNhcmUtYmVyaGFkXC9maWxlXC82bUxQMjVRTHA2N0RVQ0ZBMU5DWi5qcGcifQ:ihh-healthcare-berhad:CjsNhFgI6H2chfxft2Rp6osWNH5uqh-DDusT7Jnlgdo?format=webp" class="card-img-top" alt="Sau sinh" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <h3 class="h5 fw-bold">Chăm Sóc Sau Sinh</h3>
                            <p class="card-text text-muted small">Hỗ trợ phục hồi sức khỏe cho mẹ.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-lift">
                        <img src="https://www.matsaigon.com/wp-content/uploads/2018/03/kham-mat-cho-tre-3-e1524565768759.jpg" class="card-img-top" alt="Sơ sinh" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <h3 class="h5 fw-bold">Khám Sơ Sinh</h3>
                            <p class="card-text text-muted small">Kiểm tra chi tiết sức khỏe bé sơ sinh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-lift">
                        <img src="https://www.friso.com.vn/sites/default/files/2022-11/cach-nuoi-day-con-thong-minh-thumbnail.jpg" class="card-img-top" alt="Tư vấn" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <h3 class="h5 fw-bold">Nuôi Dạy Con</h3>
                            <p class="card-text text-muted small">Hướng dẫn bé khỏe mạnh và hạnh phúc.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="HTML/services.html" class="btn btn-outline-secondary px-5 rounded-pill fw-bold" style="border-color: #F06292; color: #F06292;">Xem Tất Cả Dịch Vụ</a>
            </div>
        </div>
    </section>

    <section class="py-5 text-white shadow-inner" style="background-color: #F06292;">
        <div class="container py-4">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <h3 class="display-5 fw-bold">15+</h3>
                    <p class="mb-0 opacity-75">Năm Kinh Nghiệm</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="display-5 fw-bold">10k+</h3>
                    <p class="mb-0 opacity-75">Gia Đình Tin Tưởng</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="display-5 fw-bold">98%</h3>
                    <p class="mb-0 opacity-75">Độ Hài Lòng</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="display-5 fw-bold">50+</h3>
                    <p class="mb-0 opacity-75">Bác Sĩ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-center text-white" style="background-color: #2fb3a5;">
        <div class="container py-5">
            <h2 class="display-5 fw-bold mb-3">Sẵn Sàng Chăm Sóc Gia Đình?</h2>
            <p class="fs-5 mb-4 opacity-75">Liên hệ với chúng tôi ngay để được tư vấn miễn phí.</p>
            <button class="btn btn-light btn-lg btn-outline-primary px-5 text-black rounded-pill shadow-lg hover-lift" onclick="window.location.href='HTML/contact.html'">Liên Hệ Ngay</button>
        </div>
    </section>

    <?php
    require_once __DIR__ . '/components/footer.php';
    renderFooter();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/style.js"></script>
    
