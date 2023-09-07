<?php
/**
 * Template Name: Template
 * Template Post Type: post, page
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
?>

<h1><?php echo $pageTitle;?></h1>

<?php 
	if(have_posts()){
		while(have_posts()):
       		the_post();
			the_content();
		endwhile;
	}
?>


<?php get_footer(); ?>
