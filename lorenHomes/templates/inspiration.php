<?php
/**
 * Template Name: Inspiration
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

	$i = 1;

	$inspRvws = get_field('inspiration_testimonials');

	$coMaintitle = get_field('inspiration_callout_title');
	if($coMaintitle == '' || $coMaintitle == NULL){
		$coMaintitle = 'Step By Step';
	}

	$galSubtitle = get_field('inspiration_gallery_subtitle');
	if($galSubtitle == '' || $galSubtitle == NULL){
		$galSubtitle = 'Inspiration Gallery';
	}

	$inspirSM = get_field('display_see_more');

	$inspirSMT = 'See More';
	$smTemp = get_field('see_more_button_text');
	if($smTemp != '' && $smTemp != NULL){
		$inspirSMT = $smTemp;
	}

	$inspirSML = get_field('see_more_link');
?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

<div id="lrhmInsptp" class="lrhmDCtners">
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
</div><!-- END OF lrhmComtp -->

<?php if($inspRvws){ ?>

	<div id="insprvws" class="rvwContainers">

		<div class="swiper-container">

			<div class="swiper-wrapper">

				<?php foreach($inspRvws as $featured_post):?>

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

		    	testSlider = new Swiper('#insprvws .swiper-container',{
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

<h2 class="nghSecTitles"><?php echo $coMaintitle;?></h2>

<?php if(have_rows('inspiration_callouts')){ ?>

	<div id="lrhcoContainer" class="lrnMnwrapper">
		
		<div class="lrhInnerwraps lrnCowrapper">
			
			<?php 
				while(have_rows('inspiration_callouts')){
					the_row();
					
					if(have_rows('callout_front')){
						while(have_rows('callout_front')){
							the_row();
							$cofTitle = get_sub_field('callout_front_title');
							$cofSubtitle = get_sub_field('callout_subtitle');
						}
					}

					$cobTxt = get_sub_field('callout_back'); 
			?>

			<div id="coBox<?php echo $i;?>" class="coBoxes">

				<div class="bxWrappers">

					<div class="coFront">
						<div class="cWrapper">
							<span class="cofmTitle">
								<?php echo $cofTitle;?>		
							</span>
							<hr class="coDividers" />
							<span class="cofmSubtitle">
								<?php echo $cofSubtitle;?>
							</span>
						</div>
					</div>

					<div class="coBack">
						<div class="cWrapper">
							<span class="cofmTitle">
								<?php echo $cofTitle;?>		
							</span>
							<hr class="coDividers" />
							<?php echo $cobTxt;?>
						</div>
					</div>

				</div><!-- END OF BXWRAPPERS -->

			</div><!-- END OF COBOXES -->

			<?php 
					$i++;
				}
			?>

			<div class="clear"></div>

		</div><!-- END OF LRNCOWRAPPER -->

	</div>

	<script type="text/javascript">
		
	</script>

<?php }?>


<?php if(have_rows('inspiration_gallery')){ ?>

	<div class="ldContainers">
		<hr class="lrnSecdvs" />
	</div>

	<div id="inspirGallery">

		<div class="lrhInnerwraps">

			<div id="galTop">
				<h3 class="nghSecTitles"><?php echo $galSubtitle;?></h3>
			</div>

			<div id="gctContainer">

				<div class="gctContainers">
					<a id='allBtn' class="galCategories animBtns" data-group="all" href="javascript:updateGallery('all','allBtn');">
						All
					</a>
					<a id='exteriorBtn' class="galCategories animBtns" data-group="social" href="javascript:updateGallery('exterior','exteriorBtn');">Exterior</a>
					<a id='interiorBtn' class="galCategories animBtns" data-group="clementine" href="javascript:updateGallery('interior','interiorBtn');">Interior</a>
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
					while(have_rows('inspiration_gallery')):
						the_row();
						$galDesc = '';
						$galAlt = get_bloginfo('title');
						$tempGalImg = get_sub_field('inspiration_photo');
						$galPhoto = $tempGalImg['url'];
						$galCat = get_sub_field('inspiration_type');
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


<?php if($inspirSM == 'yes'){ ?>

	<?php if($inspirSML != '' && $inspirSML != 'NULL'){ ?>

		<div class="lrnbContainers">

			<a href="<?php echo $inspirSML;?>" id="inspirBtn" class="lrnBtns" target="_blank">
				<?php echo $inspirSMT;?>
			</a>

		</div>

	<?php }?>

<?php }?>


<?php get_footer(); ?>
