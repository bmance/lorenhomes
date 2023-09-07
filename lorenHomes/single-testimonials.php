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
	$tstName = get_the_title();
	$tstClient = '-'.get_field('testimonial_client_name');
	$tstText = get_field('testimonial_text2');

	$univtstlnk = get_field('universal_testimonial_page_link','options');
	if($univtstlnk == '' || $univtstlnk == NULL){
		$univtstlnk = get_homeurl();
	}

	$univtstTxt = get_field('universal_testimonial_page_link_text','options');
	if($univtstTxt == '' || $univtstTxt == NULL){
		$univtstTxt = 'Back to Home';
	}

	$i = 0;
	$catgList = array(array());
	$category = get_the_terms($post->ID, 'neighcategory');
	$category2 = get_the_terms($post->ID, 'testcategory');
	$terms_string = join(', ', wp_list_pluck($category, 'name'));

	foreach($category as $cat){ //CREATES THE CATEGORY LIST FOR POST
		if(in_array($cat->name, $catList)) {
			continue;
		}else{
			$catList[$i] .= $cat->name;

			$catgList[$i]['catNames'] .= $cat->name;
			$catgList[$i]['catSlug'] .= $cat->slug;
			$j++;
		}
		$i++;
	}
?>

<div class="lrntstWrappers">
	
	<h1><?php echo $tstName;?></h1>

	<div class="tstCategories">
		<span class="tsmcMain">Neighborhood Categories:</span>
		<span><?php echo $terms_string; ?></span>
		<?php //foreach ($catgList as $category){ ?>
			<!--<span><?php echo $category['catNames'].' ';?></span>-->
		<?php //}?>
	</div>

	<div class="tstmonTxt">
		<?php echo $tstText;?>

		<span class="tstmonClients">
			<?php echo $tstClient;?>		
		</span>
	</div>
	

</div>

<div class="sngUniContainer">
		
	<a class="sngUnibtns" href="<?php echo $univtstlnk;?>">
		<?php echo $univtstTxt;?>
	</a>

</div>

<?php get_footer(); ?>
