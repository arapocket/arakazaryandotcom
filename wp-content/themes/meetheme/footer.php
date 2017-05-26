<?php
    /**
    * footer.php
    * Footer
    * @author Pluton
    * @package MeeTheme
    * @since 1.0.0
    */
    global $meetheme;
?>
    <?php if( is_page( ) && basename( get_page_template() ) == 'one-page.php' ): ?>
                
            <?php if ($meetheme['footer_switch'] != '0'){ ?>
                <!-- Introduction -->
                <article class="content introduction-end" id="chapterthankyou">
                    <div class="inner">
                        <div class="introduction-end-con margin-top50">
                            <?php if (isset($meetheme['footer_switch']) && $meetheme['footer_switch']==1): ?>
                                <?php if ($meetheme['footer_text_title']): ?>
                                    <h3><strong><?php echo stripslashes($meetheme['footer_text_title']); ?></strong></h3>
                                <?php endif ?>
                                <?php if ($meetheme['footer_multi_text']): ?>
                                    <div id="rotate" class="rotate">
                                        <?php foreach ($meetheme['footer_multi_text'] as $key => $value) { ?>
                                            <div><span><?php echo stripslashes($value); ?></span></div>
                                        <?php } ?>
                                    </div>
                                <?php else: ?>
                                    <div id="rotate" class="rotate">
                                        <div><span>awesome.</span></div>
                                        <div><span>invincible.</span></div>
                                        <div><span>unbeatable.</span></div>
                                        <div><span>indestructible.</span></div>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </article>
            <?php } ?>
            </div>
            <!-- content-wrapper -->
        </div>
        <!-- content-scroller -->
    <?php endif ?>
    </div>
    <?php if( is_page( ) && basename( get_page_template() ) == 'one-page.php' ): ?>
        <?php
            pluton_page_scroll_scripts ();
            echo get_template_part('content-parts/one', 'page');
        ?>
    <?php endif ?>
    <?php wp_footer(); ?>
</body>
</html>