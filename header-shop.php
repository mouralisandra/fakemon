<html style="height: 100%; background-image: url('<?php echo get_template_directory_uri(); ?>/wallpaper@2x.png'); background-size: cover;" class="bg-black" <?php language_attributes(); ?>>
    <head> 
        <meta charset="<?php bloginfo( 'charset' ); ?>"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/favicon.png"> 
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->         
        <?php wp_head(); ?>
    </head>     
    <body data-spy="scroll" data-target="nav" class="<?php echo implode(' ', get_body_class()); ?>"> 
<?php if( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>