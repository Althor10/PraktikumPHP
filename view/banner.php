<?php 
  $images = getImages();
?>
<section id="Banner">
  <div class="logo">
    <?php foreach($images as $img): ?>
    <img src="<?=$img->img_path?>">
    <?php endforeach; ?>
  </div>
  <div class="blacksection">
    <h1>technology<br>meets<br>creativity</h1>
  </div>
</section>