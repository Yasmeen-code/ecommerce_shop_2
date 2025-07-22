<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM footer_settings ORDER BY created_at DESC LIMIT 1");
$footer = $stmt->fetch();

$pagesStmt = $pdo->query("SELECT * FROM footer_pages");
$pages = $pagesStmt->fetchAll();
?>


  <!-- logo carousel -->
  <div class="logo-carousel-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="logo-carousel-inner">
            <div class="single-logo-item">
              <img src="assets/img/company-logos/1.png" alt="" />
            </div>
            <div class="single-logo-item">
              <img src="assets/img/company-logos/2.png" alt="" />
            </div>
            <div class="single-logo-item">
              <img src="assets/img/company-logos/3.png" alt="" />
            </div>
            <div class="single-logo-item">
              <img src="assets/img/company-logos/4.png" alt="" />
            </div>
            <div class="single-logo-item">
              <img src="assets/img/company-logos/5.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end logo carousel -->


<!-- footer -->
<div class="footer-area">
	<div class="container">
		<div class="row">
			<!-- About -->
			<div class="col-lg-3 col-md-6">
				<div class="footer-box about-widget">
					<h2 class="widget-title"><?= htmlspecialchars($footer['about_title']) ?></h2>
					<p><?= htmlspecialchars($footer['about_text']) ?></p>
				</div>
			</div>

			<!-- Contact -->
			<div class="col-lg-3 col-md-6">
				<div class="footer-box get-in-touch">
					<h2 class="widget-title"><?= htmlspecialchars($footer['contact_title']) ?></h2>
					<ul>
						<li><?= htmlspecialchars($footer['address']) ?></li>
						<li><?= htmlspecialchars($footer['email']) ?></li>
						<li><?= htmlspecialchars($footer['phone']) ?></li>
					</ul>
				</div>
			</div>

			<!-- Pages -->
			<div class="col-lg-3 col-md-6">
				<div class="footer-box pages">
					<h2 class="widget-title"><?= htmlspecialchars($footer['pages_title']) ?></h2>
					<ul>
						<?php foreach ($pages as $page): ?>
							<li><a href="<?= htmlspecialchars($page['page_link']) ?>"><?= htmlspecialchars($page['page_name']) ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<!-- Subscribe -->
			<div class="col-lg-3 col-md-6">
				<div class="footer-box subscribe">
					<h2 class="widget-title"><?= htmlspecialchars($footer['subscribe_title']) ?></h2>
					<p><?= htmlspecialchars($footer['subscribe_text']) ?></p>
					<form action="subscribe.php" method="POST">
						<input type="email" name="email" placeholder="Email" required>
						<button type="submit"><i class="fas fa-paper-plane"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights Reserved.<br>
					Distributed By - <a href="https://themewagon.com/">Themewagon</a>
				</p>
			</div>
			<div class="col-lg-6 text-right col-md-12">
				<div class="social-icons">
					<ul>
						<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end copyright -->