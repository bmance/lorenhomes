<?php
/**
 * Template Name: Communities
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Loren Homes
 * @since 1.0
 */

get_header(); ?>

<?php
	$propAddrss = get_field('property_map_address','options');

	$blogName = get_bloginfo('name');
	$defaultAlt = $blogName;
	$pageTitle = get_the_title();

	$lrnStreet = get_field('street','options');
	$lrnCity = get_field('city','options');
	$lrnState = get_field('state','options');
	$lrnZip = get_field('zip_code','options');
?>

<div id="lrhmComtp" class="lrhmDCtners">
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


<div id="cmpContainer">
	
	<?php
		$i = 0;
		$k = 1;
		$neighList = array(array());
		$tempCatlist = array();
		$catSlug = array();
		$catList = array(array());

		$args = array('post_type' => 'neighborhoods', 'posts_per_page' => -1, 'orderby'=>'date', 'order'=>'DESC');

		$cats = get_categories($args);

		$list_of_posts = new WP_Query( $args );
		//sort($list_of_posts);
		while ( $list_of_posts->have_posts() ) :
			
			$list_of_posts->the_post();

			//
			$category = get_the_terms($post->ID, 'neighcategory');
			foreach($category as $cat){ //CREATES THE CATEGORY LIST FOR POST
				if(in_array($cat->name, $catList)) {
					continue;
				}else{
					$catList[$j] .= $cat->name;

					$catgList[$j]['catNames'] .= $cat->name;
					$catgList[$j]['catSlug'] .= $cat->slug;
					$j++;
				}
				$neighList[$i]['categories'] .= ''.$cat->slug;
				$neighList[$i]['categoryNames'] .= $cat->name.' ';
			}

			$neighList[$i]['tmrkList'] = '"all"';
			$neighList[$i]['trmList'] = '"all"';
			$neighList[$i]['tdList'] = 'all';
			//$portfolio[$i]['tmrkList'] = 'all';
			$neighList[$i]['termList'] = get_the_term_list( $post->ID, 'portcategory', 'People: ', ', ' );
			$termList = wp_get_object_terms( $post->ID,  'portcategory' );

			if ( ! empty( $termList ) ) {
			    if ( ! is_wp_error( $termList ) ) {	       
			    	foreach( $termList as $term ) {
			     		//$portfolio[$i]['tmrkList'] .= esc_html( $term->name );
			     		$neighList[$i]['tmrkList'] .= '"'.esc_html( $term->slug ).' "';
			     		$neighList[$i]['trmList'] .= ',"'.esc_html( $term->slug ).'"';
			     		$neighList[$i]['tdList'] .= ''.esc_html( $term->name ).' ';
			        }
			        echo '</ul>';
			    }
			}

			$neighList[$i]['postLink'] = get_post_permalink();

			if(have_rows('neighborhood_general')){
				while(have_rows('neighborhood_general')){
					the_row();
					
					$neighList[$i]['customAddrss'] = get_sub_field('display_custom_address');
					$neighList[$i]['street'] = get_sub_field('street_address');
					$neighList[$i]['city'] = get_sub_field('city');
					$neighList[$i]['state'] = get_sub_field('state');
					$neighList[$i]['zip'] = get_sub_field('zip_code');

					$neighList[$i]['iltxt'] = get_sub_field('map_infobox_link_text');
					if($neighList[$i]['iltxt'] == '' || $neighList[$i]['iltxt'] == NULL){
						$neighList[$i]['iltxt'] = 'Visit Neighborhood';
					}
					$neighList[$i]['lat'] = get_sub_field('neighborhood_map')['lat'];
					$neighList[$i]['lng'] = get_sub_field('neighborhood_map')['lng'];
					$neighList[$i]['address'] = get_sub_field('neighborhood_map')['address'];
					

					$neighList[$i]['strtprice'] = get_sub_field('starting_price_point_text');
					
				}
			}

			$neighList[$i]['title'] = get_the_title();
			$neighList[$i]['postAlt'] = get_bloginfo('name');
			$neighList[$i]['postImg'] = get_template_directory_uri().'/images/npstDefault.jpg';

			if(has_post_thumbnail()){
				$neighList[$i]['postImg'] = get_the_post_thumbnail_url();
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
				if($neighList[$i]['postImg'] == ''){
					$neighList[$i]['postImg'] = get_template_directory_uri().'/images/npstDefault.jpg';
				}
			}

			$i++;

		endwhile;

		$total = $i;

		wp_reset_postdata();
	?>

	<div class="rel">

		<div class="mapContainer" style="width: 100%; height: 100%;">

			<div id="markers" style="display:none;">

				<?php if($propAddrss){ ?>
					<div class="marker Home" data-lat="<?php echo $propAddrss['lat'];?>" data-lng="<?php echo $propAddrss['lng'];?>">

						<span class="mrkTitle"><?php echo $blogName;?></span>
						<div id="mpAddress">
							<span class="mrkStreet mrkAdrsecs"><?php echo $lrnStreet;?></span>
							<span class="mrkCity mrkAdrsecs"><?php echo $lrnCity;?><?php if($lrnCity != '' && $lrnState != ''){ echo ', '; }?></span>
							<span class="mrkState mrkAdrsecs"><?php echo $lrnState.' ';?></span>
							<span class="mrkZip mrkAdrsecs"><?php echo $lrnZip;?></span>
						</div>
					</div>
				<?php }?>

				<?php foreach($neighList as $neighborhood){ ?>
					<div class="marker <?php echo $neighborhood['tmrkList'];?>" data-lat="<?php echo $neighborhood['lat'];?>" data-lng="<?php echo $neighborhood['lng'];?>">
						<div class="mrkThumbs">
							<img src="<?php echo $neighborhood['postImg'];?>" alt="<?php echo $neighborhood['postAlt'];?>" />
						</div>
						<span class="mrkTitle"><?php echo $neighborhood['title'];?></span>
						<div id="mpAddress">
							<?php
								if($neighborhood['customAddrss']){
									echo '<span class="mrkStreet mrkAdrsecs">'.$neighborhood['street'].'</span>';
									echo '<span class="mrkCity mrkAdrsecs">'.$neighborhood['city'].'</span>';
									if($neighborhood['state'] != '' && $neighborhood['city'] != ''){
										echo '<span>, </span>';
									}
									echo '<span class="mrkState mrkAdrsecs">'.$neighborhood['state'].' </span>';
									echo '<span class="mrkZip mrkAdrsecs">'.$neighborhood['zip'].'</span>';
								}else{
									echo $neighborhood['address'];
								}
							?>
						</div>
						<a class="mrkLinks" href="<?php echo $neighborhood['postLink'];?>" target="_blank">
							<?php echo $neighborhood['iltxt'];?>
						</a>
					</div>
				<?php }?>

			</div>

		</div>

		<!-- THE GOOGLE API MAP JS FILES HAS BEEN MOVED TO THE HEADER.PHP -->
		<script type="text/javascript">
			/*
			*  render_map
			*
			*  This function will render a Google Map onto the selected jQuery element
			*
			*  @type	function
			*  @date	8/11/2013
			*  @since	4.3.0
			*
			*  @param	$el (jQuery element)
			*  @return	n/a
			*/
			var markers = [];
			var winWidth;
			var infoWindows = [];
			var map = {};
			var infoWindows = [];
			var markerHome = '<?php echo get_template_directory_uri(); ?>/images/markerHome.png';
			var markerDefault = '<?php echo get_template_directory_uri(); ?>/images/markerOther.png';

			var infowindow;

			// THE COLOR AND STYLE FOR THE MAP

			var styles = [
			  { "elementType": "geometry", "stylers": [ { "color": "#f5f5f5" } ] }, { "elementType": "geometry.fill", "stylers": [ { "color": "#a4bcc2" }, { "saturation": -5 }, { "lightness": 65 } ] }, { "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "elementType": "labels.text.fill", "stylers": [ { "lightness": -5 } ] }, { "elementType": "labels.text.stroke", "stylers": [ { "color": "#f5f5f5" } ] }, { "featureType": "administrative", "elementType": "geometry", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [ { "color": "#bdbdbd" } ] }, { "featureType": "poi", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "road", "elementType": "geometry", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#dadada" } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "lightness": -15 } ] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [ { "color": "#616161" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "transit", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#c9c9c9" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }
			];

			function render_map( $el, cat) {
				var styledMap = new google.maps.StyledMapType(styles,
			    	{name: "<? echo get_bloginfo( 'name' ); ?>"}
			    );

				var $markers;

			 	if(cat){
					$markers = $('#markers').find('.' + cat);
			 	} else {
			 		$markers = $el.find('.marker');
			 		//console.log('no category. $markers: '+$markers);
			 	}


				// vars
				var args = {
					zoom		: 8,
					maxZoom     : 9,
					center		: new google.maps.LatLng(0, 0),
					mapTypeId	: google.maps.MapTypeId.ROADMAP,
					scrollwheel : false
				};

				// create map
				map = new google.maps.Map( $el[0], args);

				//Associate the styled map with the MapTypeId and set it to display.
				map.mapTypes.set('map_style', styledMap);
				map.setMapTypeId('map_style');

				// add a markers reference
				markers = [];

				// add markers
				var i = 0;
				$markers.each(function(){

			    	add_marker( $(this), map, i );
			    	i++;
				});

				// center map
				center_map( map );
				google.maps.event.addDomListener(window, 'resize', function() {
					center_map( map );
				});
			}

			/*
			*  add_marker
			*
			*  This function will add a marker to the selected Google Map
			*
			*  @type	function
			*  @date	8/11/2013
			*  @since	4.3.0
			*
			*  @param	$marker (jQuery element)
			*  @param	map (Google Map object)
			*  @return	n/a
			*/

			function add_marker( $marker, map, ind ) {

				// var
				var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

				// create marker
				if($marker.hasClass('Home')){

					var marker = new google.maps.Marker({
					       position: latlng,
					       map: map,
					       icon: markerHome,
					       draggable: false,
					       raiseOnDrag: false,
					       labelAnchor: new google.maps.Point(6, 41),
					       labelClass: "labels", // the CSS class for the label
					       labelInBackground: false
					});

				} else {

					var marker = new google.maps.Marker({
					       position: latlng,
					       map: map,
					       icon: markerDefault,
					       draggable: false,
					       raiseOnDrag: false,
					       labelAnchor: new google.maps.Point(6, 41),
					       labelClass: "labels", // the CSS class for the label
					       labelInBackground: false
					});
				}

				// add to array
				markers.push( marker );

				// if marker contains HTML, add it to an infoWindow
				if( $marker.html() )
				{

					// create info window
					var infowindow = new google.maps.InfoWindow({
						//content		: $marker.html(),
						content     : '<div class="infoWindow">'+$marker.html()+'</div>',
						backgroundColor: 'rgba(0,0,0,1)',
						backgroundClassName: 'infoWindow',
						height		: 400
					});

			 		infoWindows.push(infowindow);

					// show info window when marker is clicked
					google.maps.event.addListener(marker, 'click', function() {

						closeMarkers();

						infowindow.open( map, marker );

					});

					//Select the view link
					extLink = $('.mapView').eq(ind);

					// show info window when map view link is clicked
					extLink.click(function(){

						closeMarkers();

						scrollUp( $('.mapContainer'), function(){
							infowindow.open(map, marker);
						});

						return false;

					});


				}

			}


			function myClick(id){
			    google.maps.event.trigger(markers[id], 'click');
			}

			// *  center_map
			// *
			// *  This function will center the map, showing all markers attached to this map
			// *
			// *  @type	function
			// *  @date	8/11/2013
			// *  @since	4.3.0
			// *
			// *  @param	map (Google Map object)
			// *  @return	n/a


			function center_map( map ) {

				// vars
				var bounds = new google.maps.LatLngBounds();

				// loop through all markers and create bounds
				$.each( markers, function( i, marker ){

					var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

					bounds.extend( latlng );

				});

				// only 1 marker?
				if( markers.length == 1 )
				{
					// set center of map
				    map.setCenter( bounds.getCenter() );
				    map.setZoom( 16 );
				}
				else
				{
					// fit to bounds

					map.fitBounds( bounds );
					//map.setZoom( 16 );
				}

			}

			//Clears markers from the map
			function clearOverlays() {

			  for (var i = 0; i < markers.length; i++ )
			  {
			    markers[i].setMap(null);
			  }

			  markers.length = 0;

			}

			function closeMarkers() {
				for(var i = 0; i < infoWindows.length; i++){
				    infoWindows[i].close();
				}
			}

			/*
			*  document ready
			*
			*  This function will render each map when the document is ready (page has loaded)
			*
			*  @type	function
			*  @date	8/11/2013
			*  @since	5.0.0
			*
			*  @param	n/a
			*  @return	n/a
			*/

			$(document).ready(function(){

				winWidth = $(window).width();
				$('.mapContainer').each(function(){

					render_map( $(this) );

				});

			});

			$(window).on('load', function(){

			});

			$(window).resize(function(){

				winWidth = $(window).width();

			});

		</script>

	</div>

</div><!-- END OF CMPCONTAINER -->


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

<div id="lrnghWrapper">

	<div class="lrhInnerwraps">

		<div id="lrhmNeighbrs" class="grid">

			<?php foreach($neighList as $neighborhood){ ?>

			<div id="neighItem<?php echo $k;?>" class="shufItems neighItems" data-groups='[<?php echo $neighborhood['trmList'];?>]'>
				<div class="rel">
					<div class="nghImgs">
						<a href="<?php echo $neighborhood['postLink'];?>">
							<div class="bgImage" style="background-image:url('<?php echo $neighborhood['postImg'];?>');"></div>
							<img class="placement" src="<?php echo get_template_directory_uri();?>/images/nghPlacement.jpg" alt="<?php echo $blogName;?>" />
							<img class="imageAbove" src="<?php echo $neighborhood['postImg'];?>" alt="<?php echo $neighborhood['postAlt'];?>"/>
						</a>
					</div>
					<div class="nghInfos">
						<span class="nghTitle"><?php echo $neighborhood['title'];?></span>
						<span class="nghPrices">
							<?php echo $neighborhood['strtprice'];?>
						</span>
						<a class="nghLinks" href="<?php echo $neighborhood['postLink'];?>">See More</a>
					</div>
				</div>
			</div>

			<?php
					$k++; 
				}
			?>

			<div class="shufItems sizer"></div>

		</div><!-- END OF LRHMNEIGHBRS -->

	</div>

</div><!-- END OF LRNGHWRAPPER -->

<script type="text/javascript">
	
	var Shuffle = window.Shuffle;
	var element = document.querySelector('.grid');
	var sizer = element.querySelector('.sizer');
	var winWidth = $(window).width();
	var winHeight = $(window).height();

	var shuffleInstance = new Shuffle(element, {
	  itemSelector: '.neighItems',
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

<?php get_footer(); ?>
