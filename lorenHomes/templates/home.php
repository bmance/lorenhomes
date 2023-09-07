<?php
/**
 * Template Name: Home
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Loren Homes
 * @since 1.0
 */

get_header(); ?>

<div id="hmTop">
	
	<?php
		$defaultAlt = get_bloginfo('name');

		$leftType;
		$rightType;

		$leftIframe;
		$rightIframe;

		$leftTxt = '<h1>'.get_the_title().'</h1>';

		$rightAlt = $defaultAlt;
		$rightImg = get_template_directory_uri().'/images/lrnhmDefault.jpg';

		if(have_posts()){
			while(have_posts()):
	       		the_post();
	       		$leftTxt .= get_the_content();
			endwhile;
		}

		if(have_rows('home_top')){
			while(have_rows('home_top')):

				the_row();

				if(have_rows('home_top_left')){
					while(have_rows('home_top_left')){
						the_row();
						$leftType = get_sub_field('home_top_type');
						$leftIframe = get_sub_field('iframe_link');
						$leftTxt;
					}
				}
				if(have_rows('home_top_right')){
					while(have_rows('home_top_right')){
						the_row();
						$rightType = get_sub_field('home_top_type');
						$rightIframe = get_sub_field('iframe_link');
			
						if(get_sub_field('home_image')){
							$homeImg = get_sub_field('home_image');
							$rightAlt = $homeImg['alt'];
							$rightImg = $homeImg['url'];
						}
					}
				}

			endwhile;
		}
	?>

	<?php if($leftType == 'iframe'){ ?>

		<div class="invisiContainer">
			<?php echo $leftTxt;?>
		</div>

	<?php }?>

	<div id="hmtLeft" class="hmtBxes <?php echo $leftType;?>">
		<div class="rel">
			<?php if($leftType == 'text'){?>
				<?php echo $leftTxt;?>
			<?php }else if($leftType == 'iframe'){ ?>
				<div class="embed-container">
					<iframe src="<?php echo $leftIframe;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			<?php }?>
		</div>
	</div><!-- END OF HMTLEFT -->

	<div id="hmtRght" class="hmtBxes <?php echo $rightType;?>">
		<div class="rel">
			<?php if($rightType == 'image'){?>
				<img src="<?php echo $rightImg;?>" alt="<?php echo $rightAlt;?>" />
			<?php }else if($rightType == 'iframe'){ ?>
				<div class="embed-container">
					<iframe src="<?php echo $rightIframe;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			<?php }?>
		</div>
	</div><!-- END OF HMTRGHT -->

	<div class="clear"></div>

</div><!-- END OF HMTOP -->

<div id="hmcoContainer">
	
	<?php if(have_rows('home_callouts_top')){ ?>
		<div id="ctpContainer">
			<?php
				$i = 1;
				$htpImg1 = get_template_directory_uri().'/images/htmc_01.jpg';
				$htpLink1;
				$htpTxt1 = 'See New Homes';

				$htpImg2 = get_template_directory_uri().'/images/htmc_02.jpg';
				$htpLink2;
				$htpTxt1 = 'Build With Us';
				
				$hcTop = array(array());
				while(have_rows('home_callouts_top')){
					the_row();
					$hcTop[$i]['img'] = get_sub_field('callout_background_image');
					//$hcTop[$i]['img'] = $hcTop[$i]['img']['url'];
					$hcTop[$i]['link'] = get_sub_field('callout_link');
					$hcTop[$i]['text'] = get_sub_field('callout_text');
					$linkType = get_sub_field('link_type');
				?>

				<div id="htpCO<?php echo $i;?>" class="hmcBxes coBxtps">
					<div class="bgImage" style="background-image: url('<?php echo $hcTop[$i]['img'];?>');"></div>
					<div class="blkOvrly effect2"></div>
					<?php if($hcTop[$i]['link'] != '' && $hcTop[$i]['link'] != NULL){?>
						<a href="<?php echo $hcTop[$i]['link'];?>" <?php if($linkType == 'external'){ echo 'target="_blank"';}?>>
					<?php }?>
					<div class="hmcWrapper">
						<div class="innerWrappers">
							<div class="hmcoTxt">
								<?php echo $hcTop[$i]['text'];?>	
							</div>
						</div>
					</div>
					<?php if($hcTop[$i]['link'] != '' && $hcTop[$i]['link'] != NULL){?>
						</a>
					<?php }?>
				</div>

				<?php
					$i++;
				}

			?>

			<div class="clear"></div>

		</div>
	<?php }?>

	<?php if(have_rows('home_callouts_bottom')){ ?>
		<div id="cmidContainer">
			
			<?php
				$i = 1;
				$hcBtm = array(array()); 
				while(have_rows('home_callouts_bottom')){
					the_row();
					$hcBtm[$i]['img'] = get_sub_field('callout_background_image');
					//$hcBtm[$i]['img'] = $hcBtm[$i]['img']['url'];
					$hcBtm[$i]['link'] = get_sub_field('callout_link');
					$hcBtm[$i]['text'] = get_sub_field('callout_text');
					$linkType = get_sub_field('link_type');
			?>

			<div id="htpCO<?php echo $i;?>" class="hmcBxes coBxbms">
				<div class="bgImage" style="background-image: url('<?php echo $hcBtm[$i]['img'];?>');"></div>
				<div class="blkOvrly effect2"></div>
				<?php if($hcBtm[$i]['link'] != '' && $hcBtm[$i]['link'] != NULL){?>
					<a href="<?php echo $hcBtm[$i]['link'];?>" <?php if($linkType == 'external'){ echo 'target="_blank"';}?>>
				<?php }?>
				<div class="hmcWrapper">
					<div class="innerWrappers">
						<div class="hmcoTxt">
							<?php echo $hcBtm[$i]['text'];?>
						</div>
					</div>
				</div>
				<?php if($hcBtm[$i]['link'] != '' && $hcBtm[$i]['link'] != NULL){?>
					</a>
				<?php }?>
			</div>

			<?php
				$i++;
				}
			?>

			<div class="clear"></div>

		</div>
	<?php }?>

</div><!-- END OF HMCOCONTAINER -->

<?php
	$tmonCount = 1;
	$totalTest;
	$hmtmonials = get_field('home_testimonials');
?>

<?php if($hmtmonials){ ?>

	<div id="hmtContainer" class="rvwContainers">

		<div class="swiper-container">

			<div class="swiper-wrapper">

				<?php foreach($hmtmonials as $featured_post):?>

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

				<?php endforeach;?>
				
			</div>

		</div>

		<script type="text/javascript">

			var testSlider;

		    $(document).ready(function(){

		    	testSlider = new Swiper('#hmtContainer .swiper-container',{
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

	</div><!-- END OF HMTCONTAINER -->

<?php }?>


<?php get_footer(); ?>
