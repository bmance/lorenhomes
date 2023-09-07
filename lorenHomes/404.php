<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<div id="lrnhmError">

	<h1><?php _e( 'Page Not Found', 'twentytwenty' ); ?></h1>

	<div id="lrnertxt">
		<p>
			<?php _e( 'Sorry. The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'twentytwenty' ); ?>		
		</p>
	</div>

</div><!-- .section-inner -->

<?php get_footer(); ?>
