<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <!-- FAVICONS -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">

		<!-- APPLE TOUCH ICONS -->
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />

		<!-- SITE MANIFEST -->
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#425563">
		<meta name="msapplication-TileColor" content="#425563">
		<meta name="theme-color" content="#425563">

		<?php if(is_single()){ ?>
		<?php }else{ ?>
		<!-- RICH PREVIEW: thumbnail for when site is shared on social media -->
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
		<?php }?>

		<!-- JAVASCRIPT -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.5.1.js"></script>
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>

		<!-- SHUFFLE.JS -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/shuffle.js"></script>

		<!-- IDANGEROUS SWIPER SLIDE -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/swiper-slider/swiper-slide.css">
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swiper-slider/swiper-slide.js"></script>

		<!-- FONT ICONS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/font-icons/lrn-icons.css" media="none" onload="this.media='all';">

		<!-- ADOBE FONT IMPORT -->
		<link rel="stylesheet" href="https://use.typekit.net/ltb2eqy.css" media="none" onload="this.media='all';">

		<!-- GOOGLE MAPS API KEY -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpi03OVT5qd-fLCF7KXY6Vq5ssvI86aGo" defer></script>
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpi03OVT5qd-fLCF7KXY6Vq5ssvI86aGo&callback=initMap&libraries=&v=weekly" defer></script>-->

		<!-- FANCYBOX -->
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.js"></script>
		<link href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">

		<!-- SLICK SLIDER -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/slick/slick-theme.css"/>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slick/slick.js"></script>

		<?php if(get_field('google_analytics','options')){ 
			$gaID = get_field('google_analytics','options');
		?>

			<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gaID;?>"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', '<?php echo $gaID;?>');
			</script>

		<?php }?>

		<?php if(get_field('second_google_analytics_tracker','options')){ 
				$gaID2 = get_field('second_google_analytics_tracker','options');
		?>

			<!-- Global site tag (gtag.js) - Google Analytics Second Tracker -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gaID2;?>"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', '<?php echo $gaID2;?>');
			</script>

		<?php }?>

		<?php if(get_field('google_tag_manager_id','options')){ 
			$gtagID = get_field('google_tag_manager_id','options');
		?>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','<?php echo $gtagID;?>');</script>
			<!-- End Google Tag Manager -->
		<?php }?>


		<!-- CUSTOM HEADER CODE -->
		<?php if(get_field('custom_header_code','options')){?>
		
			<?php echo '<div class="invisContainer">'.get_field('custom_header_code','options').'</div>';?>
		
		<?php }?>
		<!-- CUSTOM HEADER CODE -->

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<!-- CUSTOM BODY CODE -->
		<?php if(get_field('custom_body_code','options')){?>
		
			<?php echo '<div class="invisContainer">'.get_field('custom_body_code','options').'</div>';?>
		
		<?php }?>
		<!-- CUSTOM BODY CODE -->

		<?php

			$defaultAlt = get_bloginfo('name');
			$homeUrl = get_home_url();
			$wrapClass;

			$hdClass = 'dfltop';

			$bdyWrap = 'defaultWrap';
			$logoClass = 'default';

			if(is_front_page()){
				$hdClass = 'hmtop';
				$bdyWrap = 'hmWrap';

				$logoClass = 'home';
			}

			/*if(is_single()){
				$bdyWrap = 'pstWrap';
			}*/

			$dtpSlider = get_field('display_top_slider');

			if($dtpSlider == 'yes'){
				$wrapClass = '';
			}else{
				$wrapClass = 'mblWrapper';
			}

			if ( is_single() && 'teams' == get_post_type() ) {
				$dtpSlider == 'no';
				$bdyWrap = 'pstWrap';
				$wrapClass = 'mblWrapper';
			}

			if ( is_single() && 'testimonials' == get_post_type() ) {
				$dtpSlider == 'no';
				//$bdyWrap = 'pstWrap';
				$wrapClass = 'mblWrapper';
			}

			//LOGO
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$lrnhLogo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			$lrnhLogo = $lrnhLogo[0];
			if($lrnhLogo == '' || $lrnhLogo == NULL){
				$lrnhLogo = get_template_directory_uri().'/images/lrnhm_logo.png';
			}

			//REVEAL LOGO
			$revealLogo = get_field('header_reveal_logo','options'); 
			$revealLogo = $revealLogo['url'];
			if($revealLogo == '' || $revealLogo == NULL){
				$revealLogo = $lrnhLogo;
			}
		?>

		<header id="lrnHeader" class="<?php echo $hdClass;?> effect2">
			
			<div id="lhWrapper" class="rel">

				<a href="<?php echo $homeUrl;?>" id="lrnLogoMbl">
						
					<img src="<?php echo $lrnhLogo;?>" alt="<?php echo $defaultAlt;?> Home Logo" title="<?php echo $defaultAlt;?> Home Logo" aria-label="<?php echo $defaultAlt;?> Logo" />
						
				</a>

				<a href="<?php echo $homeUrl;?>" id="lrnLogoDsk">
						
					<img id="logoDft" class="<?php echo $logoClass;?>" src="<?php echo $revealLogo;?>" alt="<?php echo $defaultAlt;?> Home Logo" title="<?php echo $defaultAlt;?> Home Logo" aria-label="<?php echo $defaultAlt;?> Logo" />
					<img id="logoRvl" class="<?php echo $logoClass;?>" src="<?php echo $lrnhLogo;?>" alt="<?php echo $defaultAlt;?> Home Logo" title="<?php echo $defaultAlt;?> Home Logo" aria-label="<?php echo $defaultAlt;?> Logo" />
						
				</a>

				<a id="lmButton" href="javascript:mobileMenu();">
					<div id="iconLines">
						<span class="menuLines"></span>
						<span class="menuLines"></span>
						<span class="menuLines"></span>
						<span class="clear"></span>
					</div>
					<span id="menuTxt" class="effect2"></span>
				</a>

				<div id="menuContainer">

					<div id="menuWrapper">

						<div class="rel">

							<?php wp_nav_menu(array('menu' => 'Main Menu'));?>

						</div>

					</div><!-- END OF MENUWRAPPER -->


				</div><!-- END OF MENUCONTAINER -->

			</div>

			<!--<div class="whtBkg effect2"></div>-->

		</header><!-- END OF TOPCONTAINER -->

		<script type="text/javascript">
			
			var scroll = $(window).scrollTop();
			var winWidth = $(window).width();  // WINDOW WIDTH
			var winHeight = $(window).height(); // WINDOW HEIGHT

			$(document).ready(function() { // will be executed immediately
				winWidth = $(window).width();
				winHeight = $(window).height();
			});

			<?php if(is_front_page()){ ?>
				$(window).scroll(function() {
					scroll = $(window).scrollTop();
					var mainCnt = $('#sldWrapper').offset();
					if(winWidth >= 768){
						if(document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
							$('#lrnHeader.hmtop').addClass('whtrvl');
							$('#logoDft').fadeOut();
							$('#logoRvl').fadeIn();
							//$('#logoRvl').delay(100).addClass('blockShow');
							$('#menuContainer').slideDown();
						}else{
							$('#lrnHeader.hmtop').removeClass('whtrvl');
							$('#logoRvl').fadeOut();
							$('#logoDft').fadeIn();
							//$('#logoRvl').delay(50).removeClass('blockShow');
							$('#menuContainer').slideUp();
						}
					}
				});
			<?php }?>

			$(window).resize(function(){

				winWidth = $(window).width();
				winHeight = $(window).height();
				scroll = $(window).scrollTop();

				<?php if(is_front_page()){ ?>
					if(winWidth < 768){
						$('#lrnHeader.hmtop').removeClass('whtrvl');
						$('#menuContainer').slideUp();
					}else{
						if(document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
							$('#lrnHeader.hmtop').addClass('whtrvl');
							//$('#lrnHeader .whtBkg').fadeIn();
							$('#menuContainer').slideDown();
						}else{
							$('#lrnHeader.hmtop').removeClass('whtrvl');
							//$('#lrnHeader .whtBkg').fadeOut();
							$('#menuContainer').slideUp();
						}
					}
				<?php }else{ ?>

					if(winWidth <= 768){
						if(menu == 1){
							$('#menuContainer').slideUp('slow');
							$('#lmButton').removeClass('open');
							$('#menuTxt').text('Menu');
							menu = 0;
						}else{
							$('#menuContainer').slideUp('slow');
						}
					}else{
						$('#menuContainer').slideDown('slow');
					}

				<?php }?>
			});

		</script>

		<?php

			if($dtpSlider == 'yes'){
				if ( is_single() && 'teams' == get_post_type() ) {

				}else if( is_single() && 'testimonials' == get_post_type() ) {

				}else{
					get_sidebar('topslider');
				}
			}
		?>

		<main id="lrnWrapper" class="<?php echo $wrapClass;?> <?php echo $bdyWrap;?>" role="main">
