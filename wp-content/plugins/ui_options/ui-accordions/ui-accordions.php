<?php
/*
Plugin Name: UI Accordions
Description: Accordions shortcodes for themes developed by Urge Interactive. Example: [collapse open="yes" title="Title Text" class="some_name"] Content [/collapse]
Version: 1.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/


//[collapse open="yes" title="Title Text" class="some_name"]
function ui_accordion_shortcode( $atts, $content ){
    $options_accordions = get_option('ui_accordions');
    ob_start();

    if(empty($content) || !$options_accordions){
        return ob_get_clean();
    }

    $id = wp_generate_password( 8, false );

?>
    <div class="ui-accordions panel panel-default">
        <!-- panel-heading -->
        <div class="panel-heading <?php echo(!empty($atts['class'])) ? $atts['class']:''?>" >
            <a data-toggle="collapse" href="#<?php echo$id?>" class="panel-title">
                <?php echo(!empty($atts['title'])) ? $atts['title']:'empty'?>
            </a>
        </div>
        <!-- panel body -->
        <div id="<?php echo$id?>" class="panel-collapse collapse <?php echo(!empty($atts['open']) && $atts['open']=='yes') ? 'in':''?> <?php echo(!empty($atts['class'])) ? $atts['class']:''?>">
            <div class="panel-body">
                <?php echo$content;?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode( 'collapse', 'ui_accordion_shortcode' );
