<?php $authorImg = getImg("author"); if(isset($_SESSION['user'])) logActionOrError("Visited About Page");?>
<section class="ftco-about img ftco-section ftco-no-pt ftco-no-pb" id="author-section">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-6 col-lg-6 d-flex">
    				<div class="img-about img d-flex align-items-stretch">
    					<div class="overlay"></div>
                        <?php foreach($authorImg as $img):?> 
	    				<img class="img d-flex align-self-stretch align-items-center" src="<?= $img->img_path?>" alt="<?= $img->img_alt?>">
                        <?php endforeach; ?>
	    				</img>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-6 d-flex">
    				<div class="py-md-5 w-100 bg-light px-md-5">
    					<div class="py-md-5">
		    				<div class="row justify-content-start pb-3">
				          <div class="col-md-12 heading-section ftco-animate">
				          	<span class="subheading">Know More About The Author</span>
				            <h2 class="mb-4" name="heading">Danilo Zdravkovic</h2>
				            <p name="about">I'm a student at a ICT College Of Vocational Studies in Belgrade. This is a project for our PHP class! No images are for my own benefits! They are purely just for practicing of making a PHP website.</p>
				            <ul class="about-info mt-4 px-md-0 px-2">
				            	<li class="d-flex"><span>Name:</span> <span>Danilo Zdravkovic</span></li>
				            	<li class="d-flex"><span>Date of birth:</span> <span>July 8th, 1997</span></li>
				            	<li class="d-flex"><span>Email:</span> <span>danilo.zdravkovic.227.16@ict.edu.rs</span></li>
				            	<li class="d-flex"><span>Study Programme: </span> <span>Internet Technologies </span></li>
				            </ul>
				          </div>
				        </div>
			          <div class="counter-wrap ftco-animate d-flex mt-md-3">
		              <div class="text">
		              	<p class="mb-4 btn-custom">
			                <a href="models/export/printAuthorData.php" target="_blank" class="btn btn-lg btn-block btn-danger">Export Data</a>
		                </p>
		              </div>
					  </div>
						</br>
					  <div class="text">
		              	<p class="mb-4 btn-custom">
			                <a href="DocumentationDS.docx" target="_blank" class="btn btn-lg btn-block btn-primary">Documentation</a>
		                </p>
		              
			          </div>
			        </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>