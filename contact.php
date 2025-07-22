<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>We're Here to Help</p>
          <h1>Contact Us</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="form-title">
          <h2>Have any inquiries about our handmade pieces?</h2>
          <p>
            We'd love to hear from you. Whether it's about our ceramic art, glass ornaments, or custom designs—send us a message and we'll get back to you soon.
          </p>
        </div>
        <div id="form_status"></div>
        <div class="contact-form">
          <form method="POST" action="process_contact.php">
            <p>
              <input type="text" placeholder="Your Name" name="name" id="name" required />
              <input type="email" placeholder="Your Email" name="email" id="email" required />
            </p>
            <p>
              <input type="tel" placeholder="Phone Number" name="phone" id="phone" />
              <input type="text" placeholder="Subject" name="subject" id="subject" />
            </p>
            <p>
              <textarea name="message" id="message" cols="30" rows="10" placeholder="Write your message here..."></textarea>
            </p>
            <input type="hidden" name="token" value="FsWga4&@f6aw" />
            <p><input type="submit" value="Send Message" /></p>
          </form>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="contact-form-wrap">
          <div class="contact-form-box">
            <h4><i class="fas fa-map"></i> Our Studio</h4>
            <p>
              24/7 Artisan Alley<br />
              Old Town, Decorative District<br />
              Cairo, Egypt
            </p>
          </div>
          <div class="contact-form-box">
            <h4><i class="far fa-clock"></i> Working Hours</h4>
            <p>
              Mon - Fri: 10:00 AM - 6:00 PM <br />
              Sat: 11:00 AM - 4:00 PM <br />
              Closed on Sundays
            </p>
          </div>
          <div class="contact-form-box">
            <h4><i class="fas fa-address-book"></i> Contact Info</h4>
            <p>
              Phone: +20 100 555 1234 <br />
              Email: support@decorcrafts.com
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end contact form -->

<!-- find our location -->
<div class="find-location blue-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <p><i class="fas fa-map-marker-alt"></i> Find Our Studio on the Map</p>
      </div>
    </div>
  </div>
</div>
<!-- end find our location -->

<!-- google map section -->
<div class="embed-responsive embed-responsive-21by9">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27604.87388940844!2d31.234567!3d30.045678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840a3a8b9a473%3A0xabcdef123456789!2sDowntown%20Cairo%2C%20Egypt!5e0!3m2!1sen!2seg!4v1690000000000!5m2!1sen!2seg"
    width="600"
    height="450"
    frameborder="0"
    style="border:0"
    allowfullscreen=""
    class="embed-responsive-item"></iframe>
</div>
<!-- end google map section -->

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
<!-- form validation js -->
<script src="assets/js/form-validate.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>
</body>

</html>