<!-- FOOTER -->
  <div class="footer">
    <div class="footer-content">
      <div class="footer-section about">
        <h1 class="logo-text" style="margin: 0 5px;"><span>Personal</span>BusinessBlog</h1>
        <p>
        PersonalBusinessBlog is a blog where you can find always updated posts in the area of business, health, self-help, 
        motivation, and spirituality. 
        Although it seems impossible, we are always looking to create a world where everyone is financially secured.
        </p>
        <!-- <br> -->

        <div class="contact">
          <i class="fa fa-envelope"> &nbsp; personalbusinessteam@gmail.com</i>
        </div>

        <div class="social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-youtube-play"></i></a>
        </div>

      </div>

      <div class="footer-section quick-links">
        <h2>Quick Links</h2>
        <ul>
          <a href="<?=isset($page_dir)?$page_dir:''?>terms.php">
            <li>Terms and Conditions</li>
          </a>
          <a href="<?=isset($page_dir)?$page_dir:''?>privacy.php">
            <li>Privacy Policy</li>
          </a>
        </ul>
      </div>

      <div class="footer-section contact-form-div">
        <h2>Contact Us</h2>
        <form action="index.php" method="post" style="margin: 15px 0;" id="contactForm">
          <input type="text" name="email_address" class="text-input contact-input" id="contactEmail" placeholder="Your email address">
          <textarea name="message" cols="30" rows="3" class="text-input contact-input" id="contactMessage" placeholder="Message..."></textarea>
          <button type="submit" name="send-msg-btn" class="send-msg-btn">
            <i class="fa fa-send"></i> <span id="contactSendBtn">Send</span> 
          </button>
        </form>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© PersonalBusinessBlog | Designed by <a href="http://www.radepetrovic.com">Rade Petrovic</a></p>
    </div>
  </div>
  <!-- // FOOTER -->
  <script type="text/javascript" src="<?=isset($page_dir)?$page_dir:''?>js/jquery.min.js"></script>
  <script type="text/javascript" src="<?=isset($page_dir)?$page_dir:''?>js/slick.min.js"></script>
  <script type="text/javascript" src="<?=isset($page_dir)?$page_dir:''?>js/scripts.js?5"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
