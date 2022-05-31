<div class="hidden"> <?php if(isset($_SESSION['user'])) logActionOrError("Visited Buy Server page.");?>
    <?php if(isset($_SESSION['error'])): ?>
        <script>
            alert("No Ids sent!");
        </script>
        <?php unset($_SESSION['error']);?>
    <?php endif; ?>
    <?php 
        $getData;
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $getData = getPlan($id);
        }
    ?>
    <input type="hidden" data-id="<?=$id?>"> 
</div> 
<div class="container mb-5 mt-5">
            <div class="pricing card-deck flex-column flex-md-row mb-3">

                <?php foreach($getData as $data):?> 
                <div class="card card-pricing popular shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm"><?= $data->plan_name; ?></span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <?php if($data->sale > 0): ?>
                            <?php 
                                $sale = $data->sale/100;
                                $initialPrice = $data->perMonth;
                                $newPrice = $initialPrice - $sale;
                             ?>
                            <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">$<span class="price"><?= $newPrice; ?></span><span class="h6 text-muted ml-2">/ per month</span></h1>
                        <?php else: ?>
                            <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">$<span class="price"><?= $data->perMonth; ?></span><span class="h6 text-muted ml-2">/ per month</span></h1>
                        <?php endif;?>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li><?= $data->hosting_name; ?></li>
                            <li>Bandwidth: <?= $data->bandwidth;?></li>
                            <?php if($data->SSLtrue == 1):?>
                            <li>SSL provided</li>
                            <?php endif; ?>
                            <?php if($data->SEOTools == 1):?>
                            <li>SEO Tools provided</li>
                            <?php endif; ?>
                            <li>Free cancelation</li>
                        </ul>
                        <a href="?page=order&id=<?=$data->ppId;?>" target="_blank" class="btn btn-primary mb-3">Order Now</a>
                    </div>
                </div>

                

                <div class="card card-pricing text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">About: </span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45"><?= $data->hosting_name; ?></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li><?= $data->description; ?></li>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>