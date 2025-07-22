<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';?>
 <!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Decoration Inspiration</p>
          <h1>Decoration News</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- latest news -->
<div class="latest-news mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-1"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">Timeless Ceramic Art for Modern Spaces</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 12 March, 2025</span>
            </p>
            <p class="excerpt">
              Explore how handcrafted ceramic pieces are adding warmth and character to contemporary interiors.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-2"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">The Return of Vintage Glassware in Decor</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 08 March, 2025</span>
            </p>
            <p class="excerpt">
              Discover how vintage glass designs are making a stunning comeback in decorative trends.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-3"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">Textile Wall Art: A Soft Touch of Tradition</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 05 March, 2025</span>
            </p>
            <p class="excerpt">
              From tapestries to handwoven panels, textile decor is bringing stories and softness to walls.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-4"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">Decorative Pottery That Tells a Story</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 02 March, 2025</span>
            </p>
            <p class="excerpt">
              Dive into the world of pottery pieces that combine function and artistic storytelling.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-5"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">How Handmade Decorations Add Soul to Homes</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 28 February, 2025</span>
            </p>
            <p class="excerpt">
              Learn how hand-crafted ornaments make living spaces feel more personal and inviting.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="single-latest-news">
          <a href="single-news.php">
            <div class="latest-news-bg news-bg-6"></div>
          </a>
          <div class="news-text-box">
            <h3><a href="single-news.php">Color Trends in Artistic Decorations 2025</a></h3>
            <p class="blog-meta">
              <span class="author"><i class="fas fa-user"></i> Admin</span>
              <span class="date"><i class="fas fa-calendar"></i> 25 February, 2025</span>
            </p>
            <p class="excerpt">
              A look at the most popular color palettes being used by modern decor artists this year.
            </p>
            <a href="single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- pagination -->
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="pagination-wrap">
              <ul>
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a class="active" href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end pagination -->
  </div>
</div>
<!-- end latest news -->


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
<?php include 'includes/footer.php'; ?>
  <!-- end footer -->



  <!-- jquery -->
  <script src="assets/js/jquery-1.11.3.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- count down -->
  <script src="assets/js/jquery.countdown.js"></script>
  <!-- isotope -->
  <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
  <!-- waypoints -->
  <script src="assets/js/waypoints.js"></script>
  <!-- owl carousel -->
  <script src="assets/js/owl.carousel.min.js"></script>
  <!-- magnific popup -->
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <!-- mean menu -->
  <script src="assets/js/jquery.meanmenu.min.js"></script>
  <!-- sticker js -->
  <script src="assets/js/sticker.js"></script>
  <!-- main js -->
  <script src="assets/js/main.js"></script>
</body>

</html>