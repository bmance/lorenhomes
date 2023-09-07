<?php
/**
 * Template Name: Contact
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

	$formShrtcde = '[contact-form-7 id="6" title="Main Contact Form"]';
?>

<div id="lrhmCntop" class="lrhmDCtners">
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
</div><!-- END OF lrhmCntop -->

<?php if(have_rows('contact_information')){ ?>
	<div id="lrhmCMContainer">
		<?php while(have_rows('contact_information')): the_row(); ?>
			
			<?php if(have_rows('contact_left')){ ?>
			<div id="lrhCtleft" class="lrncmSecs">
				<?php 
					while(have_rows('contact_left')){
						the_row();
						$ciTitle = get_sub_field('contact_info_title'); 
						$ciText = get_sub_field('contact_info_text'); 
				?>
					<div class="rel">
						<?php if($ciTitle != '' && $ciTitle != NULL){ ?>
							<h2><?php echo $ciTitle;?></h2>
						<?php }?>
						<?php echo $ciText;?>
					</div>
				<?php }?>
			</div>
			<?php }?>

			<?php if(have_rows('contact_right')){ ?>
			<div id="lrhCtRight" class="lrncmSecs">
				<?php 
					while(have_rows('contact_right')){
						the_row();
						$tempForm = get_sub_field('contact_form_shortcode');
						if($tempForm != '' && $tempForm != NULL){
							$formShrtcde = $tempForm; 
						}
				?>
					<div class="rel">
						<?php echo do_shortcode($formShrtcde); ?>
					</div>
				<?php }?>
			</div>
			<?php }?>

		<?php endwhile; ?>
		<div class="clear"></div>
	</div><!-- END OF lrhmCMContainer -->
<?php }?>


<?php get_footer(); ?>
