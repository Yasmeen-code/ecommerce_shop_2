<?php
session_start();
 include 'includes/db.php'; ?>
<?php include 'includes/header.php'; 

?>

<!-- home page slider -->
<div class="homepage-slider">
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Unique & Elegant</p>
							<h1>Stunning Decorative Pieces</h1>
							<div class="hero-btns">
								<a href="shop.php" class="boxed-btn">View Collection</a>
								<a href="contact.php" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="single-homepage-slider homepage-bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">New Designs Everyday</p>
							<h1>Exclusive Art Collection</h1>
							<div class="hero-btns">
								<a href="shop.php" class="boxed-btn">Visit Gallery</a>
								<a href="contact.php" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="single-homepage-slider homepage-bg-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-right">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Big Sale on Artworks!</p>
							<h1>Up to 50% Off this Month</h1>
							<div class="hero-btns">
								<a href="shop.php" class="boxed-btn">Visit Gallery</a>
								<a href="contact.php" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end home page slider -->

<!-- features list section -->
<div class="list-section pt-80 pb-80">
	<div class="container">

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-shipping-fast"></i>
					</div>
					<div class="content">
						<h3>Free Shipping</h3>
						<p>When order over $75</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-phone-volume"></i>
					</div>
					<div class="content">
						<h3>24/7 Support</h3>
						<p>Get support all day</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="list-box d-flex justify-content-start align-items-center">
					<div class="list-icon">
						<i class="fas fa-sync"></i>
					</div>
					<div class="content">
						<h3>Refund</h3>
						<p>Get refund within 3 days!</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- end features list section -->

<!-- product section -->
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Our</span> Artworks</h3>
					<p>Discover a curated collection of handcrafted decorations and artistic ornaments made with love and detail.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
			$stmt = $pdo->query("SELECT * FROM products LIMIT 6");
			while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php?id=<?= $product['id'] ?>">
								<img src="assets/img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
							</a>
						</div>
						<h3><?= htmlspecialchars($product['name']) ?></h3>
						<p class="product-price"><span>Per Piece</span> <?= number_format($product['price'], 2) ?>$</p>

						<form method="POST" action="add_to_cart.php">
							<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
							<button type="submit" name="add_to_cart" class="cart-btn">
								Add to Cart
							</button>
						</form>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<!-- end product section -->

<!-- cart banner section -->
<?php
$deal = $pdo->query("SELECT d.*, p.name FROM deals d
JOIN products p ON d.product_id = p.id
ORDER BY d.created_at DESC
LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<!-- deal section -->
<?php if ($deal): ?>
	<section class="cart-banner pt-100 pb-100" style="background-color: #eaeaea">
		<div class="container">
			<div class="row clearfix">
				<div class="image-column col-lg-6">
					<div class="image">
						<div class="price-box">
							<div class="inner-price">
								<span class="price">
									<strong><?= $deal['discount_percent'] ?>%</strong> <br> off per piece
								</span>
							</div>
						</div>
						<img src="assets/img/<?= htmlspecialchars($deal['image']) ?>" alt=""  >
					</div>
				</div>
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">Featured</span> Artwork of the Month</h3>
					<h4><?= htmlspecialchars($deal['name']) ?></h4>
					<div class="text"><?= nl2br(htmlspecialchars($deal['description'])) ?></div>
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="<?= $deal['end_date'] ?>">
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Days</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Hours</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Mins</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Secs</div>
							</div>
						</div>
					</div>
					<a href="cart.php?add=<?= $deal['product_id'] ?>" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- end cart banner section -->

<!-- testimonail-section -->
<div class="testimonail-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 text-center">
				<div class="testimonial-sliders">
					<?php
					$stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 10");
					while ($t = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/<?= htmlspecialchars($t['avatar']) ?>" alt="<?= htmlspecialchars($t['client_name']) ?>">
							</div>
							<div class="client-meta">
								<h3><?= htmlspecialchars($t['client_name']) ?> <span><?= htmlspecialchars($t['role']) ?></span></h3>
								<p class="testimonial-body">
									" <?= htmlspecialchars($t['message']) ?> "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- end testimonail-section -->

<!-- advertisement section -->
<div class="abt-section mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="abt-bg">
					<a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="abt-text">
					<p class="top-sub">Since Year 1999</p>
					<h2>We are <span class="orange-text">DecoCraft</span></h2>
					<p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed, interdum velit. Nam eu molestie lorem.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat veritatis minus, et labore minima mollitia qui ducimus.</p>
					<a href="about.php" class="boxed-btn mt-4">know more</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end advertisement section -->

<!-- shop banner -->
<?php
$stmt = $pdo->prepare("SELECT * FROM deals WHERE end_date >= NOW() and id='3' ORDER BY created_at DESC LIMIT 1");
$stmt->execute();
$deal = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php if ($deal): ?>
	<!-- dynamic shop banner -->
	<section class="shop-banner" style="background-image: url('assets/img/<?php echo $deal['image']; ?>'); background-size: cover; background-position: center;">
		<div class="container">
			<h3><?php echo $deal['description']; ?> <br> with <span class="orange-text"><?php echo $deal['discount_percent']; ?>% OFF</span></h3>
			<div class="sale-percent"><span>Sale!</span> <?php echo $deal['discount_percent']; ?>% <span>off</span></div>
			<a href="shop.php" class="cart-btn btn-lg">Shop Now</a>
		</div>
	</section>
	<!-- end dynamic shop banner -->
<?php endif; ?>

<!-- end shop banner -->

<!-- latest news -->
<div class="latest-news pt-150 pb-150">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Our</span> News</h3>
					<p>Stay updated with the latest trends, stories, and inspirations from the world of handmade crafts and artistic decorations.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
			$stmt = $pdo->query("SELECT * FROM news ORDER BY date DESC LIMIT 3");
			while ($news = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.php?id=<?= $news['id'] ?>">
							<div class="latest-news-bg" style="background-image: url('assets/img/latest-news/<?= htmlspecialchars($news['image']) ?>'); height: 250px; background-size: cover; background-position: center;"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="single-news.php?id=<?= $news['id'] ?>"><?= htmlspecialchars($news['title']) ?></a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> <?= htmlspecialchars($news['author']) ?></span>
								<span class="date"><i class="fas fa-calendar"></i> <?= date('d F, Y', strtotime($news['date'])) ?></span>
							</p>
							<p class="excerpt"><?= htmlspecialchars($news['excerpt']) ?></p>
							<a href="single-news.php?id=<?= $news['id'] ?>" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="news.php" class="boxed-btn">More Articles</a>
			</div>
		</div>

	</div>
</div>
<!-- end latest news -->

<?php include 'includes/footer.php'; ?>

