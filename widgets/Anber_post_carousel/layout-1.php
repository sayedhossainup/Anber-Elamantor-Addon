<?php
// The Query.

$args = array(
    'post_type' => 'post', // Get posts
    'posts_per_page' => 10, // Number of posts to display
    'orderby' => 'date', // Order by date
    'order' => 'DESC', // Newest first
);
$the_query = new WP_Query($args);
?>


<div class="post-carousel-wrap">
    <div id="anber-post-carousel" class="owl-carousel">
        <?php
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $feat_image = wp_get_attachment_url(get_post_thumbnail_id());
                ?>
                <div class="item post-item">
                    <div class="media">
                        <?php if ('yes' === $settings['show_thumbline']) : ?>
                            <img src="<?php echo esc_url($feat_image); ?>"
                            <?php if (!empty($settings['post_content_img_dimension']['height'])): ?>
                                     style="height:<?php echo esc_html($settings['post_content_img_dimension']['height']); ?>px; object-fit: cover;"
                                 <?php endif; ?>
                                 alt="<?php the_title(); ?>" class="media__img" />

                        <?php endif;
                        ?> 
                        <?php if ('yes' === $settings['show_catname']) : ?>
                            <h4 class="catname"> <?php the_category(', '); ?></h4>
                        <?php endif; ?>
                        <div class="media__body ">
                            <div class="apps-blog-post-box-meta-114  align-items-center d-flex gap-10 py-20">  
                                <?php if ('yes' === $settings['show_postdate']) : ?>
                                    <span class="date  align-items-center d-flex gap-10">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.6673 7.9987C14.6673 11.6787 11.6807 14.6654 8.00065 14.6654C4.32065 14.6654 1.33398 11.6787 1.33398 7.9987C1.33398 4.3187 4.32065 1.33203 8.00065 1.33203C11.6807 1.33203 14.6673 4.3187 14.6673 7.9987Z" stroke="#FF7282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.4739 10.1211L8.40724 8.88781C8.04724 8.67448 7.75391 8.16115 7.75391 7.74115V5.00781" stroke="#FF7282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo get_the_date('M/d/ Y'); ?>
                                    </span>
                                <?php endif; ?> 

                                <?php if ('yes' === $settings['show_aurthor']) : ?>
                                    <span class="author align-items-center d-flex gap-10">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.99935 7.9987C9.8403 7.9987 11.3327 6.50631 11.3327 4.66536C11.3327 2.82442 9.8403 1.33203 7.99935 1.33203C6.1584 1.33203 4.66602 2.82442 4.66602 4.66536C4.66602 6.50631 6.1584 7.9987 7.99935 7.9987Z" stroke="#FF7282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M13.7268 14.6667C13.7268 12.0867 11.1601 10 8.0001 10C4.8401 10 2.27344 12.0867 2.27344 14.6667" stroke="#FF7282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                        <?php
                                        $author_name = get_the_author_meta('display_name', get_post_field('post_author', get_the_ID()));
                                        ?>
                                        <span><?php echo esc_html($author_name); ?></span>
                                    </span> 
                                <?php endif; ?> 
                            </div>
                            <?php if ('yes' === $settings['show_title']) : ?>
                                <h3 class="blgtitle"><?php the_title(); ?></h3>
                            <?php endif; ?>
                            <?php if ('yes' === $settings['show_content']) : ?>
                                <div class="blg-content"><?php echo esc_html(wp_trim_words(get_the_content(), 15, '...')); ?></div>
                            <?php endif; ?>
                            <?php if ('yes' === $settings['show_rdm']) : ?>
                                <div class="postbtn-wrwp d-flex">
                                    <a class="post_link d-flex" href="<?php echo esc_html(get_permalink()); ?>">
                                        <span> Read More</span> 
                                        <span class="iconsvg">
                                            <?php
                                            $rdm_icon = $settings['post_button_icon'];
                                            $rdm_icon_html = '';
                                            if (!empty($rdm_icon)) {
// Get the icon HTML
                                                ob_start(); // Start output buffering
                                                \Elementor\Icons_Manager::render_icon($rdm_icon, ['aria-hidden' => 'true']);
                                                $rdm_icon_html = ob_get_clean(); // Store the icon HTML
                                            }
                                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            echo $rdm_icon_html;
                                            ?>
                                        </span>
                                    </a>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>      
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php
$settings = $this->get_settings_for_display();
$post_car_button = $settings['post_carousel_control'];
$post_previous_icon = $settings['post_previous_icon'];
$post_next_icon = $settings['post_next_icon'];

$post_gap = $settings['item_gap'];

$previous_icon_html = '';
if (!empty($car_previous_icon)) {
    // Get the icon HTML
    ob_start(); // Start output buffering
    \Elementor\Icons_Manager::render_icon($car_previous_icon, ['aria-hidden' => 'true']);
    $previous_icon = ob_get_clean(); // Store the icon HTML
    $previous_icon_html= wp_kses_post($previous_icon); // Sanitize the icon HTML
}

$next_icon_html = '';
if (!empty($car_next_icon)) {
    // Get the icon HTML
    ob_start(); // Start output buffering
    \Elementor\Icons_Manager::render_icon($car_next_icon, ['aria-hidden' => 'true']);
    $next_icon = ob_get_clean(); // Store the icon HTML
    $next_icon_html = wp_kses_post($next_icon); // Sanitize the icon HTML
}


// Get the values for each device (desktop, tablet, mobile)
$carousel_items = [
    'desktop' => $settings['post_carousel_item']['size'] ?? 2, // Fallback to 3 if not set
    'tablet' => $settings['post_carousel_item_tablet']['size'] ?? 2, // Fallback to 2 if not set
    'mobile' => $settings['post_carousel_item_mobile']['size'] ?? 1, // Fallback to 1 if not set
];
?>
<script>
    jQuery(document).ready(function ($) {
        $('#anber-post-carousel').owlCarousel({
            loop: true,
            margin: <?php
// Escape the icon HTML for JavaScript
echo esc_js($post_gap['size']);
?>,
<?php
// Set dots
echo ($post_car_button == 'dots' || $post_car_button == 'both') ? 'dots: true,' : 'dots: false,';
// Set nav
echo ($post_car_button == 'nav' || $post_car_button == 'both') ? 'nav: true,' : 'nav: false,';
?>


            navText: [
                 '<?php
                // Escape the icon HTML for JavaScript
                echo esc_js($next_icon_html);
                ?>',
                '<?php
                // Escape the icon HTML for JavaScript
                echo esc_js($previous_icon_html);
                ?>'
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: <?php echo esc_js($carousel_items['mobile']); ?>,
                    nav: false,
                    dots: true
                },
                600: {
                    items: <?php echo esc_js($carousel_items['tablet']); ?>,
                    nav: false,
                    dots: true
                },
                1000: {
                    items: <?php echo esc_js($carousel_items['desktop']); ?>
                }
            }
        });
    });
</script>