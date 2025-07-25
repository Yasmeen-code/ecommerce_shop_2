<?php
session_start();
include 'includes/db.php';
include 'includes/header.php'; ?>
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
      <?php
      $stmt = $pdo->query("SELECT * FROM news ORDER BY date DESC LIMIT 6");
      while ($news = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="col-lg-4 col-md-6">
          <div class="single-latest-news">
            <a href="single-news.php?id=<?= $news['id'] ?>">
              <div class="latest-news-bg" style="background-image: url('assets/img/latest-news/<?= htmlspecialchars($news['image']) ?>');"></div>
            </a>
            <div class="news-text-box">
              <h3><a href="single-news.php?id=<?= $news['id'] ?>"><?= htmlspecialchars($news['title']) ?></a></h3>
              <p class="blog-meta">
                <span class="author"><i class="fas fa-user"></i> <?= htmlspecialchars($news['author']) ?></span>
                <span class="date"><i class="fas fa-calendar"></i> <?= date("d F, Y", strtotime($news['date'])) ?></span>
              </p>
              <p class="excerpt"><?= htmlspecialchars($news['excerpt']) ?></p>
              <a href="single-news.php?id=<?= $news['id'] ?>" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- end latest news -->

<!-- footer -->
<?php include 'includes/footer.php'; ?>
<!-- end footer -->