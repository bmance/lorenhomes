<?php
/**
 * The template for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(); ?>

<?php
	$pageTitle = get_the_title();
	$defaultAlt = get_bloginfo('name');
	$date = get_the_date( 'F j, Y' );
	$current_url = home_url( add_query_arg( array(), $wp->request ) );

	$postImage = get_template_directory_uri().'/images/postDefault.png';

	if(get_the_post_thumbnail_url()){
		$postImage = get_the_post_thumbnail_url();
	}

	$postCategories = get_the_terms( $post->ID, 'category' );
	if ( ! empty( $postCategories ) && ! is_wp_error( $postCategories ) ) {
	    //$blog[$i]['cateSeparate'] = wp_list_pluck( $postCategories, 'name' );
	    $categoryList = join(', ', wp_list_pluck($postCategories, 'name'));
	}

	$category = get_the_terms($post->ID, 'category');
	$categorySize = sizeof($category);


	//NEIGHBORHOOD GENERAL
	if(have_rows('neighborhood_general')){
		while(have_rows('neighborhood_general')){

			the_row();

			$neighStp = get_sub_field('starting_price_point_text');
			$neighEdp = get_sub_field('ending_price');
			$neighPhn = get_sub_field('phone_number');

			$ntcbType = get_sub_field('contact_button_type');
			if($ntcbType == 'popup'){
				$ntcbCustom = 'data-fancybox data-src="#neighPopup"';
			}else if($ntcbType == 'external'){
				$ntcbCustom = 'target="_blank"';
			}else{
				$ntcbCustom = '';
			}

			$ntcbTxt = get_sub_field('contact_button_text');
			if($ntcbTxt == '' || $ntcbTxt == NULL){
				$ntcbTxt = 'See Floorplan';
			}

			$ntcbLink = get_sub_field('contact_button_link');
			if($ntcbType == 'popup'){
				$ntcbLink = 'javascript:;';
			}

			/*$nctShrtcde = get_sub_field('contact_form_shortcode');
			if($nctShrtcde == '' && $nctShrtcde == NULL){
				$nctShrtcde = '[contact-form-7 id="209" title="Neighborhood Single Form"]';
			}*/

			$popShrtcde = get_sub_field('contact_form_shortcode');
			if($popShrtcde == '' && $popShrtcde == NULL){
				$popShrtcde = $nctShrtcde;
			}

			$popTxt = get_sub_field('popup_contact_form_text');

			$neighMap = get_sub_field('neighborhood_map');
		}
	}


	//NEIGHBORHOOD FEATURES
	$nghFAtlte = get_field('neighborhood_feature_title');
	if($nghFAtlte == '' || $nghFAtlte == NULL){
		$nghFAtlte = 'Featured Homes';
	}

	//NEIGHBORHOOD TESTIMONIALS
	$ntsmonCount = 0;
	$ntsmonials = get_field('neighborhood_testimonial');

	//NEIGHBORHOOD GALLERY
	$nghGaltlte = get_field('neighborhood_gallery_title');
	if($nghGaltlte == '' || $nghGaltlte == NULL){
		$nghGaltlte = 'Featured Gallery';
	}

	$neighGal = get_field('neighborhood_gallery');
?>


<?php if(have_rows('neighborhood_top')){ ?>
	<div id="neighTop">

		<div class="nghSecWrapper">

			<?php 
				while(have_rows('neighborhood_top')){
					the_row();
					$ntLft = get_sub_field('neigh_block_left');
					if(have_rows('neigh_block_right')){
						while (have_rows('neigh_block_right')) {
							the_row();
							$ntRghtype = get_sub_field('block_type');
							$ntrImage = get_sub_field('neigh_right_image');
							//$ntrAlt = $ntrImage['alt'];
							//$ntrImage = $ntrImage['url'];
							$ntrVideo = get_sub_field('neigh_right_video');
						}
					}
				} 
			?>

			<div id="ngLftbx" class="nghtBxes">
				<div class="rel">
					<?php echo $ntLft;?>
					<div class="nghlftInfo">
						<?php if($neighStp != '' && $neighStp != NULL){ ?>
						<span><?php echo $neighStp;?></span>
						<span class="nghtDvd">|</span>
						<?php }?>
						<?php if($neighPhn != '' && $neighPhn != NULL){ ?>
						<span><a href="tel:<?php echo $neighPhn;?>"><?php echo $neighPhn;?></a></span>
						<span class="nghtDvd">|</span>
						<?php }?>
						<a href="<?php echo $ntcbLink;?>" <?php echo $ntcbCustom;?>>
							<?php echo $ntcbTxt;?>
						</a>
					</div>
				</div>
			</div>

			<div id="ngRgtbx" class="nghtBxes <?php echo $ntRghtype;?>">
				<div class="rel">
					<?php if($ntRghtype == 'image'){?>
						<img src="<?php echo $ntrImage['url'];?>" alt="<?php echo $ntrAlt;?>" />
					<?php }else if($ntRghtype == 'video'){ ?>
						<div class="embed-container">
							<iframe src="<?php echo $ntrVideo;?>?portrait=0&title=0&byline=0" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>
					<?php }?>
				</div>
			</div>

			<div class="clear"></div>

		</div><!-- END OF NGHSECWRAPPER -->

	</div><!-- END OF NEIGHTOP -->


	<?php if($ntcbType == 'popup'){?>
		<div id="neighPopup">
			<div id="npTxt"><?php echo $popTxt;?></div>
			<?php //echo do_shortcode($popShrtcde); ?>
		</div>
	<?php }?>

<?php }?>

<?php if(have_rows('neighborhood_features')){ ?>

	<h2 class="nghSecTitles"><?php echo $nghFAtlte;?></h2>

	<div id="neighFA">

		<div class="nghSecWrapper">

			<?php
				$i = 1;
				$galleryCount = 1; 
				while(have_rows('neighborhood_features')){ 
					the_row();

					$nfImage = get_sub_field('feature_image');
					$nfAlt = $nfImage['alt'];
					$nfImage = $nfImage['url'];
					$nfTxt = get_sub_field('feature_text');

					$nfGallery = get_sub_field('feature_gallery');

					$galleryCount = sizeof($nfGallery);

					if(have_rows('feature_text')){
						while(have_rows('feature_text')){
							the_row();
							$fpTop = get_sub_field('display_fp_top');
							$fpName = get_sub_field('floor_plan_name');
							$fpBed = get_sub_field('bedrooms');
							$fpBath = get_sub_field('bathrooms');
							$fpSqft = get_sub_field('square_footage');
							$fpText = get_sub_field('floor_plan_text');
						}
					}

					if(have_rows('feature_button')){
						while(have_rows('feature_button')){
							the_row();
							$nfcTxt = get_sub_field('link_text');
							if($nfcTxt == '' || $nfcTxt == NULL){
								$nfcTxt = 'See Floorplan';
							}
							$nfcLnk = get_sub_field('button_link');
						}
					}

					if($i % 2 == 0){
						$lftClass = 'nghfaRght';
						$rghtClass = 'nghfaLft';
					}else{
						$lftClass = 'nghfaLft'; //nghfaLft
						$rghtClass = 'nghfaRght'; //nghfaRght
					} 
			?>

			<div id="neighFA<?php echo $i?>" class="neighFAbxs">

				<div id="nghfaImg<?php echo $i?>" class="nghfaImgs <?php echo $lftClass;?>">

					<?php if($nfGallery){ ?>

						<div class="swiper-container" dir="rtl">
							
							<div class="swiper-wrapper">
								
								<?php foreach($nfGallery as $gallery){?>

									<div class="swiper-slide" style="background-image: url('<?php echo $gallery['url']; ?>');">
										<div class="rel">
											<img src="<?php echo $gallery['url']; ?>" class="imageAbove" alt="<?php echo $gallery['alt']; ?>" title="<?php echo $gallery['alt']; ?>" />
										</div>
									</div>

								<?php }?>

							</div>

						</div>

					<?php }?>

				</div>

				<div class="nghfaBrder"></div>

				<div id="nghfaTxt<?php echo $i?>" class="nghfaTxts <?php echo $rghtClass;?>">

					<div class="rel">
						<?php echo $fpText;?>

						<?php if($nfcLnk != '' && $nfcLnk != NULL){?>
							<a href="<?php echo $nfcLnk;?>" class="nghfaBtns" target="_blank">
								<?php echo $nfcTxt;?>
							</a>
						<?php }?>

					</div>

				</div>

				<div class="clear"></div>

			</div>

			<?php if($galleryCount > 1){ ?>

				<script type="text/javascript">

					var faSlider<?php echo $i;?>;

				    $(document).ready(function(){

				    	faSlider<?php echo $i;?> = new Swiper('#nghfaImg<?php echo $i?> .swiper-container',{
							speed: 1100,
							autoplay: {
								delay: 4000,
								disableOnInteraction: false,
							},
							//preloadImages: true,
							//lazy: false,
							effect: 'slide',
							autoHeight: true,
							roundLengths: true,
							loop: true
						});

				    });

				    $(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
						faSlider<?php echo $i;?>.update();
					});

					$(window).resize(function() {
						faSlider<?php echo $i;?>.update();
					});

				</script>

			<?php }?>

			<?php
					$i++; 
				} 
			?>

		</div>

	</div><!-- END OF NEIGHFA -->

<?php }?>

<?php if($ntsmonials){?>
	<div id="neighTstmon" class="rvwContainers">

		<div class="swiper-container">

			<div class="swiper-wrapper">

				<?php foreach($ntsmonials as $featured_post):?>

					<div class="swiper-slide">
						<?php //echo get_the_title( $featured_post->ID );?>
						<?php //echo get_the_content( $featured_post->ID );?>
						<div class="rvwTxt">
							<?php echo get_field('testimonial_text2',$featured_post->ID);?>
							<span class="rvwAthrs">
								<i><?php echo get_field('testimonial_client_name',$featured_post->ID);?></i>		
							</span>
							<div class="lftQuotes"><i class="icon-quotes-left"></i></div>
						</div>
					</div>

				<?php 
						$ntsmonCount++;
					endforeach;
				?>

			</div>

		</div>

		<?php if($ntsmonCount > 1){?>
			<script type="text/javascript">

				var testSlider;

			    $(document).ready(function(){

			    	testSlider = new Swiper('#neighTstmon .swiper-container',{
						speed: 1100,
						autoplay: {
							delay: 4000,
							disableOnInteraction: false,
						},
						//preloadImages: true,
						//lazy: false,
						effect: 'slide',
						autoHeight: true,
						roundLengths: true,
						loop: true
					});

			    });

			    $(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
					testSlider.update();
				});

				$(window).resize(function() {
					testSlider.update();
				});

			</script>
		<?php }?>	

	</div><!-- END OF NEIGHTSTMON -->

<?php }?>

<?php if($neighGal){?>

	<h3 class="nghSecTitles"><?php echo $nghGaltlte;?></h2>

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

	<div id="nghGallery">

		<div class="nghSecWrapper grid">
			
			<?php
				$k = 1; 
				foreach($neighGal as $gallery): 
			?>

			<div id="lrhnGalItem<?php echo $k;?>" class="shufItems lrhnGalItems">
				<a href="<?php echo $gallery['url'];?>" data-fancybox="images">
					<img src="<?php echo $gallery['url'];?>" alt="<?php echo $gallery['alt'];?>" />
				</a>
			</div>

			<?php
					$k++; 
				endforeach; 
			?>

			<div class="shufItems sizer"></div>

		</div>

	</div><!-- END OF NGHGALLERY -->

	<script type="text/javascript">
			
		var Shuffle = window.Shuffle;
		var element = document.querySelector('.grid');
		var sizer = element.querySelector('.sizer');
		var winWidth = $(window).width();
		var winHeight = $(window).height();

		var shuffleInstance = new Shuffle(element, {
		  itemSelector: '.lrhnGalItems',
		  columnWidth: 0,
		  sizer: sizer // could also be a selector: '.my-sizer-element'
		});

		$(document).ready(function(){
			winWidth = $(window).width();
			winHeight = $(window).height();
			shuffleInstance.update();
		});

		$(window).resize(function(){
			shuffleInstance.update();
		});

	</script>

<?php }?>

<?php if(have_rows('neighborhood_footer')){?>

	<div id="neighFooter">

		<div class="rel">

			<?php 
				while(have_rows('neighborhood_footer')){
					the_row();
					$nfbtAddress = get_sub_field('footer_map_address');

					$nfbtImage = get_sub_field('footer_photo');
					$nfbtAlt = $nfbtImage['alt'];
					$nfbtImage = $nfbtImage['url'];
					if($nfbtImage == '' || $nfbtImage == NULL){
						$nfbtImage = get_template_directory_uri().'/images/npstDefault_color.jpg';
						$nfbtAlt = $defaultAlt;
					}

					
					$nfbtForm = get_sub_field('footer_form');
			?>

				<div id="nghftLft">

					<div class="rel">

						<div class="mapContainer" style="width: 100%; height: 100%;">

							<div id="markers" style="display:none;">

								<div class="marker Home" data-lat="<?php echo $neighMap['lat'];?>" data-lng="<?php echo $neighMap['lng'];?>">

									<div class="mrkInner">
										<span class="mrkTitle"><?php echo $blogName;?></span>
										<div id="mpAddress">
											<?php echo $neighMap['address'];?>
										</div>
									</div>

								</div>

							</div>

						</div>

						<script type="text/javascript">
								
							/*
							*  render_map
							*
							*  This function will render a Google Map onto the selected jQuery element
							*
							*  @type	function
							*  @date	8/11/2013
							*  @since	4.3.0
							*
							*  @param	$el (jQuery element)
							*  @return	n/a
							*/
							var markerBg = '<?php echo get_template_directory_uri()."/images/markerHome.png"; ?>';

							function new_map( $el ) {

								// var
								var $markers = $el.find('.marker');
								
								
								// vars
								var args = {
									zoom: 15,
									maxZoom: 15,
									center		: new google.maps.LatLng(0, 0),
									mapTypeId	: google.maps.MapTypeId.ROADMAP
								};
								
								
								// create map	        	
								var map = new google.maps.Map($el[0], args);
								
								
								// add a markers reference
								map.markers = [];
								
								
								// add markers
								$markers.each(function(){
									
							    	add_marker( $(this), map );
									
								});
								
								
								// center map
								center_map( map );
								
								
								// return
								return map;
								
							}

							/*
							*  add_marker
							*
							*  This function will add a marker to the selected Google Map
							*
							*  @type	function
							*  @date	8/11/2013
							*  @since	4.3.0
							*
							*  @param	$marker (jQuery element)
							*  @param	map (Google Map object)
							*  @return	n/a
							*/

							function add_marker( $marker, map ) {

								// var
								var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

								// create marker
								var marker = new google.maps.Marker({
									position	: latlng,
									icon: markerBg,
									map			: map
								});

								// add to array
								map.markers.push( marker );

								// if marker contains HTML, add it to an infoWindow
								if( $marker.html() )
								{
									// create info window
									var infowindow = new google.maps.InfoWindow({
										content		: $marker.html()
									});

									// show info window when marker is clicked
									google.maps.event.addListener(marker, 'click', function() {

										infowindow.open( map, marker );

									});
								}

							}

							/*
							*  center_map
							*
							*  This function will center the map, showing all markers attached to this map
							*
							*  @type	function
							*  @date	8/11/2013
							*  @since	4.3.0
							*
							*  @param	map (Google Map object)
							*  @return	n/a
							*/

							function center_map( map ) {

								// vars
								var bounds = new google.maps.LatLngBounds();

								// loop through all markers and create bounds
								$.each( map.markers, function( i, marker ){

									var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

									bounds.extend( latlng );

								});

								// only 1 marker?
								if( map.markers.length == 1 )
								{
									// set center of map
								    map.setCenter( bounds.getCenter() );
								    map.setZoom(15);
								}
								else
								{
									// fit to bounds
									map.fitBounds( bounds );
									map.setZoom(15);
								}

							}

							/*
							*  document ready
							*
							*  This function will render each map when the document is ready (page has loaded)
							*
							*  @type	function
							*  @date	8/11/2013
							*  @since	5.0.0
							*
							*  @param	n/a
							*  @return	n/a
							*/
							// global var
							var map = null;

							$(document).ready(function(){

								$('.mapContainer').each(function(){
									map = new_map( $(this) );
								});

							});

						</script>

						<div class="nfbAddrss">
							<?php echo $nfbtAddress;?>
						</div>

					</div>

				</div>

				<div id="nghftMid">
					<div class="bgImage" style="background-image:url('<?php echo $nfbtImage;?>');"></div>
					<!--<img class="placement" src="<?php echo get_template_directory_uri();?>/images/ftplacment.png" alt="<?php echo $defaultAlt;?>" />-->
					<img class="imageAbove" src="<?php echo $nfbtImage;?>" alt="<?php echo $nfbtAlt;?>"/>
				</div>

				<div id="nghftRgt">
					<div class="rel">
						<?php echo $nfbtForm;?>
					</div>
				</div>

				<div class="clear"></div>

			<?php }?>

		</div>

	</div><!-- END OF NEIGHFOOTER -->

<?php }?>


<?php get_footer(); ?>
