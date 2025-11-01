<?php

get_header();

?>
<div class="container">
    <div class="grid grid-three">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                ?>
                <div class="card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="card-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-content">
                        <a href="<?php the_permalink(); ?>">
                            <h2 class="card-title">
                                <?php the_title(); ?>
                            </h2>
                        </a>
                        <div class="card-excerpt"><?php the_excerpt(); ?></div>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
        <?php else: ?>
            <p><?php esc_html_e('No books found.', 'simple-book'); ?></p>
        <?php endif ?>
    </div>
</div>

<?php

get_footer();

?>