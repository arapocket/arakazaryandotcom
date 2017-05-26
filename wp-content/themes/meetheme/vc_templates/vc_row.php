<?php
$output = $dt_id = $dt_bg_image = $dt_bg_repeat = $dt_bg_color = $dt_color_opacity = $dt_text_scheme = $dt_class = $dt_no_mb = $dt_row_type = '';
extract(shortcode_atts(array(
    'dt_id'             => '',
    'bg_image'          => '',
    'dt_bg_repeat'      => '',
    'bg_color'          => '',
    'dt_color_opacity'  => '',
    'dt_text_scheme'    => '',
    'dt_padding_top'    => '',
    'dt_padding_bottom' => '',
    'dt_class'          => '',
    'dt_no_mb'          => '',
    'dt_row_type'       => ''
), $atts));


$dt_class = $this->getExtraClass($dt_class);

    $style = '';

    // Color overlay
    $rgbcolor = '255, 255, 255';
    if(!empty($bg_color)) {
        $rgbcolor = pluton_hex2rgb($bg_color);
    }

    // Opacity
    $cop = '0.70';
    if(!empty($dt_color_opacity)) {
        if($dt_color_opacity  == 100) {
            $cop = '1';
        }
        else if($dt_color_opacity  < 100) {
            $cop = '0.'.$dt_color_opacity.'';
        }
    }

    // BG Image
    $has_image = false;
    if((int)$bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false) {
        $has_image = true;
        $style .= "background-image: url(".$image_url.");";
    }
    if(!empty($dt_bg_repeat) && $has_image) {
        if($dt_bg_repeat === 'no-repeat') {
            $style .= "background-repeat:no-repeat;";
        } elseif($dt_bg_repeat === 'repeat-x') {
            $style .= "background-repeat:repeat-x;";
        } elseif($dt_bg_repeat === 'repeat-y') {
            $style .= 'background-repeat: repeat-y;';
        } elseif($dt_bg_repeat === 'repeat') {
            $style .= 'background-repeat: repeat;';
        }
        $style .= 'background-attachment: fixed;';
        $style .= 'background-position: 50% 0;';
    }

    // Padding
    $padding = '';
    if(!empty($dt_padding_top)) {
        $padding .= 'padding-top: '.$dt_padding_top.'px;';
    }
    if(!empty($dt_padding_bottom)) {
        $padding .= 'padding-bottom: '.$dt_padding_bottom.'px;';
    }

if ($dt_id=='') {
    $dt_id_rand = rand(100,1000);
    $dt_id = 'pluton-'.$dt_id_rand;
}
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row vc_row-fluid '.$dt_class.' '.$dt_no_mb . ' ' . $dt_row_type, $this->settings['base']);
if( (!empty($bg_image)) || (!empty($bg_color)) ) {
    $output .= '<div class="'.$dt_text_scheme.'" style="'.$padding.' background-color: rgba('.$rgbcolor.', '.$cop.');">';
}
    $output .= '<div id="'.$dt_id.'" class="'.$css_class.'" style="'.$style.'">';
        $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>'.$this->endBlockComment('row');
if( (!empty($bg_image)) || (!empty($bg_color)) ) {
    $output .= '<div class="clear"></div></div>';
}

echo $output;