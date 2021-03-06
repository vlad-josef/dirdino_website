<?php
/*
Template Name: provans-item
*/
?>

<?php 
	get_header(); 
?>

	<body class="landing">

		<?php 
			require('_navigation.php'); 
		?>



	<script type="text/javascript">		
		var provansColors = {
			array: [
				<?php 
					if( have_rows('provitem_repeater') ):
						while ( have_rows('provitem_repeater') ) : the_row();
				?>
						{
							hex: "<?php the_sub_field('provitem_rep_color') ?>",
							pic1: "<?php the_sub_field('provitem_rep_pic1') ?>",
							pic2: "<?php the_sub_field('provitem_rep_pic2') ?>",
							pic3: "<?php the_sub_field('provitem_rep_pic3') ?>",
							pic4: "<?php the_sub_field('provitem_rep_pic4') ?>"
						},
				<?php
						endwhile;
					endif;
				?>
			]
		}
	</script>



	<!-- Main -->
			<section id="main">
				<div class="container">
					<header class="major">
						<h2><?php the_title(); ?></h2>
					</header>



					<?php 
						$rows = get_field('provitem_repeater' ); 
						$first_row = $rows[0];
						$pic1 = $first_row['provitem_rep_pic1' ]; 
						$pic2 = $first_row['provitem_rep_pic2' ];  
						$pic3 = $first_row['provitem_rep_pic3' ];
						$pic4 = $first_row['provitem_rep_pic4' ];  
					?>



					<div class="row uniform 200%">
						
						<div id="provans_item_left_block" class="6u 8u(medium) -2u(medium) 12u$(small)">
							<div class="provans__item-mainblock -inside provanscolorpic -pic1" 
							style="background-image: url('<?php echo $pic1 ?>');">
								
							</div>
						</div>

						<div id="provans_item_right_block" class="6u 12u$(medium)">
							<h4 class="provans__item-title">Артикул: <?php the_field('provitem_articul'); ?></h4>
							<h4 class="provans__item-title -price">Цена: <span><?php the_field('provitem_price'); ?>$</span></h4>
							<h4 class="provans__item-title">
								Габаритные размеры: 
								<span>

									<?php 
										if( strlen(the_field('provitem_gabarity')) == 0 ) {
											echo '<u>не указано</u>';
										} 
										else {
											the_field('provitem_gabarity');
										}
									?>
								</span>
							</h4>
							<div class="provans__item-colorwrap">
								<h4 class="provans__item-title">Возможные цвета:</h4>

								<?php 
									$counterColors = 0;
									if( have_rows('provitem_repeater') ):
										while ( have_rows('provitem_repeater') ) : the_row();
								?>

										<div class="provans__item-color" 
											data-colorid="<?php echo $counterColors ?>" 
											style="background-color: <?php the_sub_field('provitem_rep_color') ?>"></div>

								<?php
										$counterColors++;
										endwhile;
									endif;
								?>

							</div>

							
							<div class="row 50% provans__item-rakurswrap">

								<div class="4u">
									<div class="provans__item-rakurs provanscolorpic -pic2" 
									     style="background-image: url('<?php echo $pic2 ?>');">
									</div>
								</div>

						
								<?php if( strlen($pic3) > 0 ) { ?>
									<div class="4u">
										<div class="provans__item-rakurs provanscolorpic -pic3" 
										     style="background-image: url('<?php echo $pic3 ?>');">
										</div>
									</div>
								<?php  } ?>


								<?php if( strlen($pic4) > 0 ) { ?>
									<div class="4u">
										<div class="provans__item-rakurs provanscolorpic -pic4" 
										     style="background-image: url('<?php echo $pic4 ?>');">
										</div>
									</div>

								<?php } ?>
							</div>
						</div>

					</div>


<?php 



$posts = get_field('provans_related');

if( $posts ): ?>


<div class="row provans__interest">
	<h3>Также вас могут заинтересовать:</h3>
</div>

<div>
    <div class="row 75%">
    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="3u 6u(small) 12u$(xsmall)">


            <!-- <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> -->
            
			<?php 
				$rows = get_field('provitem_repeater' ); 
				$first_row = $rows[0];
				$pic1 = $first_row['provitem_rep_pic1' ];

				if( strlen(get_field('provans_subcategorypic')) > 0 ) {
					$rel_pic = get_field('provans_subcategorypic');
				}
				else {
					$rel_pic = $pic1;
				}

				$original_title = get_the_title();
				$rel_title = substr($original_title, 32);
			?>
		
			

			<div class="provans__block -category -small -top" 
			     style="background-image: url('<?php echo $rel_pic ?>');">
				
				<h4 class="provans__block-title -small -related">
					<a href="<?php the_permalink(); ?>">
						<?php echo $rel_title ?>
					</a>
				</h4>

			</div>




        </div>
    <?php endforeach; ?>
    </div>
  </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>


			</section>
	
	<script type="text/javascript">
		

		jQuery(document).ready(function($) {
			setTimeout(function() {
				provansItemSetHeight();
			}, 1000)
		});


		jQuery(window).resize(function() {
			provansItemSetHeight();
		}); 


		function provansItemSetHeight() {
			var provansitemRightBlock = jQuery('#provans_item_right_block').height();
			
			if( jQuery(window).width() > 736 ) {
				jQuery('#provans_item_left_block').height(provansitemRightBlock);
				jQuery('.provans__item-mainblock.-inside').height(provansitemRightBlock);
			}
			else {
				jQuery('#provans_item_left_block').css('height', '');
				jQuery('.provans__item-mainblock.-inside').css('height', '');	
			}
		}


	</script>

	<?php get_footer(); ?>
