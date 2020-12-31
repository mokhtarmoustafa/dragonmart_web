function actions(product) {

  var customs = JSON.parse(JSON.parse(product.custom));
  var hasCustoms = false;
  var customsBtn = '';

  if (customs.length > 0) {
    customs.forEach(function (custom) {
      if (custom.options.length > 0) {
        hasCustoms = true;
      }
    });

    if (hasCustoms) {
      customsBtn = '<a href="' + baseURL + '/order_product/customs/' + product.id + '" class="btn btn-success btn-icon-only mr-2 product_custom" title="Customisations"><i class="far fa-file-alt"></i></a>';
    }

  }

  var actions = customsBtn;

  actions += '<a href="' + baseURL + '/order_product/cancel/' + product.id + '" class="btn btn-icon-only cancel_product" title="cancel"><i class="fa fa-times"></i></a>';
  return actions;
}

$(document).ready(function () {

  if ($("#products_tbl").length) {

    var products_tbl = $("#products_tbl");
    products_tbl.on('preXhr.dt', function (e, settings, data) {
      //.name,.title,.server,.searcher.,.status
      // data.name = $('.name').val();
      data.merchant_id = $('#merchant_id').val();
      data.name = $('#product_name').val();
      data.category_id = $('#category_id').val();
      data.is_sponsor = $('#is_sponsor').val();
      data.is_offer = $('#is_offer').val();
    }).dataTable({
      "processing": true,
      "serverSide": true,

      "ajax": {
        url: baseURL + "/store/products-data"
        , "dataSrc": function (json) {
          //Make your callback here.
          if (json.status != undefined && !json.status) {
            $('#products_tbl_processing').hide();
            bootbox.alert(json.message);
            //
          } else
            return json.data;
        }
      },

      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'name', name: 'name' },
        { data: 'price', name: 'price' },
        { data: 'available_quantity', name: 'available_quantity' },
        { data: 'category_name', name: 'category_name' },
        { data: 'is_sponsor', name: 'is_sponsor' },
        { data: 'is_offer', name: 'is_offer' },
        { data: 'offer_percentage', name: 'offer_percentage' },
        // {data: 'description', name: 'description'},
        { data: 'action', name: 'action' }
      ],

      language: {
        "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
      },
      "searching": false,
      "ordering": false,

      bStateSave: !0,
      lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      pageLength: 10,
      pagingType: "bootstrap_full_number",
      columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
      order: [[2, "asc"]]
    });



    $(".filter input").keyup(function (e) {

      if (e.keyCode == 13) {
        $(".filter-submit-product").click();
      }
    })

  }

  if ($("#order_products_tbl").length) {

    var order_products_tbl = $("#order_products_tbl").on('preXhr.dt', function (e, settings, data) {
      data.name = $('#product_name').val();
    }).dataTable({
      "processing": true,

      "data": products,

      columns: [
        { data: 'id', name: 'id' },
        { data: 'product.name', name: 'product.name' },
        { data: 'qty', name: 'qty' },
        { data: 'product.category.name_ar', name: 'product.category.name_ar' },
        { data: 'price', name: 'price' },
        {
          "className": '',
          "orderable": false,
          "data": null,
          "render": function (data, type, full, meta) {
            return actions(full);
          }
        }
      ],

      language: {
        "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
      },
      "searching": true,
      "ordering": true,

      bStateSave: !0,
      lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      pageLength: 10,
      columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
      order: [[2, "asc"]]
    });

    $(".filter input").keyup(function (e) {

      if (e.keyCode == 13) {
        $(".filter-submit-product").click();
      }
    });

    // Add event listener for opening and closing details
    $('#order_products_tbl tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var table = order_products_tbl;
      console.log(table);
      var row = table.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      }
      else {
        // Open this row
        row.child(customization(row.data())).show();
        tr.addClass('shown');
      }
    });

  }

  var index = 0;
  $(document).on('change', '#custom_id', function () {


    var div = $(this).closest("div").hasClass("customSelect");
    var type = $(this).children("option:selected").attr("data-type");
    var title = [];
    title['color'] = "اللون";
    title['text'] = "العنوان";
    console.log(div);
    if (div) {
      $(this).closest("tr").children(".tb_custom").children("input.custom").attr("type", type).val("");
      $(this).closest("tr").children(".tb_custom").children("input.custom").attr("data-type", type).val("");
    } else {
      $(".custom label").text(title[type]);
      $(".custom input").attr("type", type);
      $(".custom input").val("");
    }

    // console.log(type);
    //
    //   if ($(this).val() == 3) {
    //       $('.custom_color').show();
    //       $('.custom_title').hide();
    //   } else {
    //       $('.custom_color').hide();
    //       $('.custom_title').show();
    //   }
  });
  $(document).on('click', '.add-custom', function () {

    // $('.no-custom').remove();
    // var tr = $(this).closest('tr');
    var description = $('#customizations #description').val();
    var price = $('#customizations #price').val() > 0 ? $('#customizations #price').val() : 0;
    var custom = $('#customizations').find('#custom_id').val();
    var custom_type = $('#customizations').find('#custom_id option:selected').attr("data-type");
    var text = $('.custom input').val();

    var custom_text = $("#customizations #custom_id option:selected").text();

    if (price == undefined || price < 0) {
      alert('Price is required and greater than 0');
      return;
    }

    if (text == "") {
      alert('يجب ملئ جمبع الخانات');
      return;
    }

    if (custom == null) {
      alert('يجب إختيار نوع الخيار');
      return;
    }

    var custom_row = $('.custom-row');
    // var default_text = 'No';
    // is_default = 0;
    // if ($('#customizations #is_default').is(":checked")) {
    //     default_text = 'Yes';
    //     custom_row.find('.default').val(0);
    //     custom_row.find('.default_text').text('No');
    //     is_default = 1;
    //
    // }
    // <td><span class="default_text">' + default_text + '</span><input type="hidden" name="is_default[]" class="default" value="' + is_default + '"></td>

    var Newindex = ++index;
    var custom_select = '<div class="customSelect" id="custom_' + Newindex + '"></div>';


    custom_row.append('<tr><td>'
      + (Newindex)
      + '</td><td><span>'
      + custom_text
      + '</span><input type="hidden" class="form-control" name="custom_id[]" value="' + custom + '">'
      + custom_select
      + '</td><td class="tb_custom"><span>'
      + text
      + '</span><input type="hidden" class="form-control custom" name="custom_text[]" value="' + text + '" data-type="' + custom_type + '"></td><td><span>'
      + description
      + '</span><input type="hidden" class="form-control" name="custom_description[]" value="' + description + '" data-type="text"></td><td><span>'
      + price
      + '</span><input type="hidden" class="form-control" name="custom_price[]" value="' + price + '" data-type="number">'
      + '</td><td><a href="javascript:;"class="btn btn-info btn-icon-only btn-circle edit-price"><i class="fa fa-edit"></i></a><a href="javascript:;" class="btn btn-danger btn-icon-only btn-circle remove-custom"><i class="fa fa-times"></i></a></td></tr>');


    var Select_Clone = $('#custom_id').clone().addClass('hidden custom_select');
    Select_Clone.appendTo('#custom_' + Newindex);

    $('#customizations input').not('input[type=hidden]').val('');
    $('#customizations select').val(0);
    $('#customizations textarea').val('');
    // $('#customizations #is_default').attr('checked', false);

  });

  $(document).on('click', '.edit-price', function () {

    if (!$(this).closest('tr').hasClass("edit-open")) {

      $(this).closest('tr').addClass("edit-open");
      $(this).closest('tr').children("td").children("input").each(function (elm) {

        $(this).closest('td').children("span").text("");
        if ($(this).attr("name") != "custom_id[]") {

          var old_value = $(this).attr("name") == "custom_price[]" && $(this).val() == "" ? 0 : $(this).val();

          $(this).closest('td').attr("old-value", old_value);

          $(this).val(old_value);

          $(this).attr("type", $(this).attr("data-type") ? $(this).attr("data-type") : "text");

          if ($(this).attr("name") == "custom_price[]") {
            $(this).attr("step", "0.1");
            $(this).attr("min", "0");
          }

        } else {

          var old_value = $(this).val();

          $(this).closest('td').children(".customSelect").children(".custom_select").val(old_value);


          $(this).closest('td').attr("old-value", old_value);
          $(this).closest('td').attr("old-value", old_value).children(".customSelect").children(".custom_select").removeClass("hidden");

        }


      });
      $(this).removeClass("btn-info").addClass("green").children("i").removeClass("fa-edit").addClass("fa-check");

    } else {

      var error = false;

      $(this).closest('tr').children("td").children("input").each(function (elm) {

        if ($(this).attr("name") != "custom_id[]") {

          var new_value = $(this).attr("name") == "custom_price[]" && $(this).val() == "" ? 0 : $(this).val();


          if ($(this).attr("name") == "custom_text[]" && (new_value == null || new_value == "")) {
            error = true;
            return;
          } else {

            $(this).closest('td').attr("old-value", new_value);
            $(this).val(new_value);

            $(this).closest('td').children("span").text(new_value);
            $(this).attr("type", "hidden");
          }
        } else {

          var new_value = $(this).closest('td').children(".customSelect").children(".custom_select").children("option:selected").val();
          var new_text = $(this).closest('td').children(".customSelect").children(".custom_select").children("option:selected").text();


          $(this).val(new_value);
          $(this).closest('td').children("span").text(new_text);
          $(this).closest('td').attr("old-value", new_value);
          $(this).closest('td').attr("old-value", new_value).children(".customSelect").children(".custom_select").addClass("hidden");


        }

      });

      if (error) {
        alert('يجب ملئ جمبع الخانات');
        return;
      }
      $(this).closest('tr').removeClass("edit-open");
      $(this).addClass("btn-info").removeClass("green").children("i").addClass("fa-edit").removeClass("fa-check");
    }



  });

  $(document).on('click', '.product_custom', function (e) {
    e.preventDefault();
    // var _this = $(this);
    var action = $(this).attr('href');

    $.ajax({
      url: action,
      type: 'GET',
      success: function (data) {
        $("#wait_msg,#overlay").hide();

        $('#results-modals').html(data);
        $('#product_custom-order').modal('show', { backdrop: 'static', keyboard: false });
      }, error: function (xhr) {

      }
    });
  });

  $(document).on('click', '.cancel_product', function (e) {
    e.preventDefault();
    // var _this = $(this);
    var action = $(this).attr('href');

    $.ajax({
      url: action,
      type: 'GET',
      success: function (data) {
        $("#wait_msg,#overlay").hide();

        $('#results-modals').html(data);
        $('#cancel_product-order').modal('show', { backdrop: 'static', keyboard: false });
      }, error: function (xhr) {

      }
    });
  });


  $(document).on('click', '.remove-custom', function () {

    if ($(this).closest('tr').hasClass("edit-open")) {
      $(this).closest('tr').removeClass("edit-open");
      $(this).closest("td").children("a.edit-price").addClass("btn-info").removeClass("green").children("i").addClass("fa-edit").removeClass("fa-check");


      $(this).closest('tr').children("td").children("input").each(function (elm) {
        var old_value = $(this).closest('td').attr("old-value");
        var old_text;
        if ($(this).attr("name") == "custom_id[]") {

          $(this).closest('td').children(".customSelect").children(".custom_select").addClass("hidden");
          $(this).closest('td').children(".customSelect").children(".custom_select").val(old_value);
          old_text = $(this).closest('td').children(".customSelect").children(".custom_select").children("option:selected").text();
        }
        $(this).val($(this).closest('td').attr("old-value"));
        $(this).closest('td').children("span").text(old_text == null ? old_value : old_text);
        $(this).attr("type", "hidden");

      });



    } else {
      $(this).closest('tr').remove();
    }

  });
  $(document).on('change', '.is_offer', function () {
    var value = $(this).attr('data-value');
    if (value == 0) {
      $("#offer_percentage").attr("disabled", true);
      $('.has_offer').slideDown(1000);
      $(this).attr('data-value', 1)
    } else {
      $("#offer_percentage").attr("disabled", false);
      $('.has_offer').slideUp(1000);
      $(this).attr('data-value', 0)
    }
  });
  $(document).on('change', '.is_sponsor', function () {
    var value = $(this).attr('data-value');
    if (value == 0) {
      $("#sponsor_duration").attr("disabled", true);
      $('.has_sponsor').slideDown(1000);
      $(this).attr('data-value', 1)
    } else {
      $("#sponsor_duration").attr("disabled", false);
      $('.has_sponsor').slideUp(1000);
      $(this).attr('data-value', 0)
    }
  });

  $(document).on('click', '.delete-product-image', function (event) {

    var _this = $(this);
    var action = _this.attr('data-url');
    event.preventDefault();
    var constant_name = _this.closest('tr').find("td:eq(1)").text();
    bootbox.dialog({
      message: "Are you sure to delete (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
      title: "Confirm deletion !",
      buttons: {

        main: {
          label: 'Sure <i class="fa fa-check"></i> ',
          className: "btn-primary",
          callback: function () {
            //do something else
            $.ajax({
              url: action,
              type: 'DELETE',
              dataType: 'json',
              data: { _token: csrf_token },
              success: function (data) {

                if (data.status) {
                  toastr['success'](data.message, '');
                  _this.closest('tr').remove();

                } else {
                  toastr['error'](data.message);
                }
              }
            });
          }
        }, danger: {
          label: 'Close <i class="fa fa-remove"></i>',
          className: "btn-danger",
          callback: function () {
            //do something
            bootbox.hideAll()
          }
        }
      }
    });


  });
  $(document).on('click', '.delete', function (event) {

    var _this = $(this);
    var action = _this.attr('href');
    event.preventDefault();
    var constant_name = _this.closest('tr').find("td:eq(1)").text();
    bootbox.dialog({
      message: "Are you sure to delete (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
      title: "Confirm deletion !",
      buttons: {

        main: {
          label: 'Sure <i class="fa fa-check"></i> ',
          className: "btn-primary",
          callback: function () {
            //do something else
            $.ajax({
              url: action,
              type: 'DELETE',
              dataType: 'json',
              data: { _token: csrf_token },
              success: function (data) {

                if (data.status) {
                  toastr['success'](data.message, '');
                  // _this.closest('tr').remove();
                  products_tbl.api().ajax.reload();

                } else {
                  toastr['error'](data.message);
                }
              }
            });
          }
        }, danger: {
          label: 'Close <i class="fa fa-remove"></i>',
          className: "btn-danger",
          callback: function () {
            //do something
            bootbox.hideAll()
          }
        }
      }
    });


  });
  $(document).on('click', '.delete_product', function (event) {

    var _this = $(this);
    var action = _this.attr('href');
    event.preventDefault();
    var constant_name = _this.closest('tr').find("td:eq(1)").text();
    bootbox.dialog({
      message: "Are you sure to delete (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
      title: "Confirm deletion !",
      buttons: {

        main: {
          label: 'Sure <i class="fa fa-check"></i> ',
          className: "btn-primary",
          callback: function () {
            //do something else
            $.ajax({
              url: action,
              type: 'DELETE',
              dataType: 'json',
              data: { _token: csrf_token },
              success: function (data) {

                if (data.status) {
                  toastr['success'](data.message, '');
                  // _this.closest('tr').remove();
                  products_tbl.api().ajax.reload();

                } else {
                  toastr['error'](data.message);
                }
              }
            });
          }
        }, danger: {
          label: 'Close <i class="fa fa-remove"></i>',
          className: "btn-danger",
          callback: function () {
            //do something
            bootbox.hideAll()
          }
        }
      }
    });


  });

  $(document).on('change', '.set-sponsor', function (event) {

    var _this = $(this);
    var product_id = _this.data('id');
    event.preventDefault();
    $.ajax({
      url: baseURL + '/store/product-sponsor',
      type: 'PUT',
      dataType: 'json',
      data: { '_token': csrf_token, 'product_id': product_id },
      success: function (data) {

        if (data.status) {
          $('.alert').hide();
          toastr['success'](data.message, '');
          products_tbl.api().ajax.reload();

        } else {
          toastr['error'](data.message);
        }

      }
    });

  });
  $(document).on('click', '.set_product_active', function (event) {

    var _this = $(this);
    var action = _this.attr('href');
    event.preventDefault();
    $.ajax({
      url: action,
      type: 'PUT',
      dataType: 'json',
      data: { '_token': csrf_token },
      success: function (data) {

        if (data.status) {
          $('.alert').hide();
          toastr['success'](data.message, '');
          products_tbl.api().ajax.reload();

        } else {
          toastr['error'](data.message);
        }

      }
    });

  });
  $(document).on('click', '.undo_delete_product', function (event) {

    var _this = $(this);
    var action = _this.attr('href');
    event.preventDefault();
    $.ajax({
      url: action,
      type: 'PUT',
      dataType: 'json',
      data: { '_token': csrf_token },
      success: function (data) {

        if (data.status) {
          $('.alert').hide();
          toastr['success'](data.message, '');
          products_tbl.api().ajax.reload();

        } else {
          toastr['error'](data.message);
        }

      }
    });

  });
  $(document).on('change', '.set-offer', function (event) {

    var _this = $(this);
    var product_id = _this.data('id');
    event.preventDefault();
    $.ajax({
      url: baseURL + '/store/product-offer',
      type: 'PUT',
      dataType: 'json',
      data: { '_token': csrf_token, 'product_id': product_id },
      success: function (data) {

        if (data.status) {
          $('.alert').hide();
          toastr['success'](data.message, '');
          products_tbl.api().ajax.reload();

        } else {
          toastr['error'](data.message);
        }

      }
    });

  });

  $(document).on("click", ".filter-submit-product", function () {
    //                if ($(this).val().length > 3)
    products_tbl.api().ajax.reload();
  });
  $(document).on('click', '.filter-cancel-product', function () {

    $(".select2").val('').trigger('change');
    $(this).closest('tr').find('input,select').val('');
    // $('#is_admin_confirm,.status').val('').trigger('change');
    products_tbl.api().ajax.reload();
  });

  $(document).on('click', '.add-product-mdl', function (e) {
    e.preventDefault();
    $("#wait_msg,#overlay").show();
    var action = $(this).attr('href');

    $.ajax({
      url: action,
      type: 'GET',
      success: function (data) {
        $("#wait_msg,#overlay").hide();

        $('#results-modals').html(data);
        $('#show_customs').modal('show', { backdrop: 'static', keyboard: false });
      }, error: function (xhr) {

      }
    });
  });

  $(document).on('click', '.edit-product-mdl', function (e) {
    // var addProductHtml = $('.component').html();
    // // $('.component').addClass('text-center').html('<i class="fa fa-spinner fa-spin text-center fa-5x"></i>');
    // // $(".component").animate({
    // //     top: '0px'
    // // }, 2000);
    e.preventDefault();
    var action = $(this).attr('href');
    $.ajax({
      url: action,
      type: 'GET',
      success: function (data) {
        // $("#wait_msg,#overlay").hide();
        // $('.component').removeClass('text-center').html(data);

        $('#edit_product').html(data);
        $('#editProduct').modal('show', { backdrop: 'static', keyboard: false });
      }, error: function (xhr) {
        // $('.component').html(addProductHtml);
      }
    });
  });
  $(document).on('click', '.edit-product-images-mdl', function (e) {

    e.preventDefault();
    $("#wait_msg,#overlay").show();
    var action = $(this).attr('href');

    $.ajax({
      url: action,
      type: 'GET',
      success: function (data) {
        $("#wait_msg,#overlay").hide();

        $('#results-modals').html(data);
        $('#add-ad').modal('show', { backdrop: 'static', keyboard: false });
      }, error: function (xhr) {

      }
    });


    // var addProductHtml = $('.component').html();
    // $('.component').addClass('text-center').html('<i class="fa fa-spinner fa-spin text-center fa-5x"></i>');
    // $(".component").animate({
    //       top: '0px'
    //   }, 2000);
    //   e.preventDefault();
    //   var action = $(this).attr('href');
    //   $.ajax({
    //     url: action,
    //     type: 'GET',
    //     success: function (data) {
    //       $("#wait_msg,#overlay").hide();
    //       $('.component').removeClass('text-center').html(data);
    //       $('#images-product').html(data);
    //       $('#imagesProduct').modal('show', {backdrop: 'static', keyboard: false});
    //     }, error: function (xhr) {
    //       $('.component').html(addProductHtml);
    //     }
    //   });
  });

  $(document).on('submit', '#productAdd,#productEdit', function (event) {

    var _this = $(this);
    // var loader = '<i class="fa fa-spinner fa-spin"></i>';
    _this.find('.btn.save i').addClass('fa-spinner fa-spin');
    event.preventDefault(); // Totally stop stuff happening
    // START A LOADING SPINNER HERE
    // Create a formdata object and add the files

    var formData = new FormData($(this)[0]);
    // var formData = new FormData($('#myForm')[0]);
    // if (filesArray != undefined)
    //     for (var i = 0, file; file = filesArray[i]; i++) {
    //         formData.append('files[]', file);
    //     }

    $image_url_action = $('.product-images').find('form').attr('action');
    var action = $(this).attr('action');
    var method = $(this).attr('method');

    $.ajax({
      url: action,
      type: method,
      data: formData,

      contentType: false,
      processData: false,
      success: function (data) {
        // console.log(data);
        if (data.status) {

          $('.alert').hide();
          toastr['success'](data.message, '');
          if (event.target.id == 'productAdd') {
            setTimeout(function () {
              window.location = baseURL + '/product/' + data.items.id + '/edit';
            }, 1500);
            _this.attr('action', baseURL + '/product/' + data.items.id);
          }
          $image_url_action += '/' + data.items.id;
          $('.product-images').find('form').attr('action', $image_url_action);
          $('.product-images').slideDown(1000);
          // products_tbl.api().ajax.reload();
          // $('.product_images').slideDown();
        } else {
          var $errors = '<strong>' + data.message + '</strong>';
          $errors += '<ul>';
          $.each(data.errors, function (i, v) {
            $errors += '<li>' + v.message + '</li>';
          });
          $errors += '</ul>';
          $('.alert').show();
          $('.alert').html($errors);
          toastr['error'](data.message);
        }
        _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
        // _this.find('.fa-spin').hide();

      }
    });
  });

  $(document).on('submit', '#cancelProductFrm', function (event) {

    var _this = $(this);
    
    // var loader = '<i class="fa fa-spinner fa-spin"></i>';
    _this.find('.btn.save i').addClass('fa-spinner fa-spin');
    event.preventDefault(); // Totally stop stuff happening
    // START A LOADING SPINNER HERE
    // Create a formdata object and add the files

    var formData = new FormData($(this)[0]);

    var action = $(this).attr('action');
    var method = $(this).attr('method');

    $.ajax({
      url: action,
      type: method,
      data: formData,

      contentType: false,
      processData: false,
      success: function (data) {
        
        if (data.status) {
          $('#cancel_product-order').modal('hide')
          $('.alert').hide();
          toastr['success'](data.message, 'تم الحذف بنجاح');
          location.reload();
          // $('#cancel_product-order').api().ajax.reload();
        } else {
          var $errors = '<strong>' + data.message + '</strong>';
          $errors += '<ul>';
          $.each(data.errors, function (i, v) {
            $errors += '<li>' + v.message + '</li>';
          });
          $errors += '</ul>';
          $('.alert').show();
          $('.alert').html($errors);
          toastr['error'](data.message, '');
        }
        _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
        // _this.find('.fa-spin').hide();

      }
    });
  });

});
