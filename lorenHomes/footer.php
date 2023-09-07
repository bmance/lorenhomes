<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			</main>

			<footer id="lrnFooter" role="contentinfo">

				<?php
					$curYear = date('Y');
					$blogName = get_bloginfo('name');
					$defaultAlt = $blogName;
					$flAlt = $defaultAlt;
					//$footerLogo = get_template_directory_uri().'/images/fuqua-logo-white.png';
					$tempLogo = get_field('footer_logo','options');

					if($tempLogo != '' && $tempLogo != NULL){
						$footerLogo = $tempLogo['url'];
						$flAlt = $tempLogo['alt'];
					}
				?>

				<div id="footerTop">

					<div id="ftpWrapper">

						<div id="ftMidmble" class="ftCols">
							
							<div class="rel">

								<?php
									$ftlogo = get_field('footer_mid_logo','options');
									$ftlogo = $ftlogo['url'];
									if($ftlogo == '' || $ftlogo == NULL){
										$ftlogo = get_template_directory_uri().'/images/lrnhm_footer.png';
									}

									$ftlglink = get_field('footer_mid_logo_link','options');
									if($ftlglink == '' || $ftlglink == NULL){
										$ftlglink = get_home_url();
									}

									$ftCntctxt = get_field('footer_contact_button_text','options');
									if($ftCntctxt == '' || $ftCntctxt == NULL){
										$ftCntctxt = 'Contact Us';
									}

									$ftCntctlk = get_field('footer_contact_button_link','options');
									if($ftCntctlk == '' || $ftCntctlk == NULL){
										$ftCntctlk = '/contact';
									}

									$ftPhone = get_field('phone_number','options');
									$ftStreet = get_field('street','options');
									$ftCity = get_field('city','options');
									$ftState = get_field('state','options');
									$ftZip = get_field('zip_code','options');
								?>

								<a id="ftLogo" href="<?php echo $ftlglink;?>">
									<img src="<?php echo $ftlogo;?>" alt="" />
								</a>

								<?php if(have_rows('social_media','options')){ ?>

									<div id="ftsContainer">
										
										<?php 
											while(have_rows('social_media','options')){
												the_row();
												$smLink = get_sub_field('social_link','options');
												$smIcon = get_sub_field('image','options');
												$smAlt = $smIcon['alt'];
												$smIcon = $smIcon['url'];
												$smType = get_sub_field('social_type','options');
										?>

										<span class="ftsIcons">

											<?php if($smLink != '' && $smLink != NULL){?>
												<a href="<?php echo $smLink;?>" target="_blank">
											<?php }?>


												<?php if($smIcon != '' && $smIcon != NULL){?>
													<img src="<?php echo $smIcon;?>" alt="<?php echo $smAlt;?>" />
												<?php }else{?>
													<i class="icon-<?php echo $smType;?>"></i>
												<?php }?>



											<?php if($smLink != '' && $smLink != NULL){?>
												</a>
											<?php }?>

										</span>

										<?php
											} 
										?>

									</div><!-- END OF FTSCONTAINER -->

								<?php }?>

								<div id="ftmInfo">
									
									<?php if($ftStreet != ''){?>
									<div class="infoSec"><?php echo $ftStreet;?></div>
									<?php }?>

									<?php if($ftCity != '' || $ftState != '' || $ftZip != ''){?>
									<div class="infoSec">
										<span><?php echo $ftCity;?> <span>
										<?php if($ftCity != '' && $ftState != ''){?>
										<span>, </span>
										<?php }?>	
										<span><?php echo $ftState;?> <span>	
										<span><?php echo $ftZip;?><span>		
									</div>
									<?php }?>

									<?php if($ftPhone != ''){?>
									<div class="infoSec">
										<a href="tel:<?php echo $ftPhone;?>"><?php echo $ftPhone;?></a>
									</div>
									<?php }?>

									<div class="infoSec">
										<a id="infCntbtn" href="<?php echo $ftCntctlk;?>"><?php echo $ftCntctxt;?></a>
									</div>

								</div><!-- END OF FTMINFO -->

							</div>

						</div><!-- END OF FTMIDMBLE -->

						<div id="ftLeft" class="ftCols">
							
							<div class="rel">
								
								<?php if(have_rows('footer_logos_left','options')){ ?>

									<?php 
										while(have_rows('footer_logos_left','options')):
											the_row();
											$cltLogo = get_sub_field('footer_client_logo','options');
											$cltAlt = $cltLogo['alt'];
											$cltLogo = $cltLogo['url'];
											$cltLink = get_sub_field('footer_client_link','options');
									?>

									 <span class="ftcLogos">
										<?php if($cltLink != '' && $cltLink != NULL){ ?>
											<a href="<?php echo $cltLink;?>" target="_blank">
										<?php }?>
										<img src="<?php echo $cltLogo;?>" alt="<?php echo $cltAlt;?>" />
										<?php if($cltLink != '' && $cltLink != NULL){ ?>
											</a>
										<?php }?>
									</span>

									<?php
										endwhile; 
									?>

								<?php }?>

							</div>

						</div><!-- END OF FTLEFT -->

						<div id="ftMid" class="ftCols">

							<div class="rel">

								<?php
									$ftlogo = get_field('footer_mid_logo','options');
									$ftlogo = $ftlogo['url'];
									if($ftlogo == '' || $ftlogo == NULL){
										$ftlogo = get_template_directory_uri().'/images/lrnhm_footer.png';
									}

									$ftlglink = get_field('footer_mid_logo_link','options');
									if($ftlglink == '' || $ftlglink == NULL){
										$ftlglink = get_home_url();
									}

									$ftCntctxt = get_field('footer_contact_button_text','options');
									if($ftCntctxt == '' || $ftCntctxt == NULL){
										$ftCntctxt = 'Contact Us';
									}

									$ftCntctlk = get_field('footer_contact_button_link','options');
									if($ftCntctlk == '' || $ftCntctlk == NULL){
										$ftCntctlk = '/contact';
									}

									$ftPhone = get_field('phone_number','options');
									$ftStreet = get_field('street','options');
									$ftCity = get_field('city','options');
									$ftState = get_field('state','options');
									$ftZip = get_field('zip_code','options');

									if($ftCity != '' && $ftState != ''){
										$ftCity .= ', ';
									}
								?>

								<a id="ftLogo" href="<?php echo $ftlglink;?>">
									<img src="<?php echo $ftlogo;?>" alt="" />
								</a>

								<?php if(have_rows('social_media','options')){ ?>

									<div id="ftsContainer">
										
										<?php 
											while(have_rows('social_media','options')){
												the_row();
												$smLink = get_sub_field('social_link','options');
												$smIcon = get_sub_field('image','options');
												$smAlt = $smIcon['alt'];
												$smIcon = $smIcon['url'];
												$smType = get_sub_field('social_type','options');
										?>

										<span class="ftsIcons">

											<?php if($smLink != '' && $smLink != NULL){?>
												<a href="<?php echo $smLink;?>" target="_blank">
											<?php }?>


												<?php if($smIcon != '' && $smIcon != NULL){?>
													<img src="<?php echo $smIcon;?>" alt="<?php echo $smAlt;?>" />
												<?php }else{?>
													<i class="icon-<?php echo $smType;?>"></i>
												<?php }?>



											<?php if($smLink != '' && $smLink != NULL){?>
												</a>
											<?php }?>

										</span>

										<?php
											} 
										?>

									</div><!-- END OF FTSCONTAINER -->

								<?php }?>

								<div id="ftmInfo">
									
									<?php if($ftStreet != '' && $ftCity != '' && $ftState != '' && $ftZip != ''){ ?>
										<a href="https://www.google.com/maps/dir//<?php echo $ftStreet; ?>,+<?php echo $ftCity; ?>,+<?php echo $ftState; ?>+<?php echo $ftZip; ?>/" target="_blank" title="Loren Homes is located Here!">
									<?php }?>

										<?php if($ftStreet != ''){?>
										<div class="infoSec"><?php echo $ftStreet;?></div>
										<?php }?>

										<?php if($ftCity != '' || $ftState != '' || $ftZip != ''){?>
										<div class="infoSec">
											<span><?php echo $ftCity;?><span>
											<?php if($ftCity != '' && $ftState != ''){?>
											<!--<span>, </span>-->
											<?php }?>	
											<span><?php echo $ftState;?> <span>	
											<span><?php echo $ftZip;?><span>		
										</div>
										<?php }?>

									<?php if($ftStreet != '' && $ftCity != '' && $ftState != '' && $ftZip != ''){ ?>
										</a>
									<?php }?>

									<?php if($ftPhone != ''){?>
									<div class="infoSec">
										<a href="tel:<?php echo $ftPhone;?>"><?php echo $ftPhone;?></a>
									</div>
									<?php }?>

									<div class="infoSec">
										<a href="<?php echo $ftCntctlk;?>"><?php echo $ftCntctxt;?></a>
									</div>

								</div><!-- END OF FTMINFO -->

							</div>

						</div><!-- END OF FTMID -->

						<div id="ftRght" class="ftCols">
							
							<div class="rel">
								
								<?php if(have_rows('footer_logos_right','options')){ ?>

									<?php 
										while(have_rows('footer_logos_right','options')):
											the_row();
											$cltLogo = get_sub_field('footer_client_logo','options');
											$cltAlt = $cltLogo['alt'];
											$cltLogo = $cltLogo['url'];
											$cltLink = get_sub_field('footer_client_link','options');
									?>

									 <span class="ftcLogos">
										<?php if($cltLink != '' && $cltLink != NULL){ ?>
											<a href="<?php echo $cltLink;?>" target="_blank">
										<?php }?>
										<img src="<?php echo $cltLogo;?>" alt="<?php echo $cltAlt;?>" />
										<?php if($cltLink != '' && $cltLink != NULL){ ?>
											</a>
										<?php }?>
									</span>

									<?php
										endwhile; 
									?>

								<?php }?>

							</div>

						</div><!-- END OF FTRGHT -->

						<div class="clear"></div>

						<div id="ftTopbtm">
							<div id="tpbLeft" class="tpbSecs">
								<div class="rel"></div>
							</div>
							<div id="tpbRght" class="tpbSecs">
								<div class="rel">
									<i class="icon-equal-housing-opportunity-logo-svg-vector"></i>
								</div>
							</div>
							<div class="clear"></div>
						</div><!-- END OF FTTOPBTM -->

					</div><!-- END OF FTPWRAPPER -->

				</div><!-- END OF FOOTERTOP -->

				<div id="footerBtm">

					<div id="fbTop" class="fbSecs">
						<span>&copy;<?php echo $curYear;?></span>
						<span><?php echo ' '.$blogName.'. ';?></span>
						<span>All Rights Reserved.</span>
						<span>Website By <a href="https://clementinecreativeagency.com/" target="_blank">Clementine Creative Agency</a></span>
					</div>

					<div id="fbBttm" class="fbSecs">
						<?php
							$termsType = get_field('terms_type','options');
							if($termsType == 'link'){
								echo '<a data-fancybox data-type="iframe" data-src="'.get_field('terms_link','options').'" href="javascript:;">';
							}else{
								echo '<div id="terms" class="policyTerms">'.get_field('terms_text','options').'</div>';
								echo '<a data-fancybox data-src="#terms" href="javascript:;">';
							}
						?>
							Terms Of Use
						</a>

						<span class="fDividers">|</span>

						<?php
							$privacyType = get_field('privacy_type','options');
							if($privacyType == 'link'){
								$privacyLink = get_field('privacy_link','options');
								echo '<a data-fancybox data-type="iframe" data-src="'.$privacyLink.'" href="javascript:;">';
							}else{
								$privacyText = get_field('privacy_text','options');
								echo '<div id="privacyPolicy" class="policyTerms">'.$privacyText.'</div>';
								echo '<a data-fancybox data-src="#privacyPolicy" href="javascript:;">';
							}
						?>
							Privacy Policy
						</a>

					</div>

				</div><!-- END OF FOOTERBTM -->

			</footer><!-- END OF LRNFOOTER -->

			<?php if(get_field('custom_footer_code','options')){?>
			
				<!-- CUSTOM FOOTER CODE -->
				<?php echo '<div class="invisiContainer">'.get_field('custom_footer_code','options').'</div>';?>
			
			<?php }?>

		<?php wp_footer(); ?>

	</body>

	<script type="text/javascript">
		
		$(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
			imageDefer();
			backgroundDefer();
		});

		$('[data-fancybox="gallery"]').fancybox({
			protect: true,
		});

		function backgroundDefer() {
			var totalBgImage = $(".bgImage").length;
		    for (var i = 0; i < totalBgImage; i++) {
				if($(".bgImage").eq(i).attr('data-src')) {
		        	$(".bgImage").eq(i).css('background-image',  "url('"+$(".bgImage").eq(i).attr('data-src')+"')");
				}
		    }
		}

		function imageDefer() {
		    var imgDefer = document.getElementsByTagName('img');
		    for (var i=0; i<imgDefer.length; i++) {
		        if(imgDefer[i].getAttribute('data-src')) {
		            imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
		        }

				// ADDS THE BLOG NAME BY DEFAULT TO ALL THE IMAGE ALT TAG
				var altstring = '<?php echo get_bloginfo('name'); ?> ' + imgDefer[i].getAttribute('alt');
				imgDefer[i].setAttribute('alt', altstring);
		    }
		}

	</script>

</html>
