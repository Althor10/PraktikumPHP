<div class="container">
        <div class="main-body">
          <div class="row gutters-sm">

          <?php 
                $id = $_SESSION['user']->uid;
                $user = getUserData($id);
                foreach($user as $u):
                    if($u->dev == 1)
                    {
                        $tasks = getDevTasks($id);
                        $countTasks = count($tasks);
                    }
            ?>
    
            <div class="col-md-4 mb-3">
            <form action="models/updateUserData.php" method="post" enctype="multipart/form-data">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= $u->img_path ?>" alt="<?= $u->alt?>" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?= $u->firstName." ".$u->lastName ?></h4>
                      <?php if ($u->dev == 1): ?>
                      <p class="text-secondary mb-1">Developer</p>
                      <?php else: ?>
                        <p class="text-secondary mb-1">User</p>
                      <?php endif; ?>
                      <p class="text-muted font-size-sm"><?= $u->usernm ?></p>
                      <i class="text-muted font-size-sm">Please note that for best experience use 80x80 avatars</i>
                      <input type="file" class="btn btn-primary" id="changeImg" name="changeImg" value="Change Img">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="userId" id="userId" value="<?=$u->uid?>">
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="firstName" id="firstName" value="<?=$u->firstName?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="lastName" id="lastName" value="<?=$u->lastName?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name="email" id="email" value="<?=$u->email?>">
                    </div>
                  </div>
                  <hr>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="submit" name="btnSubmit" class="btn btn-info" value="Edit"  />
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <?php endforeach ?>
        </form>
       
        </div>
        </div>
        </div> 