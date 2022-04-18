<body>
    <div>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="./index.php?page=home">
            <h1 class="tm-site-title mb-0"><img src="images/ds-logo.png" alt="siteLogo"/></h1>
          </a>
          <button
            class="navbar-toggler ml-auto mr-0"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars tm-nav-icon"></i>
          </button>
        <?php 
          $query= "SELECT * FROM pp_nav WHERE adm = 1";
          $navs = executeQuery($query);
        ?>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">

              <!-- Pocetak Foreach-a --> 
              <?php foreach($navs as $nav): ?>
                <?php if(!isset($_SESSION['user'])): ?>
                  <!-- Ako user nije setovan !--> 
                  <?php if($nav->name != "Settings"): ?>
              <li class="nav-item">
                <!-- Ukoliko user nije setovan samo refreshuje admin stranicu sa obavestenjem --> 
                <a class="nav-link" href="#">
                    <?php if($nav->name == "Dashboard"): ?>
                  <i class="fas fa-tachometer-alt"></i> <?=$nav->name ?>
                   <?php elseif($nav->name == "Products"): ?>
                    <i class="fas fa-shopping-cart"></i><?=$nav->name ?>
                   <?php elseif($nav->name == "Account"): ?>
                    <i class="far fa-user"></i> <?=$nav->name ?>
                    <?php else: ?>
                    <i class="fas fa-cog"></i> <span>  <?=$nav->name ?>
                </a>
                    <?php endif; ?>
                 <?php endif; ?>
                <!-- Kraj namestanje izgleda (Bez user-a) -->

              <?php endif; ?>
                <!-- Kraj logike -->
                </a>
              </li>
              
              <?php endforeach; ?>
              <!-- KRAJ foreach-a -->
            </ul>
          </div>
        </div>
      </nav>
    </div>