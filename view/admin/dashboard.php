            <?php if($_SESSION['user']->role_id == 1):?> 
            <div class="row tm-content-row">

                <?php 
                    $getVisits = getLogData();
                    foreach($getVisits as $visit):
                        $exVisit = explode("\t",$visit);
                        $today = time();
                        $strToTime = strtotime($exVisit[2]);
                        $dif = $today - $strToTime;
                        // var_dump($dif);
                        //Pages
                        $exPage = explode("Visited ",$exVisit[3]);
                        if($exPage[0] != ' ')
                                        {
                                            $page = $exPage[0];
                                        }elseif($exPage[1] != ' ')
                                        {
                                            $page = $exPage[1];
                                        }

                        //In the past 24h
                        if($dif > 86400):
                            $exDate = explode(" ",trim($exVisit[2]));
                            $date = $exDate[0];
                            $time = $exDate[1];
                        
                        
                        
                ?>     
                 <input type="hidden" class="<?=$page?>" value="<?=$page?>" data-date="<?=$exVisit[2]?>"/>
                 <?php else: ?>
                    <input type="hidden" class="<?=$page?>" value="<?=$page?>" data-date="allTime"/>
                 <?php endif;?>
                <?php endforeach ?>


                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col hidden">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Popular Pages by Month</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>



                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Popular Pages Last 24h</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col hidden">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Visits by Persentage</h2>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>                        
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Error Notification</h2>
                        <div class="tm-notification-items">

                        <?php 
                           $errorLog = getErrorLogs();
                            foreach($errorLog as $err):
                                $e = explode("\t",$err);
                            $usersImg = getUserAndImg($e[0]); 
                            $dateTime = explode(" ",trim($e[2]));
                            $date = $dateTime[0];
                            $time = $dateTime[1];
                        ?>
                        <?php foreach($usersImg as $usr):?>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="<?= $usr->img_path?>" alt="<?= $usr->img_alt?>" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b><?= $usr->firstName?></b> tried to <?= $e[3]; ?> </br>
                                    <span class="tm-small tm-text-color-secondary">At <?= $time ?> on <?= $date ?>.</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php 
                    $br = 0;
                    $logData = getLogData();
                ?>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Visits Log</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Page</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($logData as $data): ?>
                                    <?php $d = explode("\t",$data); ?>
                                <tr>
                                    <th scope="row"><b><?= $br++; ?></b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div>Visited
                                    </td>
                                    <td><b><?=$d[0]?></b></td>
                                    <td><b><?=$d[1]?></b></td>
                                    <td><b><?=$d[2]?></b></td>
                                    <?php @$d3Break = explode("Visited ",$d[3]); 
                                        if($d3Break[0] != ' ')
                                        {
                                            $page = $d3Break[0];
                                        }elseif($d3Break[1] != ' ')
                                        {
                                            $page = $d3Break[1];
                                        }
                                        ?>
                                        
                                    <td><?=$page?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            <?php 
        if($_SESSION['user']->dev == 1):
            $id = $_SESSION['user']->uid; 
            $servers = getDevTasks($id);
            ?>
    <div class="row tm-content-row">
        <div class="col-12 tm-block-col background-gray">
            <h2>Tasks:</h2>
    <table id="table_id" class="display background-white">
    <thead>
        <tr>
            <th>Domain</th>
            <th>IP Address</th>
            <th>Owner (Username)</th>
            <th>Full Name</th>
            <th>Hosting</th>
            <th>Task</th>
            <th>Status</th>
            <th>Respond</th>
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
            <?php if($serv->status == 1): ?>
            <td>Finished</td>
            <td>X</td>
            <?php else: ?>
            <td>Pending</td>
            <td><a href="index.php?page=admin&subpage=respond"> Finish Task </a></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?> 
    </tbody>
    </table>
    </div>
    </div>
</div>
    <?php endif; ?>
</div>
        </div>
        <?php endif; ?>