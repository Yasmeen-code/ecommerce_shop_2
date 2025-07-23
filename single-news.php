<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid news ID");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
  die("News not found");
}
$stmt2 = $pdo->prepare("
    SELECT c.comment, c.created_at, u.name, u.avatar
    FROM comments c
    JOIN users u ON c.user_id = u.id
    WHERE c.news_id = ?
    ORDER BY c.created_at DESC
");
$stmt2->execute([$id]); // $id هو news_id
$comments = $stmt2->fetchAll();

?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Read the Details</p>
          <h1>Single Article</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- single article section -->
<div class="mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="single-article-section">
          <div class="single-article-text">

            <div class="single-artcile-bg mb-4" style="margin-bottom: 20px;">
              <img
                src="assets/img/latest-news/<?php echo htmlspecialchars($news['image']); ?>"
                alt="<?php echo htmlspecialchars($news['title']); ?>"
                class="img-fluid rounded"
                style="display: block; width: 150%; height: auto; max-height: 900px; object-fit: cover; margin-bottom: 20px;" />
            </div>

            <div class="mb-4" style="padding: 10px; background-color: #fff; border-radius: 10px;">
              <p class="blog-meta mb-2 text-muted">
                <span class="author me-3"><i class="fas fa-user"></i> <?php echo htmlspecialchars($news['author']); ?></span>
                <span class="date"><i class="fas fa-calendar"></i> <?php echo date("d F, Y", strtotime($news['date'])); ?></span>
              </p>
              <h2 class="mb-3"><?php echo htmlspecialchars($news['title']); ?></h2>
              <p style="line-height: 1.8;"><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
            </div>

          </div>


          <div class="comments-list-wrap">
            <h3 class="comment-count-title"><?= count($comments) ?> Comments</h3>
            <div class="comment-list">
              <?php foreach ($comments as $comment): ?>
                <div class="single-comment-body">
                  <div class="comment-user-avater">
                    <img src="<?= !empty($comment['avatar']) ? 'uploads/avatars/' . htmlspecialchars($comment['avatar']) : 'assets/img/avaters/default.png' ?>" alt="avatar" />
                  </div>
                  <div class="comment-text-body">
                    <h4>
                      <?= htmlspecialchars($comment['name']) ?>
                      <span class="comment-date"><?= date('F j, Y', strtotime($comment['created_at'])) ?></span>
                    </h4>
                    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>


            	<div class="comment-template">
          <form action="add_comment.php" method="POST">
            <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>"> <!-- استبدلي 1 بـ ID الحقيقي للخبر -->
            <p>
              <input type="text" name="name" placeholder="Your Name" required />
              <input type="email" name="email" placeholder="Your Email" required />
            </p>
            <p>
              <textarea name="comment" cols="30" rows="10" placeholder="Your Message" required></textarea>
            </p>
            <p><input type="submit" value="Submit" /></p>
          </form>
              </div>

        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar-section">
          <div class="recent-posts">
            <h4>Recent Posts</h4>
            <ul>
              <?php
              $stmt3 = $pdo->query("SELECT id, title FROM news ORDER BY created_at DESC LIMIT 5");
              while ($row = $stmt3->fetch()) {
                echo '<li><a href="single-news.php?id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></li>';
              }
              ?>
            </ul>
          </div>

          <div class="archive-posts">
            <h4>Archive Posts</h4>
            <ul>
              <?php
              $stmt = $pdo->query("SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS count 
                         FROM news 
                         GROUP BY month 
                         ORDER BY MIN(created_at) DESC 
                         LIMIT 5");
              while ($row = $stmt->fetch()) {
                echo '<li><a href="archive.php?month=' . urlencode($row['month']) . '">' . $row['month'] . ' (' . $row['count'] . ')</a></li>';
              }
              ?>
            </ul>
          </div>
          <div class="tag-section">
            <h4>Tags</h4>
            <ul>
              <?php
              $stmt = $pdo->query("SELECT * FROM news_tags LIMIT 10");
              while ($row = $stmt->fetch()) {
                echo '<li><a href="tag.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></li>';
              }
              ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- end single article section -->

<?php include 'includes/footer.php'; ?>