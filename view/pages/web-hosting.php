
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pricing</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <?php if(isset($_SESSION['user'])) logActionOrError("Visited Web-Hosting page"); ?>
    <div class="container">
      <div class="card-deck mb-3 text-center">

        <?php $plan = getPlans(); ?>
        <?php foreach($plan as $pl): ?>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal"><?= $pl->plan_name; ?></h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$<?= $pl->perMonth; ?> <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li><?= $pl->hosting_name;?></li>
              <?php $size = $pl->sizeMB/1000;?> 
              <li><?= $size."GB";?></li>
              <?php if($pl->SSLtrue == 1): ?>
              <li>SSL</li>
              <?php endif; ?>
              <li><?= $pl->bandwidth?>GBps</li>
              <?php if($pl->SEOTools == 1): ?>
              <li>SEOTools</li>
              <?php endif; ?>
            </ul>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="?page=buyServer&id=<?= $pl->ppId ?>" class="btn btn-lg btn-block btn-primary">Get Started</a>
            <?php else: ?>
                <a href="?page=admin" class="btn btn-lg btn-block btn-primary">Get Started</a>
            <?php endif; ?> 
          </div>
        </div>
        <?php endforeach; ?>

        
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  