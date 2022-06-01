<?php authorizeAdm(); ?>
<div class="container mt-5 mb-5 d-flex justify-content-center ">
    <form action="./models/updateUsersStatus.php" method="post">
    <div class="card px-1 py-4">
        <div class="card-body ">
            <h6 class="card-title mb-3">Changing the Users Status</h6>
            <div class="d-flex flex-row"></div>
            <h6 class="information mt-4">Please provide following information</h6>

        <?php $id = $_GET['id']; $getUser = getUser($id);?>
        <?php foreach($getUser as $user): ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input class="form-control bg-red" type="text" name="username" placeholder="User" style="color:black;" readonly value="<?=$user->usernm ?>"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                         <input class="form-control bg-red" type="text" name="fullName" placeholder="User" style="color:black;" readonly value="<?=$user->firstName." ".$user->lastName ?>"> </div>
                </div>
            </div>
            <input type="hidden" name="userId" value="<?=$user->id;?>">
            <input type="hidden" name="oldStatus" value="<?=$user->dev;?>">
            <div class="row">
                <div class="col-sm-12">
                            <select class="form-select form-select-lg mb-3" name="status">
                                <?php if($user->dev == 1): ?>
                                    <option value="1">Developer</option>
                                    <option value="0">User</option>
                                <?php else: ?>
                                    <option value="0">User</option>
                                    <option value="1">Developer</option>
                                <?php endif;?>
                            </select>
                </div>
            </div>
            <?php endforeach; ?>
            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> <input type="submit" name="btnSubmit" class="btn btn-primary btn-block confirm-button" value="Confirm" >
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
        </div>
<?php unset($_SESSION['error']); unset($_SESSION['success']); ?>