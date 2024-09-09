<?php ?>
<a class="popup-youtube" href="<?php echo esc_url($settings['video_url']); ?>">
    <img class="vpop_img" src="<?php echo esc_url($settings['poster_image']['url']) ?>"/>
</a>
<style>
    a.popup-youtube {
        margin: auto;
        display: block;
        width: 130px;
        text-align: center;
    }
</style>

<script>
    jQuery(document).ready(function ($) {

        $(function () {
            $('.popup-youtube, .popup-vimeo').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        });

    });

</script>