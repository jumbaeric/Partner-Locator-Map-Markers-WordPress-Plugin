<div id="content-2" class="dealer-locator with-map">
    <div class="map" style="position: relative; overflow: hidden;" id="google-map">

    </div>
    <div class="container">
        <div class="dealer-finder">
            <div class="border white" style="padding-bottom: 10px;">
                <div class="top">
                    <h3 class="mb">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Find a reliable lock expert nearby!</font>
                        </font>
                    </h3>
                    <div class="dealer-locator-input mb with-search-icon with-share-location">
                        <div class="flex flex-wrap flex-direction-column">
                            <label for="zip" class="dealer-locator-input__label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Postal Code</font>
                                </font>
                            </label>
                            <div class="flex flex-column search_partner">
                                <input id="zip" type="text" placeholder="1111 AA" autocomplete="postal-code" class="dealer-locator-input__input">
                                <i class="fa-solid fa-magnifying-glass icons8-search pink--text"></i>
                            </div>
                        </div>
                        <div class="text-button nowrap flex flex-align-center">
                            <i class="fa-solid fa-location-crosshairs icons8-location-off mr-05"></i>
                            <span>
                                <font style="vertical-align: inherit;">
                                    Share location
                                </font>
                            </span>
                        </div>
                    </div>
                    <label class="small">
                        <font style="vertical-align: inherit;">Filter</font>
                    </label>
                    <?php
                    $args = array(
                        'taxonomy'               => 'partner-tag',
                        'orderby'                => 'name',
                        'order'                  => 'ASC',
                        'hide_empty'             => false,
                    );
                    $the_query = new WP_Term_Query($args);
                    foreach ($the_query->get_terms() as $term) :
                    ?>
                        <div class="flex mt-05">
                            <input type="checkbox" id="<?php echo $term->slug ?>" class="taxonomy-term">
                            <label for="<?php echo $term->slug ?>">
                                <font style="vertical-align: inherit;">
                                    <?php echo $term->name ?>
                                </font>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="dealers mt fixed-height" style="display: none;">
                    <span>
                        <!-- Partner loop start -->
                        <?php
                        if ($partners->have_posts()) :
                            while ($partners->have_posts()) : $partners->the_post();
                                $city = get_field('city', get_the_ID());
                                $terms = get_the_terms(get_the_ID(), 'partner-tag');
                                $address_details = get_field('address_details');
                        ?>
                                <div class="dealer flex" style="transition-delay: 0s;">
                                    <button title="<?php the_title() ?>" class="dealer-link flex-column flex-grow-1">
                                        <div><b class="ellipsis">
                                                <font style="vertical-align: inherit;">
                                                    <a href="<?php the_permalink() ?>">
                                                        <?php the_title() ?>
                                                    </a>
                                                </font>
                                            </b>
                                        </div>
                                        <div class="flex mt-05" style="flex-wrap: wrap; flex-direction: column;">
                                            <span class="small">
                                                <font style="vertical-align: inherit;">
                                                    <?php echo $address_details['city'] ?>
                                                </font>
                                            </span>

                                            <?php if ($terms) : ?>
                                                <span class="small">
                                                    <?php foreach ($terms as $term) : ?>
                                                        <font style="vertical-align: inherit;"><?php echo $term->name ?>,</font>
                                                    <?php endforeach; ?>
                                                </span>
                                            <?php endif; ?>
                                            <div class="flex-grow-1"></div>
                                            <!---->
                                        </div>
                                        <!---->
                                    </button>
                                    <a href="tel:<?php echo get_field('phone') ?>" class="text-button">
                                        <i class="fa-solid fa-phone icons8-phone pink--text"></i></i>
                                    </a>
                                    <i class="fa-solid fa-angle-right icons8-right pink--text show-on-hover"></i>
                                </div>
                        <?php
                            endwhile;

                            wp_reset_postdata();
                        endif;
                        ?>
                    </span>
                </div>
            </div>
            <div id="view_all_button">
                <button class="button pink flex flex-justify-center">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            View all partners

                        </font>
                    </font><i class="icons8-down-arrow"></i>
                </button>
            </div>
        </div>
    </div>
</div>