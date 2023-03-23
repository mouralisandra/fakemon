<?php
/**
 * Class Name: PG_WC_Helper
 * GitHub URI:
 * Description:
 * Version: 1.0
 * Author: 
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */



if(! class_exists( 'PG_WC_Helper' )) {
    class PG_WC_Helper
    {
        static $product_prices = array();

        static function getPriceComplete( $product ) {
            if($product->is_type('variable') && $product->is_on_sale()) {
                //include discounted range, not shown by wc
                $prices = $product->get_variation_prices( true );

                if ( !empty( $prices['price'] ) ) {
                    $min_price     = current( $prices['price'] );
                    $max_price     = end( $prices['price'] );
                    $min_reg_price = current( $prices['regular_price'] );
                    $max_reg_price = end( $prices['regular_price'] );

                    if( $min_reg_price !== $max_reg_price ) {
                        $reg_price = wc_format_price_range($min_reg_price, $max_reg_price);
                    } else {
                        $reg_price = wc_price($min_reg_price);
                    }
                    if( $min_price !== $max_price ) {
                        $sale_price = wc_format_price_range($min_price, $max_price);
                    } else {
                        $sale_price = wc_price($min_price);
                    }
                    if($reg_price === $sale_price) {
                        $price = $sale_price;
                    } else {
                        $price = wc_format_sale_price($reg_price, $sale_price);
                    }
                    $price = apply_filters( 'woocommerce_variable_price_html', $price . $product->get_price_suffix(), $product );
                    return apply_filters( 'woocommerce_get_price_html', $price, $product );
                }
            }
            return $product->get_price_html();
        }

        static function getPrice( $product, $type ) {
            if(!isset(self::$product_prices[ $product->get_id() ])) {
                self::$product_prices[ $product->get_id() ] = new PG_HTML_Inspector( self::getPriceComplete($product) );
            }
            $i = self::$product_prices[ $product->get_id() ];

            switch($type) {
                case 'sale':
                    return $i->getInnerContent('ins') ?: $i->getWhole();
                case 'regular':
                    if($product->is_on_sale()) {
                        return $i->getInnerContent('del') ?: $i->getWhole();
                    } else {
                        return $i->getWhole();
                    }
            }
        }

        static function getSavedAmount( $product, $type = 'percent', $add_unit = true)
        {
            switch($product->get_type()) {
                case 'variable':
                    $regular_price = (float) $product->get_variation_regular_price( 'max', true);
                    $sale_price = (float) $product->get_variation_sale_price( 'max', true);
                    $regular_price_min = (float) $product->get_variation_regular_price( 'min', true);
                    $sale_price_min = (float) $product->get_variation_sale_price( 'min', true);

                    if($type === 'percent') {
                        if( ($regular_price === 0.0 && $regular_price_min > 0) || ($sale_price / $regular_price > $sale_price_min / $regular_price_min )) {
                            $sale_price = $sale_price_min;
                            $regular_price = $regular_price_min;
                        }
                    } else {
                        if( $regular_price - $sale_price < $regular_price_min - $sale_price_min ) {
                            $sale_price = $sale_price_min;
                            $regular_price = $regular_price_min;
                        }
                    }
                    break;
                default:
                    $regular_price = (float) $product->get_regular_price();
                    $sale_price = (float) $product->get_price();
            }

            if($type === 'percent') {
                if( $regular_price === 0.0 ) {
                    $r = '';
                } else {
                    $r = round(100 - ($sale_price / $regular_price * 100));
                    if($add_unit) {
                        $r .= '%';
                    }
                }
            } else {
                $r = wc_price( $regular_price - $sale_price );
            }
            return $r;
        }

        static function roundToHalfStar( $rating ) {
            $f = floor($rating);
            if($rating - $f < 0.25) return $f;
            if($rating - $f > 0.75) return $f + 1;
            return $f;
        }


        static function getValueFromHtml( $tag, $class, &$html ) {
            $re = '<'.$tag.'[^>]*class="[^"]*'.$class.'[^"]*">(.+)<\/'.$tag.'>/';
            $m = null;
            if(preg_match($re, $html, $m)) {
                $val = $m[0];
                $html = preg_replace($re, '', $html);
            } else {
                $val = '';
            }
            return $val;
        }

        static function getQuantityFieldSettings( $product ) {
            //source: add-to-cart/simple.php
            $args = array(
                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
            );

            //source: woocommerce_quantity_input
            $defaults = array(
                'input_id'     => uniqid( 'quantity_' ),
                'input_name'   => 'quantity',
                'input_value'  => '1',
                'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
                'max_value'    => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
                'min_value'    => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
                'step'         => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
                'pattern'      => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
                'inputmode'    => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
                'product_name' => $product ? $product->get_title() : '',
                'placeholder'  => apply_filters( 'woocommerce_quantity_input_placeholder', '', $product ),
            );

            $args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );

            // Apply sanity to min/max args - min cannot be lower than 0.
            $args['min_value'] = max( $args['min_value'], 0 );
            $args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : '';

            // Max cannot be lower than min if defined.
            if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
                $args['max_value'] = $args['min_value'];
            }
            return $args;
        }

        static function withTemplateVariant( $name, $func ) {
            global $pg_wc_use_template;

            if(!isset($pg_wc_use_template)) $pg_wc_use_template = null;

            $original_template = $pg_wc_use_template;
            $pg_wc_use_template = $name;
            $func();

            $pg_wc_use_template = $original_template;
        }
    }
}

if(! class_exists( 'PG_HTML_Token' )) {
    class PG_HTML_Token
    {
        public $tag;
        public $id = null;
        public $classes = null;
        public $closing = false;
        public $is_text = false;

        public $parts;

        public function __construct($part, $is_text = false)
        {
            $this->parts = explode('>', $part);
            $this->is_text = $is_text;
            if (!$is_text) {
                $m = null;
                if (strlen($part[0]) > 0 && $part[0] === '/') {
                    $this->closing = true;
                    $re = '/^\\/([a-z]+)/m';
                } else {
                    $re = '/^([a-z]+)/m';
                }
                if (preg_match($re, $part, $m)) {
                    $this->tag = $m[1];
                }
            }
        }

        public function hasClass($cls)
        {
            if ($this->is_text) return false;
            if ($this->classes === null) {
                $m = null;
                if (preg_match('/[^>]*class="([^"]*)"/m', $this->parts[0], $m)) {
                    $this->classes = explode(" ", $m[1]);
                } else {
                    $this->classes = array();
                }
            }
            return in_array($cls, $this->classes);
        }

        public function hasId($id)
        {
            if ($this->is_text) return false;
            if ($this->id === null) {
                $m = null;
                if (preg_match('/[^>]*id="([^"]*)"/m', $this->parts[0], $m)) {
                    $this->id = $m[1];
                } else {
                    $this->id = '';
                }
            }
            return $this->id === $id;
        }

        public function setAttributes($attrs, $append = array())
        {
            if ($this->is_text || $this->closing) return;
            foreach ($attrs as $name => $value) {
                $m = null;
                $re = '/\\s' . preg_quote($name) . '([\\s\\>]|="([^"]*)")/m';
                $q = strpos($value, '"') === false ? '"' : "'";
                if (!empty($append[$name])) {
                    if (preg_match($re, $this->parts[0], $m)) {
                        if ($m[2] !== '') {
                            $value = $m[2] . ' ' . $value;
                        }
                    }
                }
                $n = ' ' . $name . '=' . $q . $value . $q;
                if (preg_match($re, $this->parts[0], $m)) {
                    $this->parts[0] = preg_replace($re, $n, $this->parts[0]);
                } else {
                    $this->parts[0] .= $n;
                }
            }
        }
    }
}

if(! class_exists( 'PG_HTML_Inspector' )) {
    class PG_HTML_Inspector
    {

        private $html;
        private $tokens;

        public function __construct($html)
        {
            $this->html = $html;
            $this->parse();
        }

        private function parse()
        {
            $a = explode('<', $this->html);
            $this->tokens = array();
            foreach ($a as $i => $part) {
                if ($i === 0) {
                    $this->tokens[] = new PG_HTML_Token($part, true);
                } else if (strlen($part) > 0 && $part[strlen($part) - 1] === '>') {
                    $this->tokens[] = new PG_HTML_Token($part);
                } else {
                    $j = strrpos($part, '>');
                    $this->tokens[] = new PG_HTML_Token(substr($part, 0, $j + 1));
                    $this->tokens[] = new PG_HTML_Token(substr($part, $j + 1), true);
                }
            }
            //echo '<pre>'.print_r($this->tokens, true).'</pre>';
        }

        public function findTokenIndex($tag = null, $class = null, $id = null, $single = true)
        {
            $r = array();
            foreach ($this->tokens as $i => $token) {
                if ($token->closing) continue;
                if ($tag !== null && $token->tag !== $tag) continue;
                if ($class !== null && !$token->hasClass($class)) continue;
                if ($id !== null && !$token->hasId($id)) continue;
                if ($single === true) return $i;
                $r[] = $i;
            }
            return $single ? -1 : $r;
        }

        private function findClosingIndex($idx)
        {
            $tag = $this->tokens[$idx]->tag;
            $len = count($this->tokens);
            $level = 0;
            for ($i = $idx + 1; $i < $len; $i++) {
                if ($this->tokens[$i]->tag === $tag) {
                    if ($this->tokens[$i]->closing) {
                        if ($level === 0) return $i;
                        $level--;
                    } else {
                        $level++;
                    }
                }
            }
            return -1;
        }

        private function getHTMLFromIdxToIdx($start_idx, $end_idx)
        {
            $r = '';
            for ($i = $start_idx; $i <= $end_idx; $i++) {
                $r .= ($this->tokens[$i]->is_text ? '' : '<') . join('>', $this->tokens[$i]->parts);
            }
            return $r;
        }

        public function getInnerContent($tag = null, $class = null, $id = null)
        {
            $idx = $this->findTokenIndex($tag, $class, $id);
            if ($idx >= 0) {
                $end_idx = $this->findClosingIndex($idx);
                if ($end_idx) {
                    return $this->getHTMLFromIdxToIdx($idx + 1, $end_idx - 1);
                }
            }
            return '';
        }

        public function getWhole()
        {
            return $this->getHTMLFromIdxToIdx(0, count($this->tokens) - 1);
        }

        public function setAttributes($token_idx, $attrs, $append = array())
        {
            $this->tokens[$token_idx]->setAttributes($attrs, $append);
            return $this;
        }

        public function getHTML($tag, $class = null, $id = null, $args = array())
        {
            $idx = $this->findTokenIndex($tag, $class, $id);
            $this->setAttributes($idx, $args, array('class' => true));
            return $this->getHTMLFromIdxToIdx($idx, $idx);
        }
    }
}

/**
 * Class Name: PG_WCPagination
 * GitHub URI:
 * Description:
 * Version: 1.0
 * Author: Matjaz Trontelj - @pinegrow
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

if(! class_exists( 'PG_WCPagination' )) {
    class PG_WCPagination
    {
        static $args = array();

        static function getCurrentPage()
        {
            return self::$args['current'];
        }

        static function getMaxPages()
        {
            return self::$args['total'];
        }

        static function isPaginated()
        {
            return self::getMaxPages() > 1;
        }

        static function getPageUrl($n)
        {
            $link = str_replace('%_%', 1 == $n ? '' : self::$args['format'], self::$args['base']);
            $link = str_replace('%#%', $n, $link);
            if (!empty(self::$args['add_args'])) {
                $link = add_query_arg(self::$args['add_args'], $link);
            }
            if (!empty(self::$args['add_fragment'])) {
                $link .= self::$args['add_fragment'];
            }
            return $link;
        }

        static function getNextPageUrl()
        {
            $max_pages = self::getMaxPages();
            if (self::getCurrentPage() < $max_pages) {
                return self::getPageUrl(self::getCurrentPage() + 1);
            }
            return null;
        }

        static function getPreviousPageUrl()
        {
            if (self::getCurrentPage() > 1) {
                return self::getPageUrl(self::getCurrentPage() - 1);
            }
            return null;
        }

        static function getHrefAttribute($url)
        {
            if (empty($url)) {
                return 'href="javascript:void(0)"';
            } else {
                return 'href="' . esc_url($url) . '"';
            }
        }

        static function getPreviousHrefAttribute()
        {
            return self::getHrefAttribute(self::getPreviousPageUrl());
        }

        static function getNextHrefAttribute()
        {
            return self::getHrefAttribute(self::getNextPageUrl());
        }
    }
}