<section id="Testimonials">
  <?php 
    $queryTestimonails = "Select * From pp_testimonials";
    $resTestimonials = executeQuery($queryTestimonails);
    $br = 1;
  ?>
   <div class="container">
    <h2>Testimonials</h2>
    <p>I just wanted to take a moment to appreciate the great work you guys are doing for our web projects. Thanks for your abundant patience and technical support whenever required, even during the odd hours.</p>
    <div class="testi-wrapper">
        <div class="latest-testimonials each-testi">
          <div class="division">
            <span>03.</span> 
            <div class="title">
              <h4>Testimonials</h4>
              <h6>Read our clients thoughts..</h6>
            </div>
          </div>
          <p>You can submit a testimonial below! Thank you for your honest opinion.</p>
        </div>

      <!-- Testimonials Petlja !--> 
      <?php foreach($resTestimonials as $t): ?>
        <div class="old-testimonials each-testi no-margin">
          <p><?= $t->testimonial?></p>
          <div class="profile">
            <?php if ($br == 1): ?>
            <img src="assets/images/user-profile-one.png" alt="">
            <?php else : ?>
              <img src="assets/images/user-profile-two.png" alt="">
              <?php endif; ?>
            <div class="designation">
              <h6><?= $t->name?></h6>
              <p><?= $t->ocupation?></p>
            </div>
          </div>
        </div>
        <?php $br++; ?>
      <?php endforeach; ?>
      

      </div>
   </div>
</section>