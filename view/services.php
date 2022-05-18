<?php 
  $resServices = getServiceImages();
  ?>
<a href="#Services" class="mscroll"><img src="assets/images/mouse-icon.png" alt="mouse icon"></a>
<section id="Services">
  <div class="container">
    <h2>Our digital services</h2>
    <div class="row">
    <?php foreach($resServices as $rs): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="each-services">
          <img src="<?= $rs->img_path ?>" alt="<?= $rs->img_alt ?>">
          <a href="?page=<?= $rs->path?>"><h3><?= $rs->service_name ?></h3></a>
          <p><?= $rs->service_desc ?></p>
          </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>