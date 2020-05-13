//remove nice select so I can post select values
$('select').niceSelect('destroy');

//options
var pcop_option_prefix = "option";
if ($('#mijoshop').length && $('[name^="option_oc["]').length) { // 
    pcop_option_prefix = "option_oc";
} else if (pcop_options_container().find('[id^="input-option"][name^="option_oc["]').length) { // joocart
    pcop_option_prefix = "option_oc";
}
var pcop_theme_name = 'default';

// option[XXX]
function pcop_get_product_option_id_from_name(name) {

    var copu_product_option = 'copu_product_id';
    var prefix_quantity_per_option = 'quantity_per_option';
    if (name.substr(0, copu_product_option.length) == copu_product_option) {
        var str = name.substr(copu_product_option.length + 1);
    } else if (name.substr(0, prefix_quantity_per_option.length) == prefix_quantity_per_option) {
        var str = name.substr(prefix_quantity_per_option.length + 1);
    } else {
        var str = name.substr(pcop_option_prefix.length + 1);
    }
    // console.log('name:'+name);
    var bracket_pos = str.indexOf(']');
    if (bracket_pos != -1) {
                                // console.log('id: '+str.substr(0, bracket_pos));
        return str.substr(0, bracket_pos);
    }
}

function pcop_is_parent_value_selected(parent_option_id, parent_option_values) {

    var result = false;

    pcop_options_container().find('input:checkbox[name="' + pcop_option_prefix + '[' + parent_option_id + '][]"]:checked, input:radio[name="' + pcop_option_prefix + '[' + parent_option_id + ']"]:checked, select[name^="' + pcop_option_prefix + '[' + parent_option_id + ']"], input[type=hidden][name^="' + pcop_option_prefix + '[' + parent_option_id + ']"]')
        .each(function() {
            // console.log( $(this));
            // console.log('value: '+ $(this).val());
            // console.log('parent_option_values: '+parent_option_values);
            // console.log('inArray: '+ $.inArray($(this).val(), parent_option_values));
            if ($(this).val() && $.inArray($(this).val(), parent_option_values) != -1) {
                // console.log('inarray');
                result = true;
                return false; // stop the loop
            }
        });
        // console.log('result1:'+result); 
    return result;
}


var pcop_delayed_first_option_change_call_timer = 0;

function pcop_delayed_first_option_change_call(start_event) {

    clearTimeout(pcop_delayed_first_option_change_call_timer);
    if (start_event) {
        pcop_options_container().find('[name^="' + pcop_option_prefix + '"]:first').change();
    } else {
        pcop_delayed_first_option_change_call_timer = setTimeout(function() {
            pcop_delayed_first_option_change_call(true);
        }, 200);
    }

}

function pcop_change_option_visibility(product_option_id, option_toggle) {

    var option_name = pcop_option_prefix + '[' + product_option_id + ']';
    var option_was_visible = pcop_options_container().find('[name^="' + option_name + '"]').closest('div.form-group').is(':visible');

    pcop_options_container().find('[name^="' + option_name + '"]').closest('div.form-group').toggle(option_toggle);
    if (pcop_options_container().find('[name^="' + option_name + '"]').closest('div.form-group').next().is('br')) {
        pcop_options_container().find('[name^="' + option_name + '"]').closest('div.form-group').next().toggle(option_toggle);
    }

    pcop_options_container().find('[name^="quantity_per_option[' + product_option_id + ']"]').closest('div.form-group').toggle(option_toggle);

    var copu_form_group = pcop_options_container().find('[name^="copu_product_id[' + product_option_id + ']"]').closest('div.form-group');
    copu_form_group.toggle(option_toggle);

    if (pcop_options_container().find('#copu-tbl-' + product_option_id) && pcop_options_container().find('#copu-tbl-' + product_option_id).parent().is('.option')) {
        pcop_options_container().find('#copu-tbl-' + product_option_id).parent().toggle(option_toggle);
        if (!option_toggle && pcop_options_container().find('#copu-tbl-' + product_option_id).find('a[onclick^="deleteUpload"]').length) {

            pcop_options_container().find('#copu-tbl-' + product_option_id).find('tr[id^="upload"]').each(function() {
                if (pcop_options_container().find('#copu-tbl-' + product_option_id).find('tr[id^="upload"]').length) {
                    var upload_id = $(this).attr('id').substr(6);
                    var remove_url = 'index.php?route=myoc/copu/delete&upload_id=' + upload_id;

                    $.ajax({
                        url: remove_url,
                        dataType: 'json',
                        success: function(json) {
                            if (json['error']) {
                                alert(json['error']);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                        }
                    });
                }
            });

            pcop_options_container().find('#copu-tbl-' + product_option_id).find('tbody tr[id^="upload"]').remove();
            pcop_options_container().find('#copu-tbl-' + product_option_id).find('a[onclick^="deleteUpload"]').remove();
            pcop_options_container().find('#copu-tbl-' + product_option_id).find('tbody').find('tr.empty').remove();
            pcop_options_container().find('#copu-tbl-' + product_option_id).find('tbody').prepend(empty_row);

        }
    }

    var values_changed = false;

    if (option_toggle) { // visible

        if (!option_was_visible) { // became  visible

            // default values (specific for text fields)
            if (!$('input[type="text"][name="' + option_name + '"]').val() && pcop_html_default_values && pcop_html_default_values[product_option_id]) {
                $('input[type="text"][name="' + option_name + '"]').val(pcop_html_default_values[product_option_id]);
                // direct evant call for text field
                pcop_delayed_first_option_change_call();
                //$('input[type="text"][name="'+option_name+'"]').change();
            }

            if (typeof(qpo_resetQuantities) == 'function') {
                qpo_resetQuantities(2, product_option_id); //reset to defaults
            }

        }

    } else { // hidden
        if (pcop_options_container().find('select[name^="' + option_name + '"]').val()) {

            pcop_options_container().find('select[name^="' + option_name + '"]').val('');
            pcop_options_container().find('select[name^="' + option_name + '"]').prop('value', ''); // needed sometimes
            values_changed = true;


        }
        if (pcop_options_container().find('input:checkbox[name^="' + option_name + '"]:checked').length) {
            pcop_options_container().find('input:checkbox[name^="' + option_name + '"]:checked').prop('checked', false);
            values_changed = true;
        }
        if (pcop_options_container().find('input:radio[name^="' + option_name + '"]:checked').length) {
            pcop_options_container().find('input:radio[name^="' + option_name + '"]:checked').prop('checked', false);
            values_changed = true;
        }

        var elem_other_option = pcop_options_container().find('input:not(:radio):not(:checkbox)[name^="' + option_name + '"]');
        if (elem_other_option.length &&
            elem_other_option.val()) {

            var val_before = elem_other_option.val();
            elem_other_option.val('');

            if (elem_other_option.val()) {
                // to fix a bug with not working "val()"
                elem_other_option.prop('value', '');
            }

            // Product Image Option DropDown compatibility
            if (elem_other_option.closest('.select').length && $.fn.ddslick && elem_other_option.closest('.select').data('ddslick')) {
                var poidd_onSelected = elem_other_option.closest('.select').data('ddslick').settings.onSelected;
                elem_other_option.closest('.select').data('ddslick').settings.onSelected = ''; // to not call event 
                elem_other_option.closest('.select').ddslick('select', { index: '0' });
                elem_other_option.closest('.select').data('ddslick').settings.onSelected = poidd_onSelected;
            }

            // direct event call for text field
            if (val_before) {
                pcop_delayed_first_option_change_call();
                //$('input[type="text"][name="'+option_name+'"]').change();
            }
        }

        if (pcop_options_container().find('textarea[name^="' + option_name + '"]').length && pcop_options_container().find('textarea[name^="' + option_name + '"]').val()) {
            pcop_options_container().find('textarea[name^="' + option_name + '"]').val('');
        }

        if (typeof(qpo_resetQuantities) == 'function') {
            qpo_resetQuantities(-1, product_option_id); //reset to empty
        }
        //pcop_options_container().find('[name^="quantity_per_option['+product_option_id+']"]').val('');

    }

    // << hided is not required
    if (!$('#options_pcop_not_required').length) {
        pcop_options_container().append('<input type="hidden" name="options_pcop_not_required" id="options_pcop_not_required" value="">');
    }

    if (!$('#options_pcop_not_required').val()) {
        var current_opts = [];
    } else {
        var current_opts = $('#options_pcop_not_required').val().split(',');
    }

    var new_opts = [];
    for (var i in current_opts) {
        if (!current_opts.hasOwnProperty(i)) continue;
        if (current_opts[i] != product_option_id) {
            new_opts.push(current_opts[i]);
        }
    }

    if (!option_toggle) {
        new_opts.push(product_option_id);
    }
    $('#options_pcop_not_required').val(new_opts.toString());

    if ($('#options_pcop_not_required').val() == "NaN") {
        $('#options_pcop_not_required').attr('value', new_opts.toString());
    }

    // >> hided is not required

    if (!option_was_visible && option_toggle) { // became visible

        // use html defaults
        if (pcop_html_default_values && typeof(pcop_html_default_values[product_option_id]) != 'undefined' && pcop_html_default_values[product_option_id]) {
            var option_elem = pcop_options_container().find('[name^="' + option_name + '"]');
            if (option_elem.length) {
                if (option_elem.is('select') || option_elem.is('textarea')) {
                    option_elem.val(pcop_html_default_values[product_option_id]);
                } else if (option_elem.is('radio')) {
                    option_elem.find('[value="' + pcop_html_default_values[product_option_id] + '"]').prop('checked', true);
                } else if (option_elem.is('checkbox')) {
                    if (pcop_html_default_values[product_option_id].length) { // should be array
                        option_elem.each(function() {
                            if ($.inArray($(this).val(), pcop_html_default_values[product_option_id])) {
                                $(this).prop('checked', true);
                            }
                        });
                    }
                }
            }
        }

        // improved options default selected values compatibility
        if (typeof(improvedoptions_set_defaults) == 'function') {
            improvedoptions_set_defaults(false, product_option_id);
        }
    }


    // compatibility with Custom Formulas
    if (typeof(esponi_OPA) == 'function') {
        esponi_OPA(pcop_options_container().find('[name^="' + option_name + '"]'));
    }

    return values_changed;

}

function pcop_check_visibility() {

    if (pcop_data && Object.keys(pcop_data).length) {

        var product_options_ids = [];
        pcop_options_container().find('input[name^="' + pcop_option_prefix + '["], textarea[name^="' + pcop_option_prefix + '["], select[name^="' + pcop_option_prefix + '["], input[type="hidden"][name^="copu_product_id"], select[name^="quantity_per_option["], input[name^="quantity_per_option["]').each(function() {
            var product_option_id = pcop_get_product_option_id_from_name($(this).attr('name'));
            // console.log(product_option_id);
            if ($.inArray(product_option_id, product_options_ids) == -1) {
                // console.log('inarray');
                product_options_ids.push(product_option_id)
            }
        });

        for (var j in product_options_ids) {
            if (!product_options_ids.hasOwnProperty(j)) continue;

            var product_option_id = product_options_ids[j];
            // console.log(product_option_id);
            if (pcop_data[product_option_id]) {
                var pcop_rules = pcop_data[product_option_id];
                if (pcop_rules && pcop_rules.length) {

                    var option_toggle = true;
                    var option_or_toggle = false;
                    var parents_or_cnt = 0;

                    for (var i in pcop_rules) {
                        if (!pcop_rules.hasOwnProperty(i)) continue;

                        var parent_option_id = pcop_rules[i]['parent_option_id'];
                        var parent_option_values = pcop_rules[i]['values'];
                        // console.log("parent_option_id:"+parent_option_id);
                        // console.log("parent_option_values:"+parent_option_values);

                        var parent_result = pcop_is_parent_value_selected(parent_option_id, parent_option_values);
                        // console.log("parent_result:"+parent_result);
                        if (pcop_rules[i]['pcop_or'] && pcop_rules[i]['pcop_or'] == '1') {
                            option_or_toggle = option_or_toggle || parent_result;
                            parents_or_cnt++;
                        } else {
                            option_toggle = option_toggle && parent_result;
                        }

                    }

                    // all standard parents rules results should be TRUE and one of _OR_ parents results should be true
                    option_toggle = option_toggle && (option_or_toggle || !parents_or_cnt);

                    if (pcop_change_option_visibility(product_option_id, option_toggle)) {
                        // если у скрываемой опции были выбраны значения и они были выключены, запустим процедуру заново
                        pcop_options_container().find('[name^="' + pcop_option_prefix + '[' + product_option_id + ']"]:first').change();
                        //pcop_check_visibility(); 
                        return;
                    }

                }
            }

        }

    }
}

function pcop_options_container() {
    return $('#product').first();//, section[id="content"], .boss-product
}

function pcop_update_data(product_options) {
    pcop_data = {};
    if (product_options && product_options != {} && product_options != []) {
        for (var i_product_options in product_options) {
            if (!product_options.hasOwnProperty(i_product_options)) continue;
            var product_option = product_options[i_product_options];
            if (typeof(product_option['pcop_front']) != 'undefined' && product_option['pcop_front']) {
                pcop_data[product_option['product_option_id']] = product_option['pcop_front'];
            }
        }
    }
}

var pcop_html_default_values = [];

function pcop_update_default_values() {

    pcop_html_default_values = [];
    pcop_options_container().find('[name^="option["]').each(function() {

        var option_elem = $(this);
        // console.log(option_elem);
        var product_option_id = pcop_get_product_option_id_from_name(option_elem.attr('name'));
        // console.log(product_option_id);

        if (option_elem.is('select,textarea,:text')) {
            // console.log('1');
            if ($(this).val()) {
                pcop_html_default_values[product_option_id] = $(this).val();
            }
        } else if (option_elem.is(':radio:checked')) {
            // console.log('2');
            pcop_html_default_values[product_option_id] = $(this).val();
        } else if (option_elem.is(':checkbox:checked')) {
            // console.log('3');
            if (typeof(pcop_html_default_values[product_option_id]) == 'undefined') {
                pcop_html_default_values[product_option_id] = [];
            }
            pcop_html_default_values[product_option_id].push(option_elem.val());
        }
    });
}
pcop_update_default_values();

if ((pcop_data && Object.keys(pcop_data).length) || !pcop_theme_name) { // !pcop_theme_name - admin section
    pcop_options_container().on('change', 'input:checkbox[name^="' + pcop_option_prefix + '"], input:radio[name^="' + pcop_option_prefix + '"], select[name^="' + pcop_option_prefix + '"]', function() {
        // console.log('checked');                   
        pcop_check_visibility();
    });

    // journal2
    $('#product').on('click', 'ul li[data-value]', function() {
        setTimeout(function() {
            pcop_check_visibility();
        }, 50);
    });

    // Product Image Option DropDown compatibility
    if ($('.select').length && $.fn.ddslick) {
        setTimeout(function() {
            if ($('.select').data('ddslick')) {
                $('.select').each(function() {
                    $(this).data('ddslick').settings.onSelected = function() {
                        setTimeout(function() {
                            pcop_check_visibility();
                        }, 10);
                    };

                });
            }
        }, 100);
    }

}

if (pcop_data && Object.keys(pcop_data).length) {
    if (pcop_theme_name.substr(0, 9) == 'OPC080191' && pcop_options_container().find('select[name^="' + pcop_option_prefix + '"]').length) { // Diamond by TemplateMela

        // check visibility only after styles applying for selects
        var pcop_check_selects_counter = 0;
        var pcop_check_selects_interval_id = setInterval(function() {

            pcop_check_selects_counter++;
            if (pcop_options_container().find('select[name^="' + pcop_option_prefix + '"]:last').hasClass('hasCustomSelect') || pcop_check_selects_counter == 20) {
                clearInterval(pcop_check_selects_interval_id);
                pcop_check_visibility();
            }
        }, 50);

    } else {
        pcop_check_visibility();
        $(document).ready(function() { // additionally for ready (sometimes options can be changed by theme script after page loading)
            pcop_check_visibility();
        });
    }
}

///////////// add to cart /////////////
$("#productsForm").on('submit', function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            url: cart_url,
            type: 'post',
            data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),//$('#productsForm').serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#button-cart').button('loading');
            },
            complete: function() {
                $('#button-cart').button('reset');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']) {
                    //for controller validation
                    if (json['error']['color_id']) {
                                                        console.log('color error');
                       $('.product-available-colors-ul').after('<div class="text-danger">' + json['error']['color_id'] + '</div>');
                    }

                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }                
                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                //header cart icon data
                if (json['totalQty']) {
                      $('.shopping-cart .shopping-cart-header .badge').html(json['totalQty']);
                }
                // if (json['totalPrice']) {
                //       $('main-color-text total').html(json['totalPrice']);
                // }

                // if (json['quantity']) {
                //      $('.shopping-cart-items .clearfix .item-quantity .item-cart'+ json['productId']+'').html(json['quantity']);
                // }

                if (json['success']) {
                    $('.productContainer').before('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                }

                if (json['danger']) {
                    $('.productContainer').before('<div class="alert alert-danger">' + json['danger'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                }

            },
            error: function(xhr, status, error) {
                console.log( JSON.parse(xhr.responseText) );
            }
        });
});


/////////////// add review ///////////////////
// $('#button-review').on('click', function() {
//     if ( $('#form-review').parsley().isValid() ) {
//         $.ajax({
//             url: review_url,
//             type: 'post',
//             dataType: 'json',
//             data: $('#form-review').serialize(),
//             beforeSend: function() {
//                 $('#button-review').button('loading');
//             },
//             complete: function() {
//                 $('#button-review').button('reset');
//             },
//             success: function(json) {
//                 $('.alert-dismissible').remove();

//                 if (json['error']) {
//                     $('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fas fa-exclamation-circle"></i> ' + json['error'] + '</div>');
//                 }

//                 if (json['danger']) {
//                     $('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fas fa-exclamation-circle"></i> ' + json['danger'] + '</div>');
//                 }

//                 if (json['success']) {
//                     $('#review').after('<div class="alert alert-success alert-dismissible"><i class="fas fa-check-circle"></i> ' + json['success'] + '</div>');

//                     $('input[name=\'author\']').val('');
//                     $('textarea[name=\'review_text\']').val('');
//                     $('input[name=\'rating\']:checked').prop('checked', false);
//                 }
//             }
//         });
//     }
// });