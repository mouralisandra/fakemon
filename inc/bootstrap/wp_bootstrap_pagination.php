<?php
/**
 * WordPress Bootstrap Pagination
 *
 * Based on: https://github.com/talentedaamer/Bootstrap-wordpress-pagination
 *
 * License: GNU GENERAL PUBLIC LICENSE
 *
 *
 * <ul class="pagination" data-pg-collapsed wp-bs-post-pagination>
<li class="page-item">
<a class="page-link" href="#">Previous</a>
</li>

<li class="page-item">
<a class="page-link" href="#">1</a>
</li>

<li class="page-item">
<a class="page-link" href="#">2</a>
</li>

<li class="page-item">
<a class="page-link" href="#">3</a>
</li>

<li class="page-item">
<a class="page-link" href="#">Next</a>
</li>
</ul>
 *
 */
function wp_bootstrap_pagination( $args = array() ) {

    $text_domain = null;

    $defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => __( '<i class="glyphicon glyphicon-chevron-left"></i>', 'fakemon' ),
        'next_string'     => __( '<i class="glyphicon glyphicon-chevron-right"></i>', 'fakemon' ),
        'first_string'    => __( 'First', 'fakemon'),
        'last_string'     => __( 'Last', 'fakemon'),
        'before_output'   => '<nav class="post-nav"><ul class="pagination">',
        'after_output'    => '</ul></nav>'
    );

    $args = wp_parse_args(
        $args,
        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );

    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );

    if ( $count <= 1 )
        return FALSE;

    if ( !$page )
        $page = 1;

    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }

    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );

    $firstpage = esc_attr( get_pagenum_link(1) );
    if ( $firstpage && (1 != $page || true) )
        $echo .= '<li class="previous'.($page == 1 ? ' disabled' : '').'"><a href="' . $firstpage . '" aria-label="'.__( 'First', 'fakemon' ).'">' . $args['first_string'] . '</a></li>';
    if ( $previous && (1 != $page || true) )
        $echo .= '<li'.($page == 1 ? ' class="disabled"' : '').'><a href="' . $previous . '" title="' . __( 'previous', 'fakemon') . '" aria-label="' . __( 'previous', 'fakemon') . '">' . $args['previous_string'] . '</a></li>';

    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                //$echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
                $echo .= sprintf( '<li class="active"><a class="active" href="%s">%d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            } else {
                $echo .= sprintf( '<li><a href="%s">%d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }

    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page || true) )
        $echo .= '<li'.($page == $count ? ' class="disabled"' : '').'><a href="' . $next . '" title="' . __( 'next', 'fakemon') . '" aria-label="' . __( 'next', 'fakemon') . '">' . $args['next_string'] . '</a></li>';

    $lastpage = esc_attr( get_pagenum_link($count) );
    if ( $lastpage ) {
        $echo .= '<li class="next'.($page == $count ? ' disabled' : '').'"><a href="' . $lastpage . '" aria-label="' . __( 'Last', 'fakemon') . '">' . $args['last_string'] . '</a></li>';
    }
    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}
