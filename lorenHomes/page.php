<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Clementine Creative Agency
 * @since Clementine Showcase 1.0
 */

get_header(); ?>

<?php
	$blogName = get_bloginfo('name');
	$defaultAlt = $blogName;
	$pageTitle = get_the_title();
?>

<div id="dftContainer" class="lrhmDCtners">
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
</div><!-- END OF lrhmComtp -->


<?php get_footer();?>
