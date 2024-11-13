<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section class="top-slider">
    <div class="row m-0">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-md-0">
         <?php
            $viral_news_center_postdata = get_theme_mod('viral_news_center_static_blog_1');
              if($viral_news_center_postdata){
              $viral_news_center_args = array( 'p' => esc_html( $viral_news_center_postdata ,'viral-news-center'));
            $viral_news_center_query = new WP_Query( $viral_news_center_args );
            if ( $viral_news_center_query->have_posts() ) :
              while ( $viral_news_center_query->have_posts() ) : $viral_news_center_query->the_post(); ?>
                 <div class="box-slider mb-3">
                  <?php if(has_post_thumbnail()){?>
                    <div class="box-image">
                      <?php the_post_thumbnail();?>
                    </div>
                    <?php } else{?>
                    <div class="box-image">
                      <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/slider-post.png" alt="" />
                    </div>
                  <?php } ?>
                    <div class="slider-content">
                      <div class="slide-cat mb-3">
                        <!-- <span><?php the_category() ?></span> -->
                      </div>
                      <h4 class="m-0"><?php the_title(); ?></h4>
                      <a href="<?php echo esc_url( get_day_link( $magazine_express_year, $magazine_express_month, $magazine_express_day)); ?>" class="slide-date"><i class="far fa-calendar-alt me-2"></i><?php echo esc_html( get_the_date() ); ?></a>
                      <?php if( get_theme_mod('magazine_express_slider_button_text','READ MORE') != ''){ ?>
                        <div class="slide-btn my-3"><a href="<?php the_permalink(); ?>"><?php esc_html_e(get_theme_mod('viral_news_center_slider_button_text','READ MORE')); ?></a></div>
                      <?php }?>
                    </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();?>
              <?php else : ?>
                <div class="no-postfound"></div>
              <?php
          endif; }?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
         <div class="row">
          <?php
          $viral_news_center_slider_cat = get_theme_mod('viral_news_center_slider_category','');
          $viral_news_center_slider_per_page = 4 ;
          if($viral_news_center_slider_cat){
            $viral_news_center_page_query5 = new WP_Query(array( 'category_name' => esc_html($viral_news_center_slider_cat,'viral-news-center'),'posts_per_page' => esc_attr( $viral_news_center_slider_per_page )));
            $viral_news_center_i=1;
            while( $viral_news_center_page_query5->have_posts() ) : $viral_news_center_page_query5->the_post(); ?>
                <div class="col-lg-6 col-md-6 col-sm-6 pe-md-0">
                <div class="box-slider mb-3">
                  <?php if(has_post_thumbnail()){?>
                    <div class="box-imagess">
                      <?php the_post_thumbnail();?>
                    </div>
                    <?php } else{?>
                    <div class="box-imagess">
                      <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/slider-category.png" alt="" />
                    </div>
                  <?php } ?>
                  <div class="slider-box">
                    <h4 class="mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  </div>
                </div>
              </div>
            <?php $viral_news_center_i++; endwhile;
          wp_reset_postdata();
        } ?>
      </div>
      </div>
    </div>
  </section>

  <section id="news" class="py-5">
    <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <h3 class="mb-3"><?php echo esc_html(get_theme_mod('viral_news_center_news_title_1','')); ?></h3>
        <?php
          $viral_news_center_news_cat = get_theme_mod('viral_news_center_news_category','');
          $viral_news_center_news_per_page = 3 ;
          if($viral_news_center_news_cat){
            $viral_news_center_news_page_query5 = new WP_Query(array( 'category_name' => esc_html($viral_news_center_news_cat,'viral-news-center'),'posts_per_page' => esc_attr( $viral_news_center_news_per_page )));
            $viral_news_center_news_i=1;
            while( $viral_news_center_news_page_query5->have_posts() ) : $viral_news_center_news_page_query5->the_post(); ?>
              <div class="news-category mb-3">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 pe-md-0 align-self-center">
                    <?php if(has_post_thumbnail()){?>
                      <div class="news-imagess">
                        <?php the_post_thumbnail();?>
                      </div>
                    <?php } else{?>
                      <div class="news-imagess">
                        <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/latest-news-1.png" alt="" />
                      </div>
                    <?php } ?>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8 ps-md-0 align-self-center">
                    <div class="news-box">
                      <i class="fas fa-clock"></i><span><?php echo get_the_date('j F Y'); ?></span>
                      <h4 class="m-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                  </div>
                </div>
              </div>
            <?php $viral_news_center_news_i++; endwhile;
          wp_reset_postdata();
        } ?>
        
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <h3 class="mb-3"><?php echo esc_html(get_theme_mod('viral_news_center_news_title_2','')); ?></h3>
        <?php
          $viral_news_center_news_tab1_cat = get_theme_mod('viral_news_center_news_category_1','');
          $viral_news_center_news_per_tab1_page = 3 ;
          if($viral_news_center_news_tab1_cat){
            $viral_news_center_news_page_tab1_query5 = new WP_Query(array( 'category_name' => esc_html($viral_news_center_news_tab1_cat,'viral-news-center'),'posts_per_page' => esc_attr( $viral_news_center_news_per_tab1_page )));
            $viral_news_center_news_i=1;
            while( $viral_news_center_news_page_tab1_query5->have_posts() ) : $viral_news_center_news_page_tab1_query5->the_post(); ?>
              <div class="news-category mb-3">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 pe-md-0 align-self-center">
                    <?php if(has_post_thumbnail()){?>
                      <div class="news-imagess">
                        <?php the_post_thumbnail();?>
                      </div>
                    <?php } else{?>
                      <div class="news-imagess">
                        <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/latest-news-2.png" alt="" />
                      </div>
                    <?php } ?>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8 ps-md-0 align-self-center">
                    <div class="news-box">
                      <i class="fas fa-clock"></i><span><?php echo get_the_date('j F Y'); ?></span>
                      <h4 class="m-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                  </div>
                </div>
              </div>
            <?php $viral_news_center_news_i++; endwhile;
          wp_reset_postdata();
        } ?>
        
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <h3 class="mb-3"><?php echo esc_html(get_theme_mod('viral_news_center_news_title_3','')); ?></h3>
        <?php if(get_theme_mod('viral_news_center_news_category_2')!=''){ ?>
        <div class="news-category mb-3">
          <div class="owl-carousel">
            <?php
              $viral_news_center_news_cat_2 = get_theme_mod('viral_news_center_news_category_2','');
              $viral_news_center_news_2_per_page = get_theme_mod('viral_news_center_blog_number','') ;
              if($viral_news_center_news_cat_2){
                $viral_news_center_page_query5_news_2 = new WP_Query(array( 'category_name' => esc_html($viral_news_center_news_cat_2,'viral-news-center'),'posts_per_page' => esc_attr( $viral_news_center_news_2_per_page )));
                while( $viral_news_center_page_query5_news_2->have_posts() ) : $viral_news_center_page_query5_news_2->the_post(); ?>
                  <div class="">
                    <?php if(has_post_thumbnail()){?>
                      <div class="box-imagess">
                        <?php the_post_thumbnail();?>
                      </div>
                    <?php } else{?>
                      <div class="box-imagess">
                        <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/latest-news-2.png" alt="" />
                      </div>
                    <?php } ?>
                    <div class="news-box pt-1">
                      <i class="fas fa-clock"></i><span><?php echo get_the_date('F j, Y'); ?></span>
                      <h4 class="mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                  </div>
                <?php endwhile;
              wp_reset_postdata();
            } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  </section>

  <section id="featured-topic" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('magazine_express_featured_category_title')!=''){ ?>
         <h3 class="mb-5 text-center d-table py-2 px-3"><?php echo esc_html(get_theme_mod('magazine_express_featured_category_title','')); ?></h3>
      <?php } ?>
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <?php
              $magazine_express_featured_cat1 = get_theme_mod('magazine_express_featured_category_1','');
              if($magazine_express_featured_cat1){
                $magazine_express_page_query4 = new WP_Query(array( 'category_name' => esc_html($magazine_express_featured_cat1,'viral-news-center')));
                while( $magazine_express_page_query4->have_posts() ) : $magazine_express_page_query4->the_post(); ?>
                  <div class="col-lg-6 col-md-6">
                    <div class="featured-imagebox mb-4">
                      <?php if(has_post_thumbnail()){
                        the_post_thumbnail();
                        } else{?>
                        <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/featured-post.png" alt="" />
                      <?php } ?>
                      <div class="featured-content px-3">
                        <div class="featured-cat">
                          <!-- <span><?php the_category() ?></span> -->
                        </div>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>" class="featured-date me-3"><i class="fas fa-user me-2"></i><?php echo esc_html('By '); the_author(); ?></a>
                        <a href="<?php echo esc_url( get_day_link( $magazine_express_year, $magazine_express_month, $magazine_express_day)); ?>" class="featured-date"><i class="far fa-calendar-alt me-2"></i><?php echo esc_html( get_the_date() ); ?></a>                    
                      </div>
                    </div>
                  </div>
                <?php endwhile;
              wp_reset_postdata();
            } ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php
            $magazine_express_featured_cat2 = get_theme_mod('magazine_express_featured_category_2','');
            if($magazine_express_featured_cat2){
              $magazine_express_page_query5 = new WP_Query(array( 'category_name' => esc_html($magazine_express_featured_cat2,'viral-news-center')));
              while( $magazine_express_page_query5->have_posts() ) : $magazine_express_page_query5->the_post(); ?>
                <div class="box-category mb-3">
                  <div class="row">
                    <div class="col-lg-5 col-md-5 col-5">
                      <?php if(has_post_thumbnail()){
                        the_post_thumbnail();
                        } else{?>
                        <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/featured-sidebar-post.png" alt="" />
                      <?php } ?>
                    </div>
                    <div class="col-lg-7 col-md-7 col-7 px-2 my-3">
                      <div class="featured-cat">
                        <!-- <span><?php the_category() ?></span> -->
                      </div>
                      <h4 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <a href="<?php echo esc_url( get_day_link( $magazine_express_year, $magazine_express_month, $magazine_express_day)); ?>" class="box-date"><i class="far fa-calendar-alt me-2"></i><?php echo esc_html( get_the_date() ); ?></a>
                    </div>
                  </div>
                </div>
              <?php endwhile;
            wp_reset_postdata();
          } ?>
        </div>
      </div>
    </div>
  </section>  

  <section id="content-section" class="container">
    <?php
      if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
          the_content();
        endwhile; 
      endif; 
    ?>
  </section>
</main>

<?php get_footer(); ?>