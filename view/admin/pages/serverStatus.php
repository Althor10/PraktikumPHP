<?php 
    $userId = $_SESSION['user']->uid;
    $getSInfo = getSInfo($userId);
    ?>
    <?php if(count($getSInfo) > 0): ?>
    <?php foreach($getSInfo as $info): ?>

                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col hidden">
                    <div class="tm-bg-primary-dark tm-block ">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col hidden">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Performance</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="col-12 tm-block-col">
                    <a name="deleteServer" id="deleteServer" href="./models/removeServer.php?id=<?=$info->psid?>" class="btn btn-sm btn-block btn-primary">Delete</a>
                    <div class="clearfix"></div>
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title text-center float-left">Storage Information : <a href ="index.php?page=admin&subpage=changeServerDomain&id=<?=$info->psid ?>" title="Change Domain name?"><?= $info->serverUrl."</a> (".$info->ipAddress.")"; ?></h2>
                        <form action="./models/export/printServer.php" method="post" target="_blank">
                            <input type="hidden" name="serverUrl" value="<?=$info->serverUrl?>">
                            <input type="hidden" name="ipAddress" value="<?=$info->ipAddress?>">
                            <input type="hidden" name="freeSpace" id="freeSpace" value="<?= $info->sizeMB - $info->occupiedSizeOnServer; ?>">
                            <input type="hidden" name="storageSpace" id="storageSpace" value="<?= $info->occupiedSizeOnServer; ?>">
                            <input type="hidden" name="fullSpace" id="fullSpace" value="<?= $info->sizeMB; ?>">
                        <input type="submit" name="printReport" id="printReport" class="btn btn-sm btn-block btn-primary" value="Create XML">
                        <?php
                        $expl = explode("http://",$info->serverUrl); 
                        $domain = $expl[1];
                        $file = file_exists("./data/".$domain."server.xml");
                        if($file):
                        ?>
                        <a href="./data/<?=$domain?>server.xml"  > Download XML</a>
                        <?php endif; ?>
                        </form>
                        <div class="clearfix"></div>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>                        
                    </div>
                </div>
                
    <?php endforeach; ?>
    <?php else: ?>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">You have no Servers. Would you like to buy one?</h2>
                        <p>You can go to the following <a href="index.php?page=web-hosting">link</a> for to order a server.</p>
                    </div>
                </div>
    <?php endif; ?>
    </div>
</div>