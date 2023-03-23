<!DOCTYPE html> 
<html style="height:100%;" class="bg-black" <?php language_attributes(); ?>>
    <head class="bg-black"> 
        <meta charset="<?php bloginfo( 'charset' ); ?>"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/image-1@1x.png" type="image/png"> 
       
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->         
       
        <?php wp_head(); ?>
    </head>     
    <body class="bg-black <?php echo implode(' ', get_body_class()); ?>">
        <?php if( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>