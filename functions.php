<?php
if ( ! function_exists( 'fakemon_setup' ) ) :

function fakemon_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */

    load_theme_textdomain( 'fakemon', get_template_directory() . '/languages' );
   

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );
    
    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    //Support custom logo
    add_theme_support( 'custom-logo' );

    // Add menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'fakemon' ),
        'social'  => __( 'Social Links Menu', 'fakemon' ),
    ) );

/*
     * Register custom menu locations
     */
    
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    /*
     * Enable support for Post Formats.
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );

    /*
     * Enable support for Page excerpts.
     */
     add_post_type_support( 'page', 'excerpt' );
}
endif; // fakemon_setup

add_action( 'after_setup_theme', 'fakemon_setup' );


if ( ! function_exists( 'fakemon_init' ) ) :

function fakemon_init() {

    
    // Use categories and tags with attachments
    register_taxonomy_for_object_type( 'category', 'attachment' );
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );

    /*
     * Register custom post types. You can also move this code to a plugin.
     */

    
    /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */


}
endif; // fakemon_setup

add_action( 'init', 'fakemon_init' );


if ( ! function_exists( 'fakemon_custom_image_sizes_names' ) ) :

function fakemon_custom_image_sizes_names( $sizes ) {


    return $sizes;
}
add_action( 'image_size_names_choose', 'fakemon_custom_image_sizes_names' );
endif;// fakemon_custom_image_sizes_names



if ( ! function_exists( 'fakemon_widgets_init' ) ) :

function fakemon_widgets_init() {

    /*
     * Register widget areas.
     */

    register_sidebar( array(
        'name' => __( 'Contact 3 Form', 'fakemon' ),
        'id' => 'blocks_contact_3_form',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer 1-4 Form', 'fakemon' ),
        'id' => 'blocks_footer_1_4_form',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

}
add_action( 'widgets_init', 'fakemon_widgets_init' );
endif;// fakemon_widgets_init



if ( ! function_exists( 'fakemon_customize_register' ) ) :

function fakemon_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.

    $wp_customize->add_section( 'blocks_header_3', array(
        'title' => __( 'Header 3', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_1_5', array(
        'title' => __( 'Content 1-5', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_6', array(
        'title' => __( 'Content 3-6', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_6', array(
        'title' => __( 'Content 3-6', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_1', array(
        'title' => __( 'Content 3-1', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_2_7', array(
        'title' => __( 'Content 2-7', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_footer_1_4', array(
        'title' => __( 'Footer 1-4', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_header_3', array(
        'title' => __( 'Header 3', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_1_5', array(
        'title' => __( 'Content 1-5', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_6', array(
        'title' => __( 'Content 3-6', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_6', array(
        'title' => __( 'Content 3-6', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_3_1', array(
        'title' => __( 'Content 3-1', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_content_2_7', array(
        'title' => __( 'Content 2-7', 'fakemon' )
    ));

    $wp_customize->add_section( 'blocks_footer_1_4', array(
        'title' => __( 'Footer 1-4', 'fakemon' )
    ));
    $pgwp_sanitize = function_exists('pgwp_sanitize_placeholder') ? 'pgwp_sanitize_placeholder' : null;

    $wp_customize->add_setting( 'blocks_content_1_8_source', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_BlocksContentDropdown_Customize_Control( $wp_customize, 'blocks_content_1_8_source', array(
        'label' => __( 'Content source', 'fakemon' ),
        'type' => 'custom',
        'section' => 'blocks_content_1_8'
    ) ) );

    $wp_customize->add_setting( 'blocks_header_3_text', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_header_3_text', array(
        'label' => __( 'Text', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_header_3'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_title', array(
        'type' => 'theme_mod',
        'default' => __( 'THE FAKEMON', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_title', array(
        'label' => __( 'Title', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'Fakemons? What&rsquo;s this ?', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'You will have to use them cleverly to win against your opponent, in the classic mode you will have all the basic Fakemons to be able to defeat your opponents.', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'The elements at the heart of the game', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'The importance of the choices of the Fakemons lies in the element to which they belong, make the right choices, anticipate your opponent and read his game to win the game.', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'New Fakemons in nft form?', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_subtitle', array(
        'type' => 'theme_mod',
        'default' => __( 'New Fakemons will be available for purchase, some can be purchased by all players and others will be very limited and can be resold, they will be useful in the &quot;deck&quot; mode available soon.
- Pour la suite de vrai carte ! One of our goals is to have all of our Fakemons edited into a collection, users could purchase boosters from our online store.', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_5_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_5'
    ));

    $wp_customize->add_setting( 'blocks_content_1_5_image', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blocks_content_1_5_image', array(
        'label' => __( 'Image', 'fakemon' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'blocks_content_1_5'
    ) ) );

    $wp_customize->add_setting( 'blocks_content_1_2_title', array(
        'type' => 'theme_mod',
        'default' => __( 'FAKEMON', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_2_title', array(
        'label' => __( 'Title', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_1_2'
    ));

    $wp_customize->add_setting( 'blocks_content_1_2_title', array(
        'type' => 'theme_mod',
        'default' => __( 'CRYPTO', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_2_title', array(
        'label' => __( 'Title', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_1_2'
    ));

    $wp_customize->add_setting( 'blocks_content_1_2_text', array(
        'type' => 'theme_mod',
        'default' => __( 'the game with stake players against players
The UCHI is the official currency of the game, it will be used as a bet to play in players against players
contract address: 0xEfF21013B56404A1442AaC3EfB02c0454090758c add to metamask
Fakemon crypto is not a farming game, it&rsquo;s a &ldquo;game with stakes&rdquo; players bet cryptocurrency and duel, winner takes total bet', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_1_2_text', array(
        'label' => __( 'Text', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_1_2'
    ));

    $wp_customize->add_setting( 'blocks_content_1_2_image', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blocks_content_1_2_image', array(
        'label' => __( 'Image', 'fakemon' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'blocks_content_1_2'
    ) ) );

    $wp_customize->add_setting( 'blocks_content_3_6_source', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_BlocksContentDropdown_Customize_Control( $wp_customize, 'blocks_content_3_6_source', array(
        'label' => __( 'Content source', 'fakemon' ),
        'type' => 'custom',
        'section' => 'blocks_content_3_6'
    ) ) );

    $wp_customize->add_setting( 'blocks_content_3_1_button1_label', array(
        'type' => 'theme_mod',
        'default' => __( 'Fakemon crypto', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_button1_label', array(
        'label' => __( 'Button 1 Label', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_3_1_button1_link', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_button1_link', array(
        'label' => __( 'Button 1 Link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_3_1_button2_label', array(
        'type' => 'theme_mod',
        'default' => __( 'rules creator', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_button2_label', array(
        'label' => __( 'Button 2 Label', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_3_1_button2_link', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_button2_link', array(
        'label' => __( 'Button 2 Link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_3_1_bck', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blocks_content_3_1_bck', array(
        'label' => __( 'Background image', 'fakemon' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'blocks_content_3_1'
    ) ) );

    $wp_customize->add_setting( 'blocks_content_3_1_tagline', array(
        'type' => 'theme_mod',
        'default' => __( 'HOW TO', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_tagline', array(
        'label' => __( 'Tagline', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_3_1_tagline', array(
        'type' => 'theme_mod',
        'default' => __( 'PLAY ?', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_content_3_1_tagline', array(
        'label' => __( 'Tagline', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_content_3_1'
    ));

    $wp_customize->add_setting( 'blocks_content_2_7_source', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_BlocksContentDropdown_Customize_Control( $wp_customize, 'blocks_content_2_7_source', array(
        'label' => __( 'Content source', 'fakemon' ),
        'type' => 'custom',
        'section' => 'blocks_content_2_7'
    ) ) );

    $wp_customize->add_setting( 'blocks_content_2_7_bck', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blocks_content_2_7_bck', array(
        'label' => __( 'Background image', 'fakemon' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'blocks_content_2_7'
    ) ) );

    $wp_customize->add_setting( 'blocks_footer_1_4_title', array(
        'type' => 'theme_mod',
        'default' => __( 'CONTACT&nbsp;', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_title', array(
        'label' => __( 'Title', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_title', array(
        'type' => 'theme_mod',
        'default' => __( 'US', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_title', array(
        'label' => __( 'Title', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_subtitle', array(
        'type' => 'theme_mod',
        'default' => '<a href="#" style="font-family: nikkyou sans; font-size: 37px;">you can contact us whatever your questions are</a>',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_subtitle', array(
        'label' => __( 'Subtitle', 'fakemon' ),
        'type' => 'textarea',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_contact_3_image', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blocks_contact_3_image', array(
        'label' => __( 'Image', 'fakemon' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'blocks_contact_3'
    ) ) );

    $wp_customize->add_setting( 'blocks_footer_1_4_facebook', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_facebook', array(
        'label' => __( 'Facebook link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_twitter', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_twitter', array(
        'label' => __( 'Twitter link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_google', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_google', array(
        'label' => __( 'Google+ link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_pinterest', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_pinterest', array(
        'label' => __( 'Pinterest link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_behance', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_behance', array(
        'label' => __( 'Behance link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    $wp_customize->add_setting( 'blocks_footer_1_4_dribbble', array(
        'type' => 'theme_mod',
        'default' => __( '#', 'fakemon' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'blocks_footer_1_4_dribbble', array(
        'label' => __( 'Dribbble link', 'fakemon' ),
        'type' => 'text',
        'section' => 'blocks_footer_1_4'
    ));

    /* Pinegrow generated Customizer Controls End */

}
add_action( 'customize_register', 'fakemon_customize_register' );
endif;// fakemon_customize_register


if ( ! function_exists( 'fakemon_enqueue_scripts' ) ) :
    function fakemon_enqueue_scripts() {



    wp_register_script( 'inline-script-1', '', [], '1.0.2', false );
    wp_enqueue_script( 'inline-script-1' );
    wp_add_inline_script( 'inline-script-1', '/* Pinegrow Interactions, do not remove */ (function(){try{if(!document.documentElement.hasAttribute(\'data-pg-ia-disabled\')) { window.pgia_small_mq=typeof pgia_small_mq==\'string\'?pgia_small_mq:\'(max-width:767px)\';window.pgia_large_mq=typeof pgia_large_mq==\'string\'?pgia_large_mq:\'(min-width:768px)\';var style = document.createElement(\'style\');var pgcss=\'html:not(.pg-ia-no-preview) [data-pg-ia-hide=""] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show=""] {opacity:1;visibility:visible;display:block;}\';if(document.documentElement.hasAttribute(\'data-pg-id\') && document.documentElement.hasAttribute(\'data-pg-mobile\')) {pgia_small_mq=\'(min-width:0)\';pgia_large_mq=\'(min-width:99999px)\'} pgcss+=\'@media \' + pgia_small_mq + \'{ html:not(.pg-ia-no-preview) [data-pg-ia-hide="mobile"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="mobile"] {opacity:1;visibility:visible;display:block;}}\';pgcss+=\'@media \' + pgia_large_mq + \'{html:not(.pg-ia-no-preview) [data-pg-ia-hide="desktop"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="desktop"] {opacity:1;visibility:visible;display:block;}}\';style.innerHTML=pgcss;document.querySelector(\'head\').appendChild(style);}}catch(e){console&&console.log(e);}})()');

    wp_register_script( 'inline-script-2', '', [], '1.0.2', true );
    wp_enqueue_script( 'inline-script-2' );
    wp_add_inline_script( 'inline-script-2', 'var scrolltotop = document.getElementById("scrolltotop");
      if (scrolltotop) {
        scrolltotop.addEventListener("click", function () {
          var anchor = document.querySelector("[data-scroll-to=\'fakemoncrypto\']");
          if (anchor) {
            anchor.scrollIntoView({ block: "start", behavior: "smooth" });
          }
        });
      }');

    wp_enqueue_script( 'jquery' );
    wp_deregister_script( 'fakemon-bootstrap' );
    wp_enqueue_script( 'fakemon-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', [], '1.0.2', true);

    wp_deregister_script( 'fakemon-plugins' );
    wp_enqueue_script( 'fakemon-plugins', get_template_directory_uri() . '/js/plugins.js', [], '1.0.2', true);

    wp_deregister_script( 'fakemon-script' );
    wp_enqueue_script( 'fakemon-script', 'https://maps.google.com/maps/api/js?sensor=true', [], '1.0.2', true);

    wp_deregister_script( 'fakemon-bskitscripts' );
    wp_enqueue_script( 'fakemon-bskitscripts', get_template_directory_uri() . '/js/bskit-scripts.js', [], '1.0.2', true);

    wp_deregister_script( 'fakemon-pgia' );
    wp_enqueue_script( 'fakemon-pgia', get_template_directory_uri() . '/pgia/lib/pgia.js', [], '1.0.2', true);

    wp_register_script( 'inline-script-3', '', [], '1.0.2', true );
    wp_enqueue_script( 'inline-script-3' );
    wp_add_inline_script( 'inline-script-3', '$(function() {
    $(\'[data-toggle="popover"]\').popover();
})');

    wp_deregister_style( 'fakemon-theme' );
    wp_enqueue_style( 'fakemon-theme', get_template_directory_uri() . '/css/theme.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-bootstrap' );
    wp_enqueue_style( 'fakemon-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-fontawesome' );
    wp_enqueue_style( 'fakemon-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-style' );
    wp_enqueue_style( 'fakemon-style', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-style-1' );
    wp_enqueue_style( 'fakemon-style-1', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-stylelibrary' );
    wp_enqueue_style( 'fakemon-stylelibrary', get_template_directory_uri() . '/css/style-library-1.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-plugins' );
    wp_enqueue_style( 'fakemon-plugins', get_template_directory_uri() . '/css/plugins.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-blocks' );
    wp_enqueue_style( 'fakemon-blocks', get_template_directory_uri() . '/css/blocks.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-custom' );
    wp_enqueue_style( 'fakemon-custom', get_template_directory_uri() . '/css/custom.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-style-2' );
    wp_enqueue_style( 'fakemon-style-2', 'https://fonts.googleapis.com/css?family=Alatsi&display=swap', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-theme-1' );
    wp_enqueue_style( 'fakemon-theme-1', get_template_directory_uri() . '/../../Documents/Projects/css/theme.css', [], '1.0.2', 'all');

    wp_deregister_style( 'fakemon-style-3' );
    wp_enqueue_style( 'fakemon-style-3', get_bloginfo('stylesheet_url'), [], '1.0.2', 'all');


    }
    add_action( 'wp_enqueue_scripts', 'fakemon_enqueue_scripts' );
endif;

function pgwp_sanitize_placeholder($input) { return $input; }
/*
 * Resource files included by Pinegrow.
 */
require_once "inc/custom.php";
if( !class_exists( 'PG_Helper_v2' ) ) { require_once "inc/wp_pg_helpers.php"; }
/* Setting up theme supports options */

function fakemon_setup_theme_supports() {
    // Don't edit anything between the following comments.
    
//Tell WP to scope loaded editor styles to the block editor                    
add_theme_support( 'editor-styles' );
    /* Pinegrow generated Theme Supports End */
}
add_action('after_setup_theme', 'fakemon_setup_theme_supports');


/* Loading editor styles for blocks */

function fakemon_add_blocks_editor_styles() {
// Add blocks editor styles. Don't edit anything between the following comments.
}
add_action('admin_init', 'fakemon_add_blocks_editor_styles');

/* End of loading editor styles for blocks */

?>