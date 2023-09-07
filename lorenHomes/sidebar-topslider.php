<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage The Exchange at Gwinnett
 * @since The Exchange at Gwinnette 1.0
 */

$blogTitle = get_bloginfo('name');

?>

<?php
	$defaultImg = get_template_directory_uri().'/images/lrnhmDefault.jpg';
	$defaultAlt = $blogTitle;

	if(is_singular(array('neighborhoods', 'post'))){
		$neighTitle = get_the_title();
	}

	$tempDefault = get_field('default_image','options');
	if($tempDefault != '' || $tempDefault != NULL){
		$defaultImg = $tempDefault['url'];
		if(wp_is_mobile()){
			$defaultImg = $tempDefault['sizes']['medium_large'];
			//$defaultImg = $tempDefault['url'];
		}
		$slideAlt = $tempDefault['alt'];
	}

	$vidActive = get_field('activate_video','options');

	$homeVideo = get_field('video_link','options');
	$videoBckg = $defaultImg;

	if($videoBckg != '' && $videoBckg != NULL){
		$videoBckg = get_field('video_background_image','options');
		$videoBckg = $videoBckg['url'];
	}
?>

<div id="sldWrapper" class="mblWrapper">

	<?php if( (is_front_page()) && ($homeVideo != '' && $homeVideo != NULL) && ($vidActive == 'yes') ){ ?>

		<div id="topVideo" style="background-image: url('<?php echo $videoBckg;?>');">

			<div class="rel">
				<div id="tvWrapper">
					<iframe src="<?php echo $homeVideo;?>?autoplay=1&loop=1&background=1&title=0&byline=0&portrait=0&muted=1" title="<?php echo $blogTitle;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>

				<?php if(is_front_page()){ ?>

					<div id="arrowContainer">
						<div class="rel">
							<a id="scrollBtn" href="javascript:scrollDwn();">
								<i class="icon-down-arrow glow"></i>
							</a>
						</div>
					</div>

					<script type="text/javascript">
						function scrollDwn(){
							$('html, body').animate({'scrollTop': $(window).height() - 50}, 1400);
						}
					</script>

				<?php }?>

			</div>

		</div><!-- END OF TOPVIDEO -->


	<?php }else{ ?>


		<div id="topSlider">
			
			<div class="swiper-container">
				
				<div class="swiper-wrapper">
					

					<?php
						$i = 0;
						$totalSlides = 0;
						$imageArray = array();
						$imgTxtArray = array();
						$imageAlts = array();
						$slides = array();

						if(have_rows('top_slider')){
							while(have_rows('top_slider')):
								the_row();
								$imageArray[$i] = get_sub_field('slider_image');
								$imgTxtArray[$i] = get_sub_field('slider_text');
								if(is_singular(array('neighborhoods', 'post'))){
									if($imgTxtArray[$i] != '' && $imgTxtArray[$i] != NULL){
										$imgTxtArray[$i] = $neighTitle;
									}
								}
								$imageAlts[$i] = $imageArray[$i]['alt'];
								$slides[$i] = $imageArray[$i]['url'];

								if(wp_is_mobile()){
									$slides[$i] = $imageArray[$i]['sizes']['medium_large'];
								}

								echo '<div class="swiper-slide">';
								if($i == 0){
									echo '<div class="bgImage" style="background-image: url(\''.$slides[$i].'\')" ></div>';
								} else {
									//echo '<div class="bgImage" data-src="'.$slides[$i].'"></div>';
									echo '<div class="bgImage" style="background-image: url(\''.$slides[$i].'\')" ></div>';
								}
								echo '<img src="'.get_template_directory_uri().'/images/slidePlacement.png" alt="'.get_bloginfo('name').'" class="topPlacement" />';
								echo '<img data-src="'.$slides[$i].'" alt="'.get_bloginfo('name').' '.$imageAlts[$i].'" class="imageAbove" />';

								if($imgTxtArray[$i] != '' && $imgTxtArray[$i] != NULL){
									echo '<div class="slideTxt">';
										echo '<div class="rel">';
											echo $imgTxtArray[$i];
										echo '</div>';
									echo '</div>';
								}

								echo '</div>';
								$i++;

							endwhile;
						}

						$totalSlides = $i;

						if($totalSlides == 0) { 

							if(is_singular(array('neighborhoods', 'post'))){
								if(get_the_post_thumbnail_url()){
									$defaultImg = get_the_post_thumbnail_url(get_the_ID(),'full'); //GETS THE FEATURED IMAGE OF NEIGHBORHOOD IF ANY
								}else{
									$defaultImg = get_template_directory_uri().'/images/lrnhmDefault.jpg';
								}
							}
							
							$topAlt = $slideAlt.' ';
							if($defaultImg != '') {
								$slideDefault = $defaultImg;
								$topAlt .= $slideAlt;
								if(wp_is_mobile()) {
									$slideDefault = $defaultImg;
								}
							}
							echo '<div class="swiper-slide">';
							echo '<div class="bgImage" style="background-image: url(\''.$slideDefault.'\')"></div>';
							echo '<img src="'.get_template_directory_uri().'/images/slidePlacement.png"  class="topPlacement" />';
							echo '<img data-src="'.$slideDefault.'" alt="'.$topAlt.'" class="imageAbove" />';
							if(is_singular('neighborhoods')){
								echo '<div class="slideTxt">';
									echo '<div class="rel">';
										echo $neighTitle;
									echo '</div>';
								echo '</div>';
							}
							echo '</div>';
							$topTotal = 1;

						}


					?>

					<div id="arrowContainer">
						<div class="rel">
							<a id="scrollBtn" href="javascript:scrollDwn();">
								<i class="icon-down-arrow glow"></i>
							</a>
						</div>
					</div>
					<script type="text/javascript">
						function scrollDwn(){
							$('html, body').animate({'scrollTop': $(window).height() - 50}, 1400);
						}
					</script>


				</div><!-- END OF SWIPER WRAPPER -->

			</div><!-- END OF SWIPER CONTAINER -->


		</div><!-- END OF TOP SLIDER -->

		<?php if($totalSlides > 1) {?>

			<script type="text/javascript">

				var topSlider;

			    $(document).ready(function(){

			    	topSlider = new Swiper('#topSlider .swiper-container',{
						speed: 1100,
						autoplay: {
							delay: 4000,
							disableOnInteraction: false,
						},
						preloadImages: true,
						lazy: false,
						effect: 'fade',
						autoHeight: true,
						roundLengths: true,
						loop: true
					});

			    });

			    $(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
					topSlider.update();
				});

				$(window).resize(function() {
					topSlider.update();
				});

			</script>

		<?php }?>


	<?php }?>

</div>

