$(document).ready(function() {
    var frontend_address = '/frontend_assets';
    var backend_address = '/backend_assets';
    var up_site = ''; 
    // var up_site = '/dhasite';
    // var frontend_address = '/public/frontend_assets';
    // var backend_address  = '/public/backend_assets';

    // *****************  input_image / change ***************** 
    $('.input_image_file').change(function() {
        var site_url = window.location.origin;
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg" || ext == "jfif")) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.preview_image_file').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('.preview_image_file').attr('src', site_url + backend_address + '/assets/images/no_preview.jpg');
        }
    });

    // *****************  input_logo_image / change ***************** 
    $('.input_logo_image_file').change(function() {
        var site_url = window.location.origin;
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg" || ext == "jfif")) //
        {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.preview_logo_image_file').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } //
        else //
        {
            $('.preview_logo_image_file').attr('src', site_url + backend_address + '/assets/images/no_preview.jpg');
        }
    });

    // *****************  .remove image / click ***************** 
    $('.delete_image_button').click(function() {
        var site_url = window.location.origin;
        $('.preview_image_file').attr('src', site_url + backend_address + '/assets/images/no_preview.jpg');
        $('.input_image_file').val('');
        $('.input_hidden_image_name').val('');
    });

    // *****************  .remove logo image / click ***************** 
    $('.delete_logo_image_button').click(function() {
        var site_url = window.location.origin;
        $('.preview_logo_image_file').attr('src', site_url + backend_address + '/assets/images/no_preview.jpg');
        $('.input_logo_image_file').val('');
        $('.input_hidden_logo_image_name').val('');
    });

    // *****************  .select-category-level / click ***************** 
    $('.select-category-level').on('click', function(event) {
        if ($('#input_category_level1').is(':checked')) {
            $("#input_select_category_level").prop("disabled", true);
            $("#input_select_category_level").val("");
        } else if ($('#input_category_level2').is(':checked')) {
            $("#input_select_category_level").removeAttr("disabled");
        }
    });

    // *****************  .portfolio_delete_button / click ***************** 
    // $('.portfolio_delete_button').on('click', function(event) {
    //     event.preventDefault();
    //     var portfolioid = $(this).data('portfolioid');
    //     var delete_url = '/admin/delete_portfolio';
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     }); //$.ajaxSetup
    //     $.ajax({
    //         url: delete_url,
    //         type: 'POST',
    //         data: {
    //             "_token": $('#token').val(),
    //             portfolioid: portfolioid
    //         },
    //         success: function(res) {
    //             if ((res['success']) === 'success') {
    //                 $("#notice")
    //                     .show()
    //                     .html('<div class="alert alert-danger">' + ' portfolio = ' + res['portfolio_title'] + '  ' + '<strong>Successfully !</strong> deleted.</div>')
    //                     .fadeOut(4000);
    //                 $('#tr_' + res['portfolio_id']).remove();
    //             } else if ((res['success']) === 'fail') {
    //                 $("#notice")
    //                     .show()
    //                     .html('<div class="alert alert-danger">' + ' portfolio = ' + res['portfolio_title'] + '  ' + '<strong> Can not be  deleted.!</strong></div>')
    //                     .fadeOut(4000);
    //             }
    //         }, //success : function(res)
    //         fail: function() {}
    //     });

    // });


    // *****************  .li_item_image_delete / click ***************** 
    $('.li_item_image_delete').on('click', function(event) {
        event.preventDefault();
        var image_id = $(this).data('image_id');
        var delete_url = '/admin/delete_gallery_image';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //$.ajaxSetup
        $.ajax({
            url: delete_url,
            type: 'POST',
            data: {
                "_token": $('#token').val(),
                image_id: image_id
            },
            success: function(res) {
                if ((res['success']) === 'success') {
                    $("#notice")
                        .show()
                        .html('<div class="alert alert-danger">' + ' görüntü = ' + res['image_title'] + '  ' + '<strong>Başarıyla !</strong> silindi.</div>')
                        .fadeOut(4000);
                    $('#image_in_gallery_' + res['image_id']).remove();
                } else if ((res['success']) === 'fail') {
                    $("#notice")
                        .show()
                        .html('<div class="alert alert-danger">' + ' görüntü = ' + res['image_title'] + '  ' + '<strong> silinemiyor!!!</strong></div>')
                        .fadeOut(4000);
                }
            }, //success : function(res)
            fail: function() {}
        });
    });

    // *****************  replaceAt / function ***************** 
    function replaceAt(s, n, t) // replace in s string t char on the index of n 
    {
        return s.substring(0, n) + t + s.substring(n + 1);
    }

    // *****************  make_slug_text / function ***************** 
    function make_slug_text(input_text) {
        var turkish_letters_1 = ['Ü', 'ü', 'Ö', 'ö', 'Ş', 'ş', 'İ', 'ı', 'Ğ', 'ğ', 'Ç', 'ç'];
        var turkish_letters_2 = ['U', 'u', 'O', 'o', 'S', 's', 'I', 'i', 'G', 'g', 'C', 'c'];

        for (var i = 0; i < input_text.length; i++) //
        {
            letter_index = turkish_letters_1.indexOf(input_text.charAt(i));
            if (letter_index > -1) {
                replace_letter = turkish_letters_2[letter_index];
                input_text = replaceAt(input_text, i, replace_letter)
            }
        }

        input_text = input_text.replace(/  /g, ' ');
        input_text = input_text.replace(/  /g, ' ');
        var slug_text = input_text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        return slug_text;
    }

    // *****************  .input_marka_name / keyup ***************** 
    $('#input_marka_name').on('keyup', function(event) {
        var marka_name_val = $('#input_marka_name').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_marka_slug').val(slug_text);
    });

    // *****************  .input_category_name / keyup ***************** 
    $('#input_category_name').on('keyup', function(event) {
        var marka_name_val = $('#input_category_name').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_category_slug').val(slug_text);
    });

    // *****************  .input_portfolio_name / keyup ***************** 
    $('#input_portfolio_title').on('keyup', function(event) {
        var marka_name_val = $('#input_portfolio_title').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_portfolio_slug').val(slug_text);
    });

    // *****************  .input_filter_name / keyup ***************** 
    $('#input_filter_name').on('keyup', function(event) {
        var marka_name_val = $('#input_filter_name').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_filter_slug').val(slug_text);
    });

    // *****************  .input_contenthead_title / keyup ***************** 
    $('#input_contenthead_title').on('keyup', function(event) {
        var marka_name_val = $('#input_contenthead_title').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_contenthead_slug').val(slug_text);
    });

    // *****************  .input_contenthead_title / keyup ***************** 
    $('#input_contentitem_title').on('keyup', function(event) {
        var marka_name_val = $('#input_contentitem_title').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_contentitem_slug').val(slug_text);
    });

    // *****************  .input_contenttype_title / keyup ***************** 
    $('#input_contenttype_title').on('keyup', function(event) {
        var marka_name_val = $('#input_contenttype_title').val();
        slug_text = make_slug_text(marka_name_val)
        $('#input_contenttype_slug').val(slug_text);
    });

    // *****************  .confirmDelete / show.bs.modal ***************** 
    // Dialog show event handler
    $('#confirmDelete').on('show.bs.modal', function(e) {
        var delete_button = e.relatedTarget;
        $(this).find('.modal-footer #confirm').removeClass('btn-secondary').addClass('btn-danger');
        $(this).find('.modal-footer #confirm').attr("disabled", false);
        var modelname = $(delete_button).data('modelname');
        var title = $(delete_button).data('title');
        var modelid = $(delete_button).data('id');
        var final_delete_possibility = 1; // default is ok for delete. (deleteable)
        var final_message = '';
        var possibility_array = [];
        check_delete_possibility(modelname, modelid, function(result) {
            possibility_array = result;
        });
        if (possibility_array.length == 0) //
        {
            // alert('possibility_array.length == ' + '1');
            final_delete_possibility = 1;
        } else //
        {
            // alert('possibility_array.length == ' + '0');
            var i;
            for (i = 0; i < possibility_array.length; ++i) {
                if (possibility_array[i]['related_count'] > 0) //
                {
                    if (possibility_array[i]['is_delete_allowed_with_all_children'] == false) //
                    {
                        final_delete_possibility = 0;
                        final_message = final_message + possibility_array[i]["message_first_part"] + ' ' +
                            '"' + possibility_array[i]["object_name"] + '"  ' +
                            possibility_array[i]['related_count'] + ' ' +
                            possibility_array[i]["message_second_part"] + '\n' + '<br>';
                    } else // ['is_delete_allowed_with_all_children'] == true
                    {
                        final_message = final_message + possibility_array[i]["message_first_part"] + ' ' +
                            possibility_array[i]['related_count'] + ' ' +
                            possibility_array[i]["message_second_part"] + '\n' + '<br>';
                    }
                }
            }
        }

        if (final_delete_possibility == 0) //
        {
            final_message = final_message + ' silmek mümkün değildir.' + '<br>';
        } else // final_delete_possibility == 1
        {
            final_message = final_message + ' Bu item silmek istediğinizden emin misiniz?' + '\n' + '<br>';
        }

        $(this).find('.modal-body p').html(final_message);
        $(this).find('.modal-title').text(title);
        if (final_delete_possibility == 1) {
            $(this).find('.modal-footer #confirm').data('delete_button', delete_button);
        } else {
            $(this).find('.modal-footer #confirm').removeClass('btn-danger').addClass('btn-secondary');
            $(this).find('.modal-footer #confirm').attr("disabled", true);
        }
    });

    // *****************  .confirmDelete.modal-footer #confirm / click ***************** 
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function() {
        // alert('on click');
        var delete_btn = $(this).data('delete_button');
        send_delete_request_by_ajax(delete_btn);
        $('#confirmDelete').modal('hide');
    });

    // *****************  function check_delete_possibility ***************** 
    function check_delete_possibility(modelname, modelid, callback) {
        var site_url = window.location.origin;
        var delete_url = up_site +'/admin/delete_possibility_' + modelname.toLowerCase();
        // alert(delete_url);
        // alert('modelid = ' + modelid);
        // alert('modelname = ' + modelname);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //$.ajaxSetup
        $.ajax({
            url: delete_url,
            type: 'POST',
            data: {
                "_token": $('#token').val(),
                modelid: modelid,
                modelname: modelname
            },
            async: false,
            success: function(res) {
                // alert('res = ' + res);
                callback(res);
                // alert(result_array[0]['model_name']);
            },
            fail: function() {
                alert('fail');
            }
        });
    }

    // *****************  function send_delete_request_by_ajax ***************** 
    function send_delete_request_by_ajax(delete_button) {
        var site_url = window.location.origin;
        var model_id = $(delete_button).data('id');
        var model_name = $(delete_button).data('modelname');
        model_name = model_name.toLowerCase();
        var delete_url =  up_site +'/admin/delete_' + model_name;
        // alert(delete_url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //$.ajaxSetup

        $.ajax({
            url: delete_url,
            type: 'POST',
            data: {
                "_token": $('#token').val(),
                model_id: model_id
            },
            success: function(res) {
                // alert(res);
                if ((res['success']) === 'success') {
                    $("#notice")
                        .show()
                        .html('<div class="alert alert-danger">' + model_name + ' = ' + res['object_name'] + '  ' + '<strong>Successfully !</strong> deleted.</div>')
                        .fadeOut(4000);
                    $('#tr_' + res['object_id']).remove();
                    $('.tr_' + res['object_id']).remove();
                } else if ((res['success']) === 'fail') {
                    $("#notice")
                        .show()
                        .html('<div class="alert alert-danger">' + model_name + ' = ' + res['object_name'] + '  ' + '<strong> Can not be  deleted.!</strong></div>')
                        .fadeOut(4000);
                }
            }, //success : function(res)
            fail: function() { alert('faıl'); }
        });
    }

    // *****************  input_marka_logo_file / change ***************** 
    $('#input_contentitem_contenttype_id').change(function() {
        // alert($(this).val());
        var site_url = window.location.origin;
        var contenttype_id = $(this).val();
        var contetnttype_slug = $(this).find(':selected').data("contetnttypeslug");

        var new_btn_url = "";
        if ($(this).val() == "") {
            new_btn_url = site_url + '/contentitem/';
        } else {
            new_btn_url = site_url + '/admin/add_contentitem/' + contenttype_id;
        }

        $('#btn_add_contentitem').attr('onclick', "window.location.href = '" + new_btn_url + "'");

        url_contentitem_slug = '/contentitem/' + contetnttype_slug;
        window.location.href = site_url + up_site + url_contentitem_slug;
    });

    $('#btn_add_contentitem').click(function() {
        if ($('#input_contentitem_contenttype_id').val() == "") {
            $('#btn_add_contentitem').attr('onclick', "");
        }
    });

    // *****************  input_custom order / change ***************** 
    $('.input_contentitem_custom_sorting').on('keyup', function(event) {
        var user_input = $(this).val();
        user_input = user_input.replace(/[^0-9]/g, '');
        $(this).val(user_input);
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') //
        {
            // alert('You pressed a "enter" key in textbox');	
            var site_url = window.location.origin;
            var site_url = site_url; //+ up_site;
            var id = $(this).data("id");
            var new_order = $(this).val();
            var site_content_type_id = $(this).data("contenttype_id");
            var contetnttype_slug = $(this).data("contetnttype_slug");
            // alert(contetnttype_slug);
            reOrder_url = up_site + '/admin/reorder_contentitem';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //$.ajaxSetup
            $.ajax({
                url: reOrder_url,
                type: 'POST',
                data: {
                    "_token": $('#token').val(),
                    id: id,
                    new_order: new_order,
                    site_content_type_id: site_content_type_id,
                },
                async: false,
                success: function(res) {
                    // alert('res = ' + res);
                    var url_contentitem_slug = '/contentitem/' + contetnttype_slug;
                    window.location.href = site_url + up_site + url_contentitem_slug;
                },
                fail: function() {
                    alert('fail');
                }
            });
        } // if(keycode == '13')
        event.stopPropagation();
    });

    $('.user_grant_admin_access').on('click', function(event) {
        event.preventDefault();
        var user_id = $(this).data('id');
        var isadmin = $(this).data('isadmin');
        var site_url = window.location.origin;
        var grant_admin_access_url = up_site + '/admin/user-admin-access/grant_admin_access';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //$.ajaxSetup
        $.ajax({
            url: grant_admin_access_url,
            type: 'POST',
            data: {
                "_token": $('#token').val(),
                user_id: user_id,
                isadmin: isadmin,
            },
            success: function(res) {
                if ((res['success']) === 'success') //
                {
                    var locator = "#is_admin" + user_id;
                    $(locator).text('');
                    $(locator).text(res['newIsAdmin']);
                    var button_clicked = '#' + 'user_grant_admin_access' + user_id;
                    $(button_clicked).data('isadmin', res['newIsAdmin']);
                }
            }, //success : function(res)
            fail: function() {}
        });

    });

});