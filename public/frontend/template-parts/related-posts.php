<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$flower_shop_elementor_post_args = array(
    'posts_per_page'    => 3,
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$flower_shop_elementor_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$flower_shop_elementor_terms_ids = array();
foreach( $flower_shop_elementor_tax_terms as $tax_term ) {
	$flower_shop_elementor_terms_ids[] = $tax_term->term_id;
}

$flower_shop_elementor_post_args['category__in'] = $flower_shop_elementor_terms_ids;

$flower_shop_elementor_related_posts = new WP_Query( $flower_shop_elementor_post_args );

if ( $flower_shop_elementor_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3><?php echo esc_html__('Related Post' ,'flower-shop-elementor' );?></h3>
        <div class="row">
            <?php while ( $flower_shop_elementor_related_posts->have_posts() ) : $flower_shop_elementor_related_posts->the_post(); ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                  <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4'); ?>>
                      <div class="box">
                        <div class="post-thumbnail">        
                            <?php if ( has_post_thumbnail() ) { ?>
                              <?php the_post_thumbnail(); ?>
                            <?php } else { ?>
                              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/post-dummy.png' ); ?>" alt="<?php esc_attr_e( 'Post Image', 'flower-shop-elementor' ); ?>">
                            <?php }?>
                        </div>
                        <div class="box-content">
                          <p class="slider-button mb-0">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','flower-shop-elementor'); ?><i class="fas fa-angle-right ms-2"></i></a>
                          </p>
                        </div>
                      </div>
                      <div class="post-content-box p-3">
                        <h3 class="post-title mb-2 mt-2"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-content">
                          <?php echo wp_trim_words( get_the_content(), '15'); ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();