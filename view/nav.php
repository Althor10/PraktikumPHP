<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <?php 
        $resNav = getNav();
      ?>
      <li class="sidebar-brand">
        <a class="smooth-scroll" href="#Header"></a>
      </li>
      <!-- Listanje Svakog elementa navigacije -->
      <?php foreach ($resNav as $n): ?>
        <!-- Ako nije settovan user onda ne print-a logout -->
        <?php if (!isset($_SESSION['user']) && $n->name == "Logout") continue; ?>
        <!-- Ako jeste settovan user onda ne print-a login -->
      <?php if(isset($_SESSION['user']) && $n->name == "Login") continue; ?>
       
      <!-- Nastavak print-a navigacije -->
        <li class="sidebar-nav-item">
        <!-- Ako je login ili Logout imaju drugaciji class element --> 
          <?php if($n->name == "Login" || $n->name == "Logout"): ?>

        <a class="login" href="<?= $_SERVER['PHP_SELF'].$n->path;?>"><?= $n->name ?></a>
          <!-- Ako nije setovan user i adm (u bazi) je 1 preskace te elemente -->
          <?php elseif(!isset($_SESSION['user']) && $n->adm == 1): ?>
          <?php elseif($n->sub == 1): ?>
              <!-- Inicijalni print za elemente --> 
            <a class="smooth-scroll" href="<?= $n->path;?>"><?= $n->name ?></a>
          <?php else: ?>
            <a class="normal-nav" href="<?= $_SERVER['PHP_SELF'].$n->path;?>"><?= $n->name ?></a>
          <?php endif; ?>

      </li>
      <?php endforeach; ?>

    </ul>
  </nav>
  </header>