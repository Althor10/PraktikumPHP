<div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Welcome to Dashboard, Login</h2>
              </div>
            </div>
            <?php if(isset($_SESSION["error"])): ?>
              <div class = "errorMsg"> 
                <div id="errorMsg">
                  <?php foreach($_SESSION["error"] as $err):?>
                    <p class="errors"><?= $err ?></p>
                    <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            <div class="row mt-2">
              <div class="col-12">
                <form action="./models/login.php" method="post" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input
                      name="username"
                      type="text"
                      class="form-control validate"
                      id="username"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input
                      name="password"
                      type="password"
                      class="form-control validate"
                      id="password"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit"
                      id = "loginSubmit"
                      class="btn btn-primary btn-block text-uppercase"
                      name = "submit"
                    >
                      Login
                    </button>
                  </div>
                  <a class="mt-5 btn btn-primary btn-block text-uppercase" href="index.php?page=admin&subpage=registration">
                    Register?
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php unset($_SESSION["error"]) ?>