<?php
/**
 * Template Name: Teams
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

	$tmTestmonials = get_field('display_team_quote');
	$tmQuote = get_field('team_quote');

	$tmgPhoto = get_template_directory_uri().'/images/lrhmgroup.jpg';
	$tmgAlt = $defaultAlt;

	$tmgpTemp = get_field('team_group_photo');
	if($tmgpTemp != '' && $tmgpTemp != NULL){
		$tmgPhoto = $tmgpTemp['url'];
		$tmgAlt = $tmgpTemp['alt'];
	}

	$tmSubtitle = get_field('team_subtitle');
	if($tmSubtitle == '' || $tmSubtitle != NULL){
		$tmSubtitle = 'Our Team';
	}
?>

<div id="lrhmtmp" class="lrhmDCtners">
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


<?php if($tmTestmonials == 'yes'){ ?>

	<div id="trvwContainer" class="rvwContainers">

		<div class="rvwTxt">
			<?php echo $tmQuote;?>
			<div class="lftQuotes"><i class="icon-quotes-left"></i></div>
		</div>

	</div><!-- END OF HMTCONTAINER -->

<?php }?>

<div id="ltmTop">

	<div id="ltmMidphto">
		<div class="bgImage" style="background-image: url('<?php echo $tmgPhoto;?>');"></div>
		<img class="imageAbove" src="<?php echo $tmgPhoto;?>" alt="<?php echo $tmgAlt;?>" />
	</div>

	<h2 class="nghSecTitles"><?php echo $tmSubtitle;?></h2>

</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

<div id="tlContainer">
	
	<div class="lrhInnerwraps">

		<?php
			$i = 0;
			$k = 1;
			$teamList = array(array());

			$args = array('post_type' => 'teams', 'posts_per_page' => -1, 'orderby'=>'date', 'order'=>'DESC');

			$cats = get_categories($args);

			$list_of_posts = new WP_Query( $args );
			//sort($list_of_posts);
			while ( $list_of_posts->have_posts() ) :
				
				$list_of_posts->the_post();

				$teamList[$i]['postLink'] = get_post_permalink();

				$teamList[$i]['title'] = get_the_title();
				$teamList[$i]['jobTitle'] = get_field('team_position');
				$teamList[$i]['postAlt'] = $defaultAlt;
				$teamList[$i]['postImg'] = get_template_directory_uri().'/images/npstDefault.jpg';

				if(has_post_thumbnail()){
					$teamList[$i]['postImg'] = get_the_post_thumbnail_url();
					$thumbnail_id = get_post_thumbnail_id( $post->ID );
					$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
					if($teamList[$i]['postImg'] == ''){
						$teamList[$i]['postImg'] = get_template_directory_uri().'/images/npstDefault.jpg';
					}
				}

				$i++;

			endwhile;

			$total = $i;

			wp_reset_postdata();
		?>

		<div id="teamList" class="grid">
			
			<?php foreach($teamList as $member): ?>

				<div class="teamMbrs lrhnGalItems">
					<a href="<?php echo $member['postLink'];?>">
						<div class="lrmbrTop">
							<div class="bgImage" style="background-image: url('<?php echo $member['postImg'];?>');"></div>
							<!--<img class="placement" src="<?php echo get_template_directory_uri();?>/images/teamPlacement.png" alt="<?php echo $defaultAlt;?>" />-->
							<img class="imageAbove" src="<?php echo $member['postImg'];?>" alt="<?php echo $member['postAlt'];?>" />
						</div>
						<div class="lrmbrBtm">
							<span class="mbrName"><?php echo $member['title'];?></span>
							<hr class="mbrDivides" />
							<span class="mbrjTitle"><?php echo $member['jobTitle'];?></span>
						</div>
					</a>
				</div>

			<?php endforeach;?>

			<div class="teamMbrs sizer"></div>

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
			});

			$(window).resize(function(){
				shuffleInstance.update();
			});

		</script>

	</div>

</div>


<?php get_footer(); ?>
