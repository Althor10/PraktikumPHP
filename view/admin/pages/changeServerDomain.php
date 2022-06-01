<?php authorize(); ?>
<div class="container mt-5 mb-5 d-flex justify-content-center ">
    <form action="./models/updateServerName.php" method="post">
    <div class="card px-1 py-4">
        <div class="card-body ">
            <h6 class="card-title mb-3">Changing the Domain Name</h6>
            <div class="d-flex flex-row"></div>
            <h6 class="information mt-4">Please provide following information</h6>

        <?php $id = $_GET['id']; $getServer = getServer($id);?>
        <?php foreach($getServer as $serv): ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <!-- <label for="name">Name</label> --> <input class="form-control bg-red" type="text" name="oldName" placeholder="Previous Domain Name" style="color:black;" readonly value="<?=$serv->serverUrl?>"> </div>
                </div>
            </div>
            <input type="hidden" name="servId" value="<?=$id?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group"> <input class="form-control" type="text" name="newName" placeholder="New Name"> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group"> <input class="form-control" type="password" name="password" placeholder="Password"> </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> <small class="agree-text">By Booking this appointment you agree to the</small> <a href="#" class="terms">Terms & Conditions</a> </div> <input type="submit" name="btnSubmit" class="btn btn-primary btn-block confirm-button" value="Confirm" >
        </div>
    </div>
    <?php
        if(isset($_SESSION['error'])):
            
     ?>

     <div class="bg-danger">
        <?php foreach($_SESSION['error'] as $error): ?>
            <p><?= $error?></p>
        <?php endforeach;?>
     </div>
     <?php endif; ?>
     <?php
        if(isset($_SESSION['success'])):
            
     ?>

     <div class="bg-success">
        <?php foreach($_SESSION['success'] as $success): ?>
            <p><?= $success?></p>
        <?php endforeach;?>
     </div>
     <?php endif; ?>
</div>
</form>
</div>
<?php unset($_SESSION['error']); unset($_SESSION['success']); ?>