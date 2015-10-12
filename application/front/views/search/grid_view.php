<?php
$headerData = $this->headerlib->data();
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
                </div>
            
            <!-- sidebar -->
            <div class="container">
                
                <div class="row">
                    <div class="sideabr-content">
                        <?php $this->load->view('search/sidebar', array('cat_options'=>$cat_options)); ?>
                    </div>
                    <div class="right-content">
                        <?php $this->load->view('search/grid_list_view'); ?>
                    </div>
                    
		</div>
            </div>
            
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