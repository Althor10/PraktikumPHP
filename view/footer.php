<?php 
  $allSocial = allSocial();
?> 
<footer id="Contact">
  <div class="container">
    <p>If you have an exciting project, feel <br>free to get in touch.</p>
    <a href="mailto:danilo.zdravkovic.227.16@ict.edu.rs" class="email-btn"><span><i class="fa fa-envelope-o" aria-hidden="true"></i> Email Me</span></a>
    <ul class="social-icons">
       <?php 
       foreach($allSocial as $aS):
       ?>
      <li><a href="<?= $aS->url ?>" target="_blank"><i class="<?= $aS->icon?>" aria-hidden="true"></i></a></li>
      <?php endforeach; ?>
        </ul>
  </div>
</footer>
</div>
<div class="copyright"><p>Danilo Zdravković 227/16 IT - 2021</p> </div>
<script type="text/javascript" src="assets/scripts/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/scripts/plugin-active.js"></script>
</body>
</html>