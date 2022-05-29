<?php 
    $servers = getAllServers();
?>
<div class="container">
    <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>User</b></p>
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
            <td><a href="./models/removeServer.php?id=<?=$serv->psid?>">X</a></td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
</div>
</div>