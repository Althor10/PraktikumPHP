<section id="OurWork">
  <div class="container">
    <h2>Our Work</h2>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="grey-box">
          <?php 
            $oneImageQuery = "SELECT * FROM pp_images WHERE img_alt = 'Sponser'";
            $resOIQ = executeQuery($oneImageQuery);
          ?>
          <?php foreach ($resOIQ as $roiq): ?>
          <img src="<?= $roiq->img_path ?> " alt="<?= $roiq->img_alt ?>">
          <?php endforeach; ?>
          <div class="sponser">
            <h4>SPONSERS</h4>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
      <?php 
        $queryServices = "SELECT * FROM pp_sponsors AS sp INNER JOIN pp_images AS im ON sp.img_id=im.id;";
        $resServices = executeQuery($queryServices);
        $br1 = 1
      ?>
      <?php 
        foreach ($resServices as $s): 
      ?>
        <?php if ($br1/2 == 0): ?>
        <div class="each-work ">
        <?php else: ?>
        <div class="each-work space">
        <?php endif; ?> 
          <img src="<?= $s->img_path ?>" alt="<?= $s->img_alt ?>">
        </div>

        <?php $br1++; endforeach; ?>
      </div>
    </div>
  </div>
</section> 