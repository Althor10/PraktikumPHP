<?php 
  $logoIMGQuery = "SELECT * FROM pp_images WHERE img_alt = 'mobile_logo'";
  $resLIQ = executeQuery($logoIMGQuery);
?>
<header>
    <div class="mobile-logo">
      <?php foreach ($resLIQ as $liq): ?>
    <a href=""><img src="<?= $liq->img_path ?>" alt="<?= $liq->img_alt?>"></a>
        <?php endforeach; ?>
  </div>
  <a class="menu-toggle rounded" href="#">
    <i class="fa fa-bars"></i>
  </a>
