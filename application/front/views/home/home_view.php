<?php
$headerData = $this->headerlib->data();
$categries = array_chunk($record_set, 4);
$cat_options = $this->home_model->getCatDropDown();
?>
<!doctype html>
<html lang="en-us">
<head>
	<title> Executive :: Home Page</title>
	<?= $headerData['meta_tags']; ?>
	<?= $headerData['stylesheets']; ?>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>
<body class="backgroudfff">
	

	<?php $this->load->view('include/header_view') ?>
        <?=$this->general_model->getMessages()?>
	<section id="page">
		<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul>
						<li><a  href="index.html">Home</a></li>
						<li><a  href="about.html">About Us</a></li>
						<li><a  href="blog.html">Blog</a></li>
						<li><a  href="terms.html">Terms</a></li>
						<li><a  href="privacy.html">Privacy</a></li>
						<li><a  href="contact.html">Contact</a></li>
					</ul>
				</nav>			
			</div>
		</div>
		<div class="home_banner"> 
			<!-- header -->
			<div class="container">
				<div class="row maring0 padding0">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddingtop10px mobile-paddingtop15px">
						<a href="<?= DOMAIN_URL ?>"> <img src="<?= DOMAIN_URL ?>bootstrap/img/home_logo.png" alt="Excecutive" class="img-responsive header_logo"></a>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right paddingtop20px mobile-paddingtop10px">
						<a href="javascript:void(0)" class="btn btn-primary btn-blue-theme btn-download-app hidden-xs"> Download App</a>

						<div class="btn btn-group hidden-xs" data-toggle="modal" data-target="#registerModal">
							<img src="<?= DOMAIN_URL ?>bootstrap/img/signup_user.png" alt="Sign Up">
							<span> Sign Up</span>
						</div>
						<div class="btn btn-group hidden-xs" data-toggle="modal" data-target="#loginModal">
							<img src="<?= DOMAIN_URL ?>bootstrap/img/signin_user.png" alt="Sign In">
							<span>Sign In</span>
						</div>
						<div class="btn btn-group nav_slide_button" >
							<span>Menu</span>
							<img src="<?= DOMAIN_URL ?>bootstrap/img/header_menu.png" alt="Menu Icon">
						</div>
					</div>
				</div>
			</div>
			<!-- header -->


			<!-- banner div -->
			<div class="container">
				<div class="row margin0 padding0">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0">
					</div>
					<div class="col-lg-4 col-md-3 col-sm-10 col-xs-12 padding0 paddingtop10 paddingleftright30px">
						<div class="banner_title text-center marginbottom10px">
							<h1 class="margin0 padding0">Search for Business</h1>
						</div>
						<div class="banner_desc paddingleftright20px text-justify">
							<p>Notepad is abasic text-editing program and it’s most commenly used to view or edit text files. A text file is a file type typically identified by the .txt file name extension.</p>
						</div>
					</div>
				</div>
				<div class="row maring0 padding0 banner_search">
					
					<div class="col-lg-8 col-md-10 col-sm-10 col-xs-12 container">
						<div class="row margin0 padding0">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftright10px">
                                                            
                                                            <?php $extra= ' class="form-control theme-input" placeholder="Select Category" id="cat-list"'; ?>
                                                            <?php echo form_dropdown('iCategoryID', $cat_options, '',$extra); ?>
								                          
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftright10px">
								<select class="form-control theme-input" placeholder="Sub Select" id="subcat-list">
									<option>Subcategory Select</option>
									
								</select>                                
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftright10px">
								<input type="text" id="autocomplete" onFocus="geolocate()" class="form-control theme-input theme-input-text" placeholder="Enter Location">
							</div>
						</div>

					</div>
					<div class="col-lg-2 col-md-1 col-sm-0 col-xs-0">
					</div>
				</div>
			</div>
			<!-- banner div -->          
		</div>


		<!-- category div -->
		<div class="row margin0 padding0">
			<div class="container background27c6db paddingtopbottom20px home_category_list">
				<div class="row margin0 padding0">
                                    <?php foreach($categries as $category) : ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0">
                                            
						<div class="row margin0 padding0">
                                                      <?php foreach($category as $cat) : ?>      
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 btn btn-group category_separator cat-image">
                                                            <img data-id="<?php echo $cat['iCategoryID']; ?>" data-hover ="<?php echo $cat['vImage2'] ; ?>" data-src ="<?php echo $cat['vImage'] ; ?>" src="<?= CAT_IMAGE_URL. $cat['iCategoryID'].'/'.$cat['vImage']?>" alt="<?php echo $cat['vTitle']; ?>">
								<span><?php echo $cat['vTitle']?></span>
							</div>
                                                    <?php endforeach;?>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
		<!-- category div -->

		<!-- 3 col div -->
		<div class="row margin0 padding0">
			<div class="container intro_container">
				<div class="row margin0 padding0 bottomlinediv">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
						<div class="row margin0 padding0">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 intro_container_div intro_separator">
								<div class="text-center"><img src="<?= DOMAIN_URL ?>bootstrap/img/who_logo.png" alt="Who We Are"></div>
								<div class="intro_title">WHO WE ARE?</div>
								<div class="intro_desc"><p>Notepad is abasic text-editing program and it’s most commenly used to view or edit text files. A text file is a file type typically identified by the .txt file name extension.</p></div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 intro_container_div intro_separator">
								<div class="text-center"><img src="<?= DOMAIN_URL ?>bootstrap/img/whyus_logo.png" alt="Why Us?"></div>
								<div class="intro_title">WHY US?</div>
								<div class="intro_desc"><p>Notepad is abasic text-editing program and it’s most commenly used to view or edit text files. A text file is a file type typically identified by the .txt file name extension.</p></div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 intro_container_div">
								<div class="text-center"><img src="<?= DOMAIN_URL ?>bootstrap/img/findus_logo.png" alt="Find Skill"></div>
								<div class="intro_title">Find Skills</div>
								<div class="intro_desc"><p>Notepad is abasic text-editing program and it’s most commenly used to view or edit text files. A text file is a file type typically identified by the .txt file name extension.</p></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 3 col div -->  

		<!-- separator -->
		<div class="row margin0 padding0"><div class="container intro_container"><div class="borderbottom1px27c6db"></div> </div></div>
		<!-- separator -->   

		<!-- Recently Added --> 
		<div class="row margin0 padding0">
			<div class="container paddingtopbottom20px">
				<div class="row margin0 padding0">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 section_title text-center">
						<span>RECENTLY LISTED</span>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 paddingtop20px">
						<div class="row margin0 padding0">

							<?php for ($index = 0; $index < 5; $index++) {?>

							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 listing_div">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 heightfix">
									<img src="<?= DOMAIN_URL ?>bootstrap/img/temp_img.jpg" alt="Category" class="img-responsive">
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
									<div class="row margin0 padding0 background27c6db maxwidth100per">
										<div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 padding0 listing_btn_div listing_category_name">
											<div class="btn btn-group ">
												<img src="<?= DOMAIN_URL ?>bootstrap/img/category_icon.png" alt="Category">
												<span> Category </span>
											</div>
										</div>
										<div class="btn col-lg-6 col-md-7 col-sm-6 col-xs-12 listing_btn_div padding0">
											<div class="btn btn-group">
												<span> Jonn Deo </span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Recently Added --> 


		<!-- separator -->
		<div class="row margin0 padding0"><div class="container intro_container"><div class="borderbottom1px27c6db"></div> </div></div>
		<!-- separator --> 

		<!-- Popular in Public --> 
		<div class="row margin0 padding0">
			<div class="container paddingtopbottom20px">
				<div class="row margin0 padding0">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 section_title text-center">
						<span>POPULAR IN PUBLIC</span>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 paddingtop20px">
						<div class="row margin0 padding0">
							<?php for ($index = 0; $index < 5; $index++) {?>

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 listing_div">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 heightfix">
									<img src="<?= DOMAIN_URL ?>bootstrap/img/temp_img.jpg" alt="Category" class="img-responsive">
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 ">
									<div class="row margin0 padding0 background27c6db maxwidth100per">
										<div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 padding0 listing_btn_div listing_category_name">
											<div class="btn btn-group ">
												<img src="<?= DOMAIN_URL ?>bootstrap/img/category_icon.png" alt="Category" >
												<span> Category </span>
											</div>
										</div>
										<div class="btn col-lg-6 col-md-7 col-sm-6 col-xs-12 listing_btn_div padding0">
											<div class="btn btn-group">
												<span> Jonn Deo </span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }?>    

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Popular in Public -->  

		<!-- We are launching soon --> 
		<div class="row margin0 padding0">
			<div class="container paddingtopbottom20px">
				<div class="row margin0 padding0">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 section_title text-center">
						<span>WE ARE LAUNCHING SOON...</span>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 paddingtop20px">
						<div class="row margin0 padding0">
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 padding0 launching_text_div text-center">

								<div><h1 class="launching_text">WE ARE LAUNCHING MOBILE APP SOON !!</h1></div>
								<div> 
									<img src="<?= DOMAIN_URL ?>bootstrap/img/itune_store.jpg" alt="Itune Store" class="download_store_img marginright10px ">
									<img src="<?= DOMAIN_URL ?>bootstrap/img/play_store.jpg" alt="Play Store" class="download_store_img marginright10px ">

								</div>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 padding0">
								<img src="<?= DOMAIN_URL ?>bootstrap/img/mobile.jpg" alt="Mobile" class="img-responsive">
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- We are launching soon -->   


		<!-- numbers -->
		<div class="row margin0 padding0 ">
			<div class="container background27c6db paddingtopbottom20px text-center margintop10px">
				<div class="row margin0 padding0">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding0">
						<div class="row margin0 padding0">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_title">
								TOTAL VERIFIED LISTINGS
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_number">
								<span class="counter">8,47,625</span>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding0">
						<div class="row margin0 padding0">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_title">
								NEW LISTINGS ADDED
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_number">
								<span class="counter">7,286</span>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding0">
						<div class="row margin0 padding0">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_title">
								SKILL FINDERS
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 home_number_number">
								<span class="counter">6,38,538</span>
							</div>
						</div>
					</div>              
				</div>
			</div>
		</div>
		<!-- numbers -->

	</section>
	<?= $headerData['javascript']; ?>

	<?php $this->load->view('include/footer_view') ?>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 
	<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete"
	async defer></script>

	<script>
		jQuery(document).ready(function( $ ) {
			$('.counter').counterUp({
				delay: 10,
				time: 1000
			});
		});

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;


function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
  	/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
  	{types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
}

// [START region_fillform]

// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			var circle = new google.maps.Circle({
				center: geolocation,
				radius: position.coords.accuracy
			});
			autocomplete.setBounds(circle.getBounds());
		});
	}
}

$(window).load(function() {
	$('.nav_slide_button').click(function() {
		$('.pull').slideToggle();
	});
});

var cat_img_url = '<?php echo CAT_IMAGE_URL ; ?>';

$('.cat-image' ).mouseenter(function(){
    var $img = $(this).find('img');
    var id = $img.attr('data-id');
    var hover_src = $img.attr('data-hover');
    $img.attr('src',cat_img_url+id+'/'+hover_src);
}).mouseleave(function(){
    var $img = $(this).find('img');
    var id = $img.attr('data-id');
    var src = $img.attr('data-src');
    $img.attr('src',cat_img_url+id+'/'+src);
});
// [END region_geolocation]
$('#cat-list').on('change', function(){
    var cat = $(this).val();
    jQuery.post('home/getsubcat', {c: cat}, function(data, textStatus, xhr) {
        if(data!=''){
            $('#subcat-list').html(data);
            $('#subcat-list').selectBox('refresh');
        }
    }); 
});
</script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<?php $this->load->view('include/popups') ?>
</body>
</html>
