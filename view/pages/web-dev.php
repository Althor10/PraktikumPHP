<?php 
 if(isset($_SESSION['user']))
 {
    $id = $_SESSION['user']->uid; 
    $websites = getUsersWebsites($id);
 }
    
?>
<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card px-1 py-4">
        <?php if(isset($_SESSION['user'])): ?>
        <div class="card-body">
            <h6 class="card-title mb-3">This appointment is for?</h6>
            <h6 class="information mt-4">Please provide following information about your needs</h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <!-- <label for="name">Name</label> --> <input class="form-control" type="text" placeholder="Name" value="<?= $_SESSION['user']->firstName." ".$_SESSION['user']->lastName ?>"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group"> <input class="form-control" type="text" placeholder="In short, what do you need?"> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group"> <input class="form-control" type="text" placeholder="Email" value="<?= $_SESSION['user']->email ?>"> </div>
                    </div>
                </div>
                <input type="hidden" name="username" id="username" value="<?= $_SESSION['user']->usernm ?>"/>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group"> 
                            <select name="website" class="form-control" >
                                <option value="0">Select a website...</option>
                                <?php foreach($websites as $website):?>
                                <option value="<?= $website->psid ?>"><?= $website->serverUrl?></option>
                                <?php endforeach;?>
                            </select> 
                        </div>
                    </div>
                </div>
            </div>
            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> <small class="agree-text">By Booking this appointment you agree to the</small> <a href="#" class="terms">Terms & Conditions</a> </div> <button class="btn btn-danger btn-block confirm-button">Confirm</button>
        </div>
        <?php else: ?>
    <div class="card-body">
            <h6 class="card-title mb-3">This appointment is for?</h6>
            <h6 class="information mt-4">Please note that in order to fufill this form you need to be logged in!</h6>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p class="information">Our developers can look into your problem and inform you if we are able to fix your issue or if you should seek third party help. 
                                                  However, please note that you need to be logged in in order to fufill the form.
                            </p>
                        </div>
                    </div>
                </div>
    </div>
            <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> <small class="agree-text">By Booking this appointment you agree to the</small> <a href="legal/termsAndConditions.html" class="terms">Terms & Conditions</a> </div> <a href="index.php?page=admin" class="btn btn-danger btn-block confirm-button">LogIn</a>
        </div>
        <?php endif;?>
    </div>
</div>