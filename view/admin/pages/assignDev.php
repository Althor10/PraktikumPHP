<?php 
    $jobId = $_GET['id'];
    $devs = getDevelopers();
    $br = 0;
?>
    <div class="row tm-content-row">
        <div class="col-12 tm-block-col background-gray">
    <table id="table_id" class="display background-white">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Tasks</th>
            <th>Assign</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($devs as $dev): ?>
        <tr>
            <?php $br++; ?>
            <td><?=$br ?></td>
            <td><?=$dev->usernm ?></td>
            <td><?=$dev->firstName." ".$dev->lastName ?></td>
            <?php $countTask = devsWithTask($dev->id);?>
            <td><?=count($countTask); ?></td>
            <td><a href="models/assignDev.php?taskId=<?= $jobId?>&devId=<?= $dev->id?>">Assign</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="row tm-content-row bg-danger">
            <?php foreach($_SESSION['error'] as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['error']); ?>
</div>
</div>