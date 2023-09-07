<?php
/**
 * Template Name: Work
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Loren Homes
 * @since 1.0
 */

get_header(); ?>

<?php
	$blogName = get_bloginfo('name');
	$defaultAlt = $blogName;
	$pageTitle = get_the_title();

	$wrkgSubtitle = 'Work Gallery';
	$tempwrkg = get_field('work_gallery_title');
	if($tempwrkg != '' && $tempwrkg != NULL){
		$wrkgSubtitle = $tempwrkg;
	}

	$wrkgSubtitle2 = 'Client Reviews';
	$tempwrkg2 = get_field('work_testimonial_title');
	if($tempwrkg2 != '' && $tempwrkg2 != NULL){
		$wrkgSubtitle2 = $tempwrkg2;
	}

	$wrkGallery = get_field('work_gallery');

	$wrkSM = get_field('display_see_more');

	$wrkSMT = 'See More';
	$smTemp = get_field('see_more_button_text');
	if($smTemp != '' && $smTemp != NULL){
		$wrkSMT = $smTemp;
	}

	$wrkSML = get_field('see_more_link');

	
	$wrkRvws = get_field('work_testimonials');
?>

<div id="lrhmWrktp" class="lrhmDCtners">
	<div class="lrhInnerwraps">
		<h1><?php echo $pageTitle;?></h1>
		<div class="titleDvs">
			<img src="<?php echo get_template_directory_uri();?>/images/lrhm-title-divider.png" alt="<?php echo $defaultAlt;?>">
		</div>
		<?php 
			if(have_posts()){
				while(have_posts()):
		       		the_post();
					the_content();
				endwhile;
			}
		?>
	</div>
</div><!-- END OF lrhmWrktp -->


<?php if(have_rows('work_gallery')){ ?>

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

	<div class="ldContainers">
		<hr class="lrnSecdvs" />
	</div>

	<div id="wrkGallery">

		<div class="lrhInnerwraps">

			<div id="wrkglTop" class="galtops">
				<h2 class="nghSecTitles"><?php echo $wrkgSubtitle;?></h3>
			</div>

			<div id="wrkctContainer">

				<div class="gctContainers">
					<a id='allBtn' class="galCategories" data-group="all" href="javascript:updateGallery('all','allBtn');">
						All
					</a>
					<a id='exteriorBtn' class="galCategories" data-group="social" href="javascript:updateGallery('exterior','exteriorBtn');">Exterior</a>
					<a id='interiorBtn' class="galCategories" data-group="clementine" href="javascript:updateGallery('interior','interiorBtn');">Interior</a>
				</div>

				<div style="position:relative;" class="gsContainer" id="gmcSelect">
					<select id="galmasSelect" class="galSelect" onChange="updateGallery(this.value);">
						<option value="all">All</option> 
			            <option value="exterior">Exterior Architecture</option> 
			            <option value="interior">Interiors</option> 
			        </select>  
				</div>

			</div>

			<div id="galleryList" class="grid">
				
				<?php
					while(have_rows('work_gallery')):
						the_row();
						$galDesc = '';
						$galAlt = get_bloginfo('title');
						$tempGalImg = get_sub_field('work_image');
						$galPhoto = $tempGalImg['url'];
						$galCat = get_sub_field('work_category');
						if($tempGalImg['description'] != ''){
							$galDesc = $tempGalImg['description'];
						}
						if($tempGalImg['alt'] != ''){
							$galAlt .= ' '.$tempGalImg['alt'];
						}
				?>

				<div class="shufItems lrhnGalItems" data-groups='["all","<?php echo $galCat;?>"]'>
					<a href="<?php echo $galPhoto;?>" data-fancybox="images" <?php if($galDesc != ''){?>data-caption="<?php echo $galDesc;?>"<?php }?>>
						<img src="<?php echo $galPhoto;?>" alt="<?php echo $galAlt;?>" />
						<div class="blkOvrly effect2"></div>
					</a>
				</div>

				<?php
					endwhile;
				?>

				<div class="shufItems sizer"></div>

			</div>

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
					updateGallery('all');
				});

				$(window).resize(function(){
					shuffleInstance.update();
				});

				function updateGallery(category){
					$('.gctContainers a').removeClass('active');
					$('#galmasSelect').val(category);
					shuffleInstance.filter(category);
					$('#'+category+'Btn').addClass('active');
					if(winWidth < 768){
						//$('html, body').animate({scrollTop: $('#galleryList').offset().top - 137 }, 'slow');
					}
				}

			</script>

		</div>

	</div>

<?php }?>

<?php if($wrkSM == 'yes'){ ?>

	<?php if($wrkSML != '' && $wrkSML != 'NULL'){ ?>

		<div class="lrnbContainers">

			<a href="<?php echo $wrkSML;?>" id="inspirBtn" class="lrnBtns" target="_blank">
				<?php echo $wrkSMT;?>
			</a>

		</div>

	<?php }?>

<?php }?>

<?php if($wrkRvws){ $j = 1;?>

	<div class="ldContainers">
		<hr class="lrnSecdvs" />
	</div>

	<div id="wrkrvwContainer">

		<div id="wrkglTop2" class="galtops">
			<h3 class="nghSecTitles"><?php echo $wrkgSubtitle2;?></h3>
		</div>

		<?php foreach($wrkRvws as $featured_post):?>

			<?php
				$rvwImage = get_the_post_thumbnail_url($featured_post->ID);
			?>

			<div id="wrkRvws<?php echo $j;?>" class="rvwContainers wrkrvContainers">
						
				<?php if($rvwImage == '' || $rvwImage == NULL){ ?>

					<div class="rvwTxt">
						<?php echo get_field('testimonial_text2',$featured_post->ID);?>
						<span class="rvwAthrs">
							<i><?php echo get_field('testimonial_client_name',$featured_post->ID);?></i>		
						</span>
						<div class="lftQuotes"><i class="icon-quotes-left"></i></div>
					</div>

				<?php }else{ ?>

					<div class="rvWrapper">	
					
						<div class="rvwLeft">
							<div class="bgImage" style="background-image: url('<?php echo $rvwImage;?>');"></div>
							<img src="<?php echo get_template_directory_uri();?>/images/rpPlacment.png" class="placement" alt="<?php echo $defaultAlt;?>" />
							<img src="<?php echo $rvwImage;?>" alt="<?php echo $defaultAlt;?>" class="imageAbove" />
						</div>

						<div class="rvwRight">
							<div class="rel">
								<div class="rvwTxt">
									<?php echo get_field('testimonial_text2',$featured_post->ID);?>
									<span class="rvwAthrs">
										<i><?php echo get_field('testimonial_client_name',$featured_post->ID);?></i>		
									</span>
									<div class="lftQuotes"><i class="icon-quotes-left"></i></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>

					</div>

				<?php }?>

			</div><!-- END OF HMTCONTAINER -->

		<?php 
				$j++;
			endforeach;
		?>

	</div>

<?php }?>

<?php get_footer(); ?>
