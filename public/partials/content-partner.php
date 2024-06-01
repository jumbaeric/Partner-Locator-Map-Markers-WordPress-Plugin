<style>
    .dealer-detail-top {
        display: flex;
        align-items: center;
    }

    .dealer-detail-top h1 {
        margin-right: auto;
        /* Pushes the h1 to the left */
    }

    .back_to_partners {
        margin-left: 20px;
        /* Adjust this value as needed to create space between the icon and the h1 */
    }
</style>
<?php $referrer_url = wp_get_referer(); ?>
<main id="content" class="site-main">
    <div id="content-0" class="dealer-detail container text-width">
        <div class="dealer-detail-top">
            <h1>
                <font style="vertical-align: inherit;"><?php echo the_title(); ?></font>
            </h1>
            <?php if ($referrer_url) : ?>
                <span class="back_to_partners">
                    <a href="<?php echo esc_url($referrer_url); ?>">
                        <i class="fas fa-arrow-left"><span style="margin-left: 10px;">Back</span></i>
                        <!-- Assuming you are using Font Awesome for icons -->
                    </a>
                </span>
            <?php endif; ?>
        </div>
        <div class="grid mt"><img src="<?php echo $partner_image_url ?>?mode=pad&amp;width=600&amp;height=250" alt="<?php esc_attr(get_the_title()) ?>">
            <div class="urls flex flex-column"><a href="https://www.google.com/maps/dir/?api=1&amp;destination=<?php echo $address_details['address'] ?>,<?php echo $address_details['city'] ?>,<?php echo $address_details['postal_code'] ?>" target="_blank" class="text-button weight-normal pink--text"><i class="fa-solid fa-location-dot icons8-place-marker circle mr-05"></i> <span>
                        <font style="vertical-align: inherit;">Route</font>
                    </span></a> <a href="tel: <?php echo $phone; ?>" class="mt-05 text-button weight-normal pink--text"><i class="fa-solid fa-phone icons8-phone circle mr-05"></i> <span>
                        <font style="vertical-align: inherit;"><?php echo $phone; ?></font>
                    </span></a> <a href="mailto:<?php echo $email; ?>" class="mt-05 text-button weight-normal pink--text"><i class="fa-regular fa-envelope icons8-important-mail circle mr-05"></i>
                    <span>
                        <font style="vertical-align: inherit;"><?php echo $email; ?></font>
                    </span></a> <a href="<?php echo $website; ?>" target="_blank" rel="nofollow" class="mt-05 text-button weight-normal pink--text"><i class="fa-regular fa-globe icons8-website circle mr-05"></i> <span>
                        <font style="vertical-align: inherit;"><?php echo $website; ?></font>
                    </span></a></div>
            <?php if ($terms) : ?>
                <div class="properties flex flex-wrap">
                    <?php foreach ($terms as $term) : ?>
                        <div class="property flex flex-align-center"><i class="fa-regular fa-check-circle icons8-checked blue--text mr-025"></i> <span class="small gray2--text">
                                <font style="vertical-align: inherit;"><?php echo $term->name ?>,</font>
                            </span></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <hr class="ma-0">
        </div>
        <div class="mt flex flex-column-phablet-p">
            <div class="address-info"><b>
                    <font style="vertical-align: inherit;">Address details</font>
                </b><br>
                <font style="vertical-align: inherit;">
                    <?php echo $address_details['address'] ?>
                </font><br>
                <font style="vertical-align: inherit;">
                    <?php echo $address_details['postal_code'] ?> <?php echo $address_details['city'] ?> </font>
                <br>
                <font style="vertical-align: inherit;">
                    <?php echo $address_details['country'] ?>
                </font>
            </div>
            <?php if ($opening_hours && is_array($opening_hours)) : ?>
                <div class="opening-hours flex flex-column"><b>
                        <font style="vertical-align: inherit;">Opening hours
                        </font>
                    </b>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <?php foreach ($opening_hours as $day => $hours) : ?>
                                <tr>
                                    <td>
                                        <font style="vertical-align: inherit;"><?php echo ucfirst($day) ?>
                                        </font>
                                    </td>
                                    <td>
                                        <font style="vertical-align: inherit;"><?php echo $hours ?> </font>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <hr>
        <div class="h3 mb-05">
            <font style="vertical-align: inherit;">About <?php echo the_title(); ?>
            </font>
        </div>
        <div>
            <p>
                <font style="vertical-align: inherit;"><?php echo the_content() ?>
                </font>
            </p>
            <p>&nbsp;</p>

        </div>
    </div>

    <div id="content-1" class="video ">
        <div class="container text-width">
            <img src="https://img.youtube.com/vi/<?php echo $video_id;  ?>/hqdefault.jpg">
            <div class="youtube-video">
                <button class="text-button play-button">
                    <i class="fa-solid fa-circle-play icons8-play circle"></i>
                </button>
                <div class="flex flex-justify-center flex-align-center gray-layover" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/<?php echo $video_id;  ?>?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0" modestbranding="0" controls="controls" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->