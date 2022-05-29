<?php 
    $servers = getAllRequests();
?>
<div class="container">
    <div class="row">
                <div class="col">
                    <?php if($_SESSION['user']->role_id == 1): ?>
                        <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                    <?php else: ?>
                        <p class="text-white mt-5 mb-5">Welcome back, <b>User</b></p>
                    <?php endif;?> 
                </div>
    </div>
    <div class="row tm-content-row">
        <div class="col-12 tm-block-col background-gray">
    <table id="table_id" class="display background-white">
    <thead>
        <tr>
            <th>Domain</th>
            <th>IP Address</th>
            <th>Owner (Username)</th>
            <th>Full Name</th>
            <th>Hosting</th>
            <th>Task</th>
            <th>Assigned To</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servers as $serv): ?>
        <tr>
            <td><?=$serv->serverUrl ?> </td>
            <td><?=$serv->ipAddress ?> </td>
            <td><?=$serv->usernm ?> </td>
            <td><?=$serv->firstName." ".$serv->lastName ?></td>
            <td><?=$serv->hosting_name ?> </td>
            <td><?=$serv->request ?></td>
            <?php 
            if($serv->assign_id):
                $assignedDev = getAssignedDev($serv->assign_id);
                foreach($assignedDev as $dev):
            ?>
            <td><?= $dev->usernm; ?></td>
            <?php endforeach; ?>
            <?php else: ?>
            <td><a href="./models/assignDev.php?id=<?=$serv->psid?>">Assign</a></td>
            <?php endif; ?>
            <td><a href="./models/removeServer.php?id=<?=$serv->psid?>">X</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
</div>
</div>