<?php if(isset($_SESSION['user']) && ($_SESSION['user']->role_id == 2)): ?>
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
                      <button class="btn btn-primary" id="changeImg">Change Img</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $u->firstName." ".$u->lastName ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $u->email ?>
                    </div>
                  </div>
                  <hr>
                  <?php if($u->dev == 1): ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Tasks Done:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?= $countTasks;?>
                    </div>
                  </div>
                  <?php endif; ?>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        <?php endforeach ?>
        </div>
        </div>
        </div> 

<?php else: ?>
    <?php 
    $br = 0;
    $users = getUsers();
?>
    <div class="row tm-content-row">
        <div class="col-12 tm-block-col background-gray">
    <table id="table_id" class="display background-white">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Task Count</th>
            <th>Status</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $br++; ?></td>
            <td><?= $user->usernm ?></td>
            <td><?= $user->firstName." ".$user->lastName ?></td>
            <?php $taskCount = devsWithTask($user->id);?>
            <td><?= count($taskCount) ?></td>
            <?php if ($user->dev): ?>
                <td>Developer</td>
            <?php else: ?>
                <td>User</td>
            <?php endif;?>
            <td><a href="./models/removeUser.php?id=<?=$user->id?>">X</a> <i class="fa fa-question-circle d-inline" title="Removing this will remove the users Servers"></i></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
</div>
</div>
<?php endif;?>