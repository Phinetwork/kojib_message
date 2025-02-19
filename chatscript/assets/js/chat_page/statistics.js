var show_statistics_request = null;

$('body').on('click', '.show_statistics', function(e) {
    open_column('second');

    if ($(this).hasClass('stat_menu_item')) {
        $('.main .middle > .content > .statistics > .stats_tabs > ul > li').removeClass('active');

        if ($(this).attr('statistics') !== undefined) {
            var stat_menu_item = $(this).attr('statistics');
            $('.main .middle > .content > .statistics > .stats_tabs > ul > li[statistics="'+stat_menu_item+'"]').addClass('active');
        } else {
            $(this).addClass('active');
        }
    } else {
        $('.main .middle > .content > .statistics > .stats_tabs > ul > li').removeClass('active');
        $('.main .middle > .content > .statistics > .stats_tabs > ul > li').eq(0).addClass('active');
    }

    show_statistics($(this));
});

function show_statistics(load_data) {

    $('.main .middle > .content > .statistics > .contents').html('');
    $('.main .middle > .content > .statistics > .loader').show();
    $('.main .middle > .content > div').addClass('d-none');
    $('.main .middle > .foot').addClass('d-none');

    $('.main .middle > .content > .statistics').removeClass('d-none');
    $('.main .middle > .group_headers > .header_content').html('');
    $('.main .middle > .group_headers').removeClass('header_content_loaded');
    $('.main .middle > .group_headers').addClass('d-none');

    document.title = default_meta_title;
    var browser_address_bar = baseurl;

    if (load_data.attr('statistics') !== undefined && load_data.attr('statistics') === 'wallet') {
        browser_address_bar = browser_address_bar+'wallet/';
    }

    history.pushState({}, null, browser_address_bar);

    var data = {
        load: 'statistics',
    };

    if (load_data.attr('statistics') !== undefined) {
        data["statistics"] = load_data.attr('statistics');
        $('.main .middle>.content>.statistics>.header>.icons>span.show_statistics').attr('statistics', data["statistics"]);
    } else {
        $('.main .middle>.content>.statistics>.header>.icons>span.show_statistics').removeAttr('statistics');
    }

    if (load_data.attr('stat_title') !== undefined) {
        var stat_title = load_data.attr('stat_title');
        $('.main .middle>.content>.statistics>.header>.left>.title > span').replace_text(language_string(stat_title));
        $('.main .middle>.content>.statistics>.header>.icons>span.show_statistics').attr('stat_title', stat_title);
        $('.main .middle>.content>.statistics>.stats_tabs').hide();
    } else {
        $('.main .middle>.content>.statistics>.header>.left>.title > span').replace_text(language_string('statistics'));
        $('.main .middle>.content>.statistics>.header>.icons>span.show_statistics').removeAttr('stat_title');
        $('.main .middle>.content>.statistics>.stats_tabs').show();
    }


    if (user_csrf_token !== null) {
        data["csrf_token"] = user_csrf_token;
    }

    if (user_login_session_id !== null && user_access_code !== null && user_session_time_stamp !== null) {
        data["login_session_id"] = user_login_session_id;
        data["access_code"] = user_access_code;
        data["session_time_stamp"] = user_session_time_stamp;
    }

    show_statistics_request = $.ajax({
        type: 'POST',
        url: api_request_url,
        data: data,
        async: true,
        beforeSend: function() {
            if (show_statistics_request != null) {
                show_statistics_request.abort();
                show_statistics_request = null;
            }
        },
        success: function(data) {}
    }).done(function(data) {
        if (isJSON(data)) {
            data = $.parseJSON(data);

            var modules = data.module;
            $.each(modules, function(module_index, module) {
                var contents = '';
                if (module.type === 'numbers') {

                    contents += '<div class="total_numbers container">';
                    contents += '<div class="row">';

                    var items = module.items;

                    $.each(items, function(item_index, item) {

                        var item_attributes = '';

                        if (item.attributes !== undefined) {
                            $.each(item.attributes, function(attr_key, attr_val) {
                                item_attributes = item_attributes+attr_key+'="'+attr_val+'" ';
                            });
                        }

                        contents += '<div class="item col-lg-4">';
                        contents += '<div '+item_attributes+'>';

                        if (item.button !== undefined) {
                            contents += '<div class="button_div">';
                            contents += '<span class="title">'+item.title+'</span>';
                            contents += '<span class="button">'+item.button+'</span>';
                            contents += '</div>';
                        } else if (item.title !== undefined) {
                            contents += '<span class="title">'+item.title+'</span>';
                        }
                        contents += '<span class="result">'+item.result+'</span>';
                        contents += '</div>';
                        contents += '</div>';
                    });

                    contents += '</div>';
                    contents += '</div>';

                } else if (module.type === 'list') {
                    var list = module.items;
                    contents += '<div class="table_content container">';
                    contents += '<div class="row">';
                    contents += '<div class="col-12">';
                    contents += '<div class="table_list">';

                    if (module.title !== undefined) {
                        contents += '<h4 class="heading">'+module.title+'</h4>';
                    }

                    $.each(list, function(list_items_index, list_items) {
                        contents += '<div class="item">';
                        $.each(list_items, function(list_item_index, list_item) {
                            $.each(list_item, function(item_index, item) {
                                if (item.type === 'image') {

                                    var image_class_name = '';

                                    if (item.class_name !== undefined) {
                                        image_class_name = ' '+item.class_name;
                                    }
                                    contents += '<div class="image'+image_class_name+'">';
                                    contents += '<span>';
                                    contents += '<img src="'+item.image+'" onerror="this.onerror=null; this.src='+"'"+blur_img_url+"'"+';"/>';
                                    contents += '</span>';
                                    contents += '</div>';
                                } else if (item.type === 'info') {
                                    contents += '<div class="info">';
                                    if (item.bold_text !== undefined) {
                                        contents += '<span class="bold_text">'+item.bold_text+'</span>';
                                    }
                                    contents += '<span>'+item.text+'</span>';
                                    contents += '</div>';
                                } else if (item.type === 'button') {

                                    var btn_class_name = '';

                                    if (item.class_name !== undefined) {
                                        btn_class_name = ' '+item.class_name;
                                    }

                                    contents += '<div class="button'+btn_class_name+'">';
                                    contents = contents+'<span ';

                                    if (item.attributes !== undefined) {
                                        $.each(item.attributes, function(attrkey, attrval) {
                                            contents += attrkey+'="'+attrval+'" ';
                                        });
                                    }

                                    contents += '>'+item.text+'</span>';

                                    contents += '</div>';
                                }
                            });
                        });
                        contents += '</div>';
                    });



                    contents += '</div>';
                    contents += '</div>';
                    contents += '</div>';
                    contents += '</div>';
                }
                $('.main .middle > .content > .statistics > .contents').append(contents);
            });

            $('.main .middle > .content > .statistics > .loader').hide();

        } else {
            console.log('ERROR : ' + data);
        }
    }) .fail(function(qXHR, textStatus, errorThrown) {
        if (qXHR.statusText !== 'abort' && qXHR.statusText !== 'canceled') {
            console.log('ERROR : ' + data);
        }
    });
}