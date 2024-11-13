<?php
/**
 * Displays top header
 *
 * @package Viral News Center
 */
?>

<div class="top-info py-3 text-center text-lg-start text-md-start">
	<div class="container">
		<div class="row">
			<div class="col-lg-10">
				<?php if(get_theme_mod('magazine_express_facebook_url') != ''){ ?>
            <span><strong><?php esc_html_e('TRENDING','viral-news-center'); ?></strong> | <marquee class="d-table-cell"><?php echo esc_html(get_theme_mod('magazine_express_trending_article_text','')); ?></marquee></span>
        <?php }?>
			</div>
			<div class="col-lg-2">
				<div class="date-box text-end">
					<i class="fas fa-calendar-alt"></i>
					<?php echo date('F j, Y'); ?>
				</div>
			</div>
		</div>
	</div>
</div>