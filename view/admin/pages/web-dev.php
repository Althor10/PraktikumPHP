<?php 
    $servers = getAllRequests();
?>
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
            <th>Status</th>
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
                $assignedDev = getAssignedDev($serv->assign_id, $serv->psid);
                foreach($assignedDev as $dev):
            ?>
                <td><?= $dev->usernm; ?></td>
            <?php endforeach; ?>
            <?php else: ?>
                <td><a href="index.php?page=admin&subpage=assignDev&id=<?=$serv->pdid?>">Assign</a></td>
            <?php endif; ?>
            <?php if($serv->status == 0):?>
                <td>Not Finished</td>
            <?php else: ?>
                <td>Finished</td>
            <?php endif; ?>
                <td><a href="./models/removeServer.php?id=<?=$serv->pdid?>">X</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
</div>
</div>