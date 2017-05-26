jQuery(document).ready(function($) {
    'use strict';

    //Post settings
    function post_format_setting() {

        if ($('#post-format-image').is(':checked')) {
            $('#meetheme_post_metas').fadeIn();
            $('.cmb_id_meetheme_image_gallery').hide();
            $('.cmb_id_meetheme_post_image').fadeIn();
            $('.cmb_id_meetheme_post_video_embed').hide();
            $('.cmb_id_meetheme_post_audio_embed').hide();

        } else if ($('#post-format-gallery').is(':checked')) {
            $('#meetheme_post_metas').fadeIn();
            $('.cmb_id_meetheme_image_gallery').fadeIn();
            $('.cmb_id_meetheme_post_image').hide();
            $('.cmb_id_meetheme_post_video_embed').hide();
            $('.cmb_id_meetheme_post_audio_embed').hide();

        } else if ($('#post-format-video').is(':checked')) {
            $('#meetheme_post_metas').fadeIn();
            $('.cmb_id_meetheme_image_gallery').hide();
            $('.cmb_id_meetheme_post_image').hide();
            $('.cmb_id_meetheme_post_video_embed').fadeIn();
            $('.cmb_id_meetheme_post_audio_embed').hide();

        } else if ($('#post-format-audio').is(':checked')) {
            $('#meetheme_post_metas').fadeIn();
            $('.cmb_id_meetheme_image_gallery').hide();
            $('.cmb_id_meetheme_post_image').hide();
            $('.cmb_id_meetheme_post_video_embed').hide();
            $('.cmb_id_meetheme_post_audio_embed').fadeIn();

        } else {
            $('#meetheme_post_metas').hide();
        }
    }
    post_format_setting();

    var select_type = $('#post_formats_select input');

    $(this).change(function() {
        post_format_setting();
    });

    // Portfolio settings
    function portfolio_setting() {
        var select_type = $('#meetheme_portfolio_type option');

        var portfolio_standard  = $('.cmb_id_meetheme_portfolio_standard');
        var portfolio_gallery   = $('.cmb_id_meetheme_portfolio_gallery');
        var portfolio_image     = $('.cmb_id_meetheme_portfolio_image');
        var portfolio_video     = $('.cmb_id_meetheme_portfolio_video');
        var portfolio_audio     = $('.cmb_id_meetheme_portfolio_audio');

        select_type.each(function() {
            if (($(this).attr('selected') == 'selected') && ($(this).attr('value') == 'standard')) {
                portfolio_gallery.hide();
                portfolio_image.hide();
                portfolio_video.hide();
                portfolio_audio.hide();
            } else if (($(this).attr('selected') == 'selected') && ($(this).attr('value') == 'video')) {
                portfolio_gallery.hide();
                portfolio_image.hide();
                portfolio_video.fadeIn();
                portfolio_audio.hide();
            } else if (($(this).attr('selected') == 'selected') && ($(this).attr('value') == 'image')) {
                portfolio_gallery.hide();
                portfolio_image.fadeIn();
                portfolio_video.hide();
                portfolio_audio.hide();
            } else if (($(this).attr('selected') == 'selected') && ($(this).attr('value') == 'gallery')) {
                portfolio_gallery.fadeIn();
                portfolio_image.hide();
                portfolio_video.hide();
                portfolio_audio.hide();
            } else if (($(this).attr('selected') == 'selected') && ($(this).attr('value') == 'audio')) {
                portfolio_gallery.hide();
                portfolio_image.hide();
                portfolio_video.hide();
                portfolio_audio.fadeIn();
            }
        });
    }
    portfolio_setting();

    var select_type = $('#meetheme_portfolio_type');

    $(this).change(function() {
        portfolio_setting();
    });


    function time_line_format_setting () {
        var select_time_line = $('#meetheme_time_line_class option');

        select_time_line.each(function() {

            if ($(this).attr('selected') == 'selected' ){
                var select_time_line_val = $(this).val();
                $('.cmb_id_meetheme_time_line_class .cmb_metabox_description').html('<span class="fa '+select_time_line_val+'" style="font-size:30px;color:#C69C6D;"></span>');
            }

        });
    }
    time_line_format_setting();

    var select_type = $('#meetheme_time_line_class');

    $(this).change(function() {
        time_line_format_setting();
    });


    function services_format_setting () {
        var select_services = $('#meetheme_service_class option');

        select_services.each(function() {

            if ($(this).attr('selected') == 'selected' ){
                var select_services_val = $(this).val();
                $('.cmb_id_meetheme_service_class .cmb_metabox_description').html('<span class="fa '+select_services_val+' fa-5" style="font-size:50px;color:#C69C6D;"></span>');
            }

        });
    }
    services_format_setting();

    var select_type = $('#meetheme_service_class');

    $(this).change(function() {
        services_format_setting();
    });


});