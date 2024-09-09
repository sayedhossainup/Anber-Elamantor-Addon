<div class="carousel-wrap">
    <div class="owl-carousel">
        <?php
        if (!empty($settings['item_list'])) {
            foreach ($settings['item_list'] as $item) {
                ?>
                <div class="item inner_page_banner p-relative" style="background-image: url(<?php echo esc_url($item['banner_image']['url']); ?>);">      
                    <?php
                    if ('yes' === $settings['overlayer_switcher']) {
                        ?>
                        <div class="overlayer"></div>
                        <?php
                    }
                    ?>

                    <div class="banner_title_wrap z-9 p-relative flex-direction-column d-flex" style="margin: auto">
                        <?php if (!empty($item['banner_title'])) : ?> 
                            <h2 class="banner_title"><?php echo esc_html($item['banner_title']); ?></h2>
                        <?php endif; ?>
                        <?php
                        $allowed_tags = array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array(),
                            'p' => array(),
                            'span' => array(),
                                // Add more allowed tags and attributes as needed
                        );

                        $banner_content = isset($settings['banner_content']) ? wp_kses($settings['banner_content'], $allowed_tags) : '';

                        if (!empty($settings['banner_content'])) :
                            ?>
                            <h4 class="banner_content">
                                <?php
                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                echo $banner_content;
                                ?>
                            </h4>
                        <?php endif; ?>

                        <?php
                        if ('yes' === $item['show_button']) {
                            echo '<div class="button_wrapper d-flex flex-wrap">';
                            // Initialize icon HTML
                            $icon_html = '';
                            if (!empty($item['icon'])) {
                                // Get the icon HTML
                                ob_start(); // Start output buffering
                                \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                                $icon_html = ob_get_clean(); // Store the icon HTML
                            }

                            // Output the button with the icon inside the wrapper
                            echo '<a class="banner_cta_button d-flex align-items-center elementor-repeater-item-' . esc_attr($item['_id']) . '" href="' . esc_attr($item['button_link']['url']) . '">';
                            echo esc_html($item['button_title']);
                            if ($icon_html) {
                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                echo '<span class="my-icon-wrapper">' . $icon_html . '</span>';
                            }
                            echo '</a></div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php
$settings = $this->get_settings_for_display();
$car_button = $settings['carousel_control'];
$car_previous_icon = $settings['previous_icon'];
$car_next_icon = $settings['next_icon'];

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
    'desktop' => $settings['carousel_item']['size'] ?? 1, // Fallback to 3 if not set
    'tablet' => $settings['carousel_item_tablet']['size'] ?? 2, // Fallback to 2 if not set
    'mobile' => $settings['carousel_item_mobile']['size'] ?? 1, // Fallback to 1 if not set
];
?>
<script>
    jQuery(document).ready(function ($) {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
<?php
// Set dots
echo ($car_button == 'dots' || $car_button == 'both') ? 'dots: true,' : 'dots: false,';
// Set nav
echo ($car_button == 'nav' || $car_button == 'both') ? 'nav: true,' : 'nav: false,';
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
                    items: <?php echo esc_js($carousel_items['mobile']); ?>
                },
                600: {
                    items: <?php echo esc_js($carousel_items['tablet']); ?>
                },
                1000: {
                    items: <?php echo esc_js($carousel_items['desktop']); ?>
                }
            }
        });
    });
</script>