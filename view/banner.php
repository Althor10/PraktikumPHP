<?php 
  $query = "SELECT * FROM pp_images WHERE img_alt = 'site-logo1'";
  $execQuery = executeQuery($query);
?>
<section id="Banner">
  <div class="logo">
    <?php foreach($execQuery as $img): ?>
    <img src="<?=$img->img_path?>">
    <?php endforeach; ?>
  </div>
  <div class="blacksection">
    <h1>technology<br>meets<br>creativity</h1>
  </div>
</section>