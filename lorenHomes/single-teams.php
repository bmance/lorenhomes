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
	$defaultAlt = get_bloginfo('name');
	$defaultTitle = get_the_title();

	$abpage = get_page_link(9);

	$bioID = get_the_ID();

	$featImg = get_the_post_thumbnail_url();
	if(wp_is_mobile()){
		$featImg = get_the_post_thumbnail_url($bioID, 'medium_large');
	}

	$date = get_the_date('m.d.Y');

	$bioPosition = get_field('team_position');
	$bioText = get_field('bio_text');
	$bioEmail = get_field('bio_email');

	$univtmplnk = get_field('universal_team_member_page_link','options');

	if($univtmplnk == '' || $univtmplnk == NULL){
		$univtmplnk = '/our-story';
	}

	$univtmptxt = get_field('universal_team_member_page_link_text','options');

	if($univtmptxt == '' || $univtmptxt == NULL){
		$univtmptxt = 'Back to Teams';
	}
 
?>

<div id="bioWrapper">

	<div id="cbPhoto">
		<div class="bgImage effect2" data-src="<?php echo $featImg;?>"></div>
		<img src="" data-src="<?php echo $featImg;?>" class="imageAbove" alt="<?php echo $defaultAlt;?>" title="<?php echo $defaultAlt;?>" />
	</div>

	<div id="cbText" class="ppcText">

		<div id="bioTitle">
			<h1><span class="bioName"><?php echo $defaultTitle;?></span></h1>
			<span class="bioJbtle"><?php echo $bioPosition;?></span>
		</div>

		<hr class="bioSeparators" />

		<?php echo $bioText; ?>

	</div>

	<?php if(have_rows('bio_social_media')){ ?>

		<div id="bioSmContainer">
			
			<?php 
				while(have_rows('bio_social_media')){

					the_row();

					$smIcon = get_sub_field('social_media_type');
					$smLink = get_sub_field('social_media_link'); 

					$ciArray = get_sub_field('custom_icon');
					$smCustomAlt = $ciArray['alt'];
					$smCustom = $ciArray['url'];
					
			?>

				<?php if($smCustom != ''){ ?>

					<a href="<?php echo $smLink;?>" target="_blank" class="bsmItems">
						<img src="<?php echo $smCustom;?>" alt="<?php echo $smCustomAlt;?>" />
					</a>

				<?php }else if($smIcon == 'mail-dark-circle'){?>

					<?php if($bioEmail != ''){ ?>

						<a data-fancybox data-src="#bioContact" href="javascript:;" class="bsmItems">
							<i class="icon-<?php echo $smIcon;?>"></i>
						</a>

					<?php }?>

				<?php }else{ ?>

					<a href="<?php echo $smLink;?>" target="_blank" class="bsmItems">
						<i class="icon-<?php echo $smIcon;?>"></i>
					</a>

				<?php }?>
				

			<?php }?>

		</div>

	<?php }?>
	
</div>



<div class="sngUniContainer">
		
	<a class="sngUnibtns" href="<?php echo $univtmplnk;?>">
		<?php echo $univtmptxt;?>
	</a>

</div>

<div id="bioContact">
	<h2>Contact <?php echo $defaultTitle;?></h2>
	<?php echo do_shortcode( '[contact-form-7 id="598" title="Bio Contact Form" obfuscate="on"]' );?>
</div>

<?php get_footer(); ?>
