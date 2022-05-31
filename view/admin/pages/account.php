<?php if(isset($_SESSION['user']) && ($_SESSION['user']->role_id == 2)): ?>
    <div class="row tm-content-row">
    <div class="row tm-content-row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Performance</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Storage Information</h2>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>                        
                    </div>
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