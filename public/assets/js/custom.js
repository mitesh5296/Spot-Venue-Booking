// $('.dataTableList').DataTable({});
// Ajax call and module
const base_url = $('.site_body').data('url');
const userType = $('.site_body').data('user');
$('.select2').select2({
  placeholder:  'Select option'
});
$('.select2_multiple').select2({
  placeholder:  'Select options'
});
bsCustomFileInput.init();
let getData = (url, type) => {
  try {
    if(url != ''){
      $.ajax({
        type: 'get',
        datatype: 'json',
        url: url, 
        success: function(result){
          if(result.success == true){
            if(type == 'categories'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';
                  html += '<td><img height="50" weight="100" src="'+ base_url +'/assets/images/categories/'+ value.image+'"></td>\n';
                  html += '<td>'+ value.title +'</td>\n';
                  html += '<td>'+ value.time_range +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/categories/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="5">No categories found</td>\n';
                html += '</tr>\n';
              }
            }
            if(type == 'amenities'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';
                  html += '<td><img height="50" weight="100" src="'+ base_url +'/assets/images/amenities/'+ value.image+'"></td>\n';
                  html += '<td>'+ value.title +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/amenities/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="5">No amenities found</td>\n';
                html += '</tr>\n';
              }
            }
            if(type == 'venues'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';
                  html += '<td>'+ value.title +'</td>\n';
                  html += '<td>'+ value.city +'</td>\n';
                  html += '<td>'+ value.state +'</td>\n';
                  html += '<td>'+ value.start_time +'</td>\n';
                  html += '<td>'+ value.end_time +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/venues/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="5">No venues found</td>\n';
                html += '</tr>\n';
              }
            }
            // User List Fetch with ajax start here By Seema
            if(type == 'users'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';                
                  html += '<td>'+ value.name +'</td>\n';
                  html += '<td>'+ value.email +'</td>\n';
                  html += '<td>' + (value.phone ? value.phone : '') + '</td>\n';
                  html += '<td>'+ value.type +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/users/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="5">No users found</td>\n';
                html += '</tr>\n';
              }
            }
            // User List Fetch with ajax end here By Seema
            // Booking List Fetch with ajax start here By Seema
            if(type == 'bookings'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';                
                  html += '<td>'+ value.venue_title +'</td>\n';
                  html += '<td>'+ value.formatted_booking_date +'</td>\n';
                  html += '<td>' + value.slots + '</td>\n';
                  html += '<td>'+ value.amount +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/bookings/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="6">No bookings found</td>\n';
                html += '</tr>\n';
              }
            }
            // Booking List Fetch with ajax end here By Seema
            // Reviews List Fetch with ajax start here By Seema
            if(type == 'reviews'){
              var html = '';
              if(result.data != ''){
                html = '\n';
                $.each( result.data, function( key, value ) {
                  html += '<tr>\n';                
                  html += '<td>'+ value.venue_title +'</td>\n';
                  html += '<td>'+ value.user_name +'</td>\n';
                  html += '<td>'+ value.review +'</td>\n';
                  html += '<td>'+ value.rate +'</td>\n';
                  html += '<td>'+ value.formatted_date +'</td>\n';
                  html += '<td class="project-actions">\n<a class="btn btn-info btn-sm" href="'+ base_url +'/'+userType+'/reviews/edit/'+ btoa(value.id) +'">\n<i class="fas fa-pencil-alt"></i>\n Edit\n</a>\n<a class="btn btn-danger btn-sm delete" data-id="'+ btoa(value.id) +'" href="javascript:void(0);">\n<i class="fas fa-trash"></i>\n Delete \n</a>\n</td>\n';
                  html += '</tr>\n';
                });
              } else {
                html += '<tr>\n';
                html += '<td align="center" colspan="6">No reviews found</td>\n';
                html += '</tr>\n';
              }
            }
            // Reviews List Fetch with ajax End here By Seema
          }
          $('.tbody_data').html(html);
        }
      });
    }
  } catch (err) {
    console.log(err);
  }
}


// Categories Section
if($('.categories_list').length > 0){
  var url = base_url+'/'+userType+'/categories/ajaxlist';
  getData(url, 'categories');
}

if($('#category_form').length > 0){
  if($('.edit-category-form').length > 0){
    var rules = {
      category_title: {
          required: true,
          minlength: 2
      },
      category_time_range: {
        required: true
      }
    };
  } else {
    var rules = {
      category_title: {
          required: true,
          minlength: 2
      },
      category_time_range: {
        required: true
      },
      category_image: {
          required: true,
      }};
  }
  $("#category_form").validate({
    rules: rules,
    messages: {
      category_title: {
            required: "Please enter title",
            minlength: "Title should be at least {0} characters long" // <-- removed underscore
        },
        category_time_range: {
            required: "Please select time range",
        },
        category_image: {
          required: "Please select image",
      }
    }, errorPlacement: function(error, element) {
      if (element.attr("name") == "category_time_range")
          $('#category_time_range_error').append(error);
      else if (element.attr("name") == "category_image")
          $('#category_image_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}
// Categories Section End

// Amenities Section
if($('.amenities_list').length > 0){
  var url = base_url+'/'+userType+'/amenities/ajaxlist';
  getData(url, 'amenities');
}

if($('#amenity_form').length > 0){
  if($('.edit-amenity-form').length > 0){
    var rules = {
      amenity_title: {
          required: true,
          minlength: 2
      }
    };
  } else {
    var rules = {
      amenity_title: {
          required: true,
          minlength: 2
      },
      amenity_image: {
          required: true,
      }};
  }
  $("#amenity_form").validate({
    rules: rules,
    messages: {
      amenity_title: {
            required: "Please enter title",
            minlength: "Title should be at least {0} characters long" // <-- removed underscore
        },
        amenity_image: {
          required: "Please select image",
      }
    }, errorPlacement: function(error, element) {
     
      if (element.attr("name") == "amenity_image")
          $('#amenity_image_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}
// Amenities Section End

// Venues Section
if($('.venues_list').length > 0){
  var url = base_url+'/'+userType+'/venues/ajaxlist';
  getData(url, 'venues');
}

if($('#venue_form').length > 0){
  if($('.edit-venue-form').length > 0){
    var rules = {
      venue_title: {
          required: true,
          minlength: 2
      },
      "venue_categories[]": {
        required: true
      },
      "venue_aminities[]": {
        required: true
      },
      "venue_image[]": {
        required: true
      },
      venue_city: {
        required: true
      },
      venue_state: {
        required: true
      },
      venue_start_time: {
        required: true
      },
      venue_end_time: {
        required: true
      },
      venue_charge_per_slot: {
        required: true
      }
    };
  } else {
    var rules = {
      venue_title: {
          required: true,
          minlength: 2
      },
      "venue_categories[]": {
        required: true
      },
      "venue_aminities[]": {
        required: true
      },
      "venue_image[]": {
          required: true,
      }, 
      venue_city: {
        required: true
      },
      venue_state: {
        required: true
      },
      venue_start_time: {
        required: true
      },
      venue_end_time: {
        required: true
      },
      venue_charge_per_slot: {
        required: true
      },
    };
  }
  $("#venue_form").validate({
    rules: rules,
    messages: {
      venue_title: {
            required: "Please enter title",
            minlength: "Title should be at least {0} characters long" // <-- removed underscore
        },
        "venue_categories[]": {
            required: "Please select categories",
        },
        "venue_aminities[]": {
          required: "Please select aminities",
        },
        "venue_images[]": {
          required: "Please select images",
        },
        venue_city: {
          required: "Please enter city",
        },
        venue_state: {
          required: "Please enter state",
        },
        venue_start_time: {
          required: "Please enter start time"
        },
        venue_end_time: {
          required: "Please enter end time"
        },
    }, errorPlacement: function(error, element) {
      if (element.attr("name") == "venue_categories[]")
          $('#venue_categories_error').append(error);
      else if (element.attr("name") == "venue_aminities[]")
          $('#venue_aminities_error').append(error);
      else if (element.attr("name") == "venue_images[]")
          $('#venue_images_error').append(error);
      else if (element.attr("name") == "venue_start_time")
          $('#venue_start_time_error').append(error);
      else if (element.attr("name") == "venue_end_time")
          $('#venue_end_time_error').append(error);
      else if (element.attr("name") == "venue_charge_per_slot")
          $('#venue_charge_per_slot_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}

$('#venue_start_time').datetimepicker({
  format: 'LT'
})
$('#venue_end_time').datetimepicker({
  format: 'LT'
})
$(".dtPictimepitimepickerckerker").datetimepicker({
  multitime: true,
  use24hours: true,
  format: 'HH:mm'
});
// Venues Section End

// Users Validation Section Start
if($('.users_list').length > 0){
  var url = base_url+'/'+userType+'/users/ajaxlist';
  getData(url, 'users');
}

if($('#user_form').length > 0){
  if($('.edit-user-form').length > 0){
    var rules = {
      user_name: {
          required: true,
          minlength: 2
      },
      user_type: {
        required: true
      }
    };
  } else {
    var rules = {
      user_name: {
        required: true,
        minlength: 2
      },
      user_email: {
        required: true,
        minlength: 2
      },
      user_phone: {
        required: true,
        minlength: 10,
        digits: true
      },
      user_type: {
        required: true
      },
      user_password: {
        required: true,
        minlength: 8,
        strongPassword: true
      },
      confirm_password: {
        required: true,
        equalTo: "#user_password"
      }
    };
  }
  
  $.validator.addMethod(
    "strongPassword",
    function (value, element) {
      return this.optional(element) || /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$%^&*])[A-Za-z\d@#$%^&*]{8,}$/i.test(value);
    },
    "Password must contain at least one letter, one number, and one symbol."
  );


  $("#user_form").validate({
    rules: rules,
    messages: {
      user_name: {
            required: "Please enter name",
            minlength: "Name should be at least {0} characters long"
        },
        user_email: {
          required: "Please enter an email address",
          minlength: "Email should be at least {0} characters long",
          email: "Please enter a valid email address"
        },
        user_phone: {
          required: "Please enter a phone number",
          minlength: "Phone number should be at least {0} digits long",
          digits: "Please enter a valid phone number"
        },
        user_type: {
            required: "Please select user type",
        },
        user_password: {
          required: "Please enter a password",
          minlength: "Password should be at least {0} characters long",
          strongPassword: "Password must contain at least one letter, one number, and one symbol."
        },
        confirm_password: {
          required: "Please confirm your password",
          equalTo: "Password doesn't match"
        }
   
    }, errorPlacement: function(error, element) {
      if (element.attr("name") == "user_type")
          $('#user_type_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}
// User Validation Section end

if($('.booking_list').length > 0){
  var url = base_url+'/'+userType+'/bookings/ajaxlist';
  getData(url, 'bookings');
}

// Booking  Section Start
if($('#booking_form').length > 0){
  if($('.edit-booking-form').length > 0){
    var rules = {
      booking_venue_type: {
        required: true
      },
      booking_date: {
          required: true,
          minlength: 2
      }
    };
  } else {
    var rules = {
      booking_venue_type: {
        required: true
      },
      booking_date: {
          required: true,
          minlength: 2
      },
      booking_slot:{
        required: true
      },
      booking_amount:{
        required: true
      }};
  }
  $("#booking_form").validate({
    rules: rules,
    messages: {
      booking_venue_type: {
        required: "Please select venues type",
      },
    booking_date: {
          required: "Please enter booking date",
      },
    booking_slot:{
      required: "Please select booking slot",
    },
    booking_amount:{
      required: "Please enter booking amount",
    }
    }, errorPlacement: function(error, element) {
      if (element.attr("name") == "booking_venue_type")
          $('#booking_venue_type_error').append(error);
      else if (element.attr("name") == "booking_slot")
          $('#booking_slot_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}
// 
let deleteData = (id, module, th) => {
  try {
    if(id != '' && module != ''){
      $.ajax({
        type: 'get',
        datatype: 'json',
        url: base_url+'/'+userType+'/delete/'+id+'/'+module, 
        success: function(result){
          if(result.success == true){
            var message= '<div class="alert alert-success  alert-timeout alert-block">\n<button type="button" class="close" data-dismiss="alert">×</button>\n<strong>'+ result.message +'</strong>\n</div>'
            $('.js_success').html(message); 
            swal.close();
            th.closest('tr').fadeOut(2000);
            $(".alert-timeout").fadeTo(1000, 0).slideUp(1000, function(){
              $(this).remove(); 
            });
          }
        }
      })
    }
  }  catch (err) {
    console.log(err);
  }
}
$(document).on('click', '.delete', function(){
  var id = $(this).data('id');
  var module = $(this).closest('.table').data('module');
  var th = $(this);
  swal({
    title: '',
    text: "Are you sure want to delete this?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },
  function(e){
    if(e == true){
      deleteData(id, module, th);
    }
  });

})
// Booking  Section End

// Review Section Start
if($('.reviews_list').length > 0){
  var url = base_url+'/'+userType+'/reviews/ajaxlist';
  getData(url, 'reviews');
}

if($('#review_form').length > 0){
  if($('.edit-review-form').length > 0){
    var rules = {
      review_venue_type: {
          required: true
      },
      review_user_type: {
        required: true
      }
    };
  } else {
    var rules = {     
      review_venue_type: {
        required: true
      },
      review_user_type: {
        required: true
      },
      review: {
        required: true,
        minlength: 8,
        strongPassword: true
      },
      review_rate: {
        required: true,
        minlength: 2,
        strongPassword: true
      }
    };
  }
  $("#review_form").validate({
    rules: rules,
    messages: {
      review_venue_type: {
            required: "Please select venues type",
        },
        review_user_type: {
            required: "Please select user type",
        },  
        review: {
            required: "Please enter review",
        },
        review_rate: {
            required: "Please enter review rate",
        }
   
    }, errorPlacement: function(error, element) {
      if (element.attr("name") == "review_user_type")
          $('#review_user_type_error').append(error);
      else if (element.attr("name") == "review_venue_type")
          $('#review_venue_type_error').append(error);
      else
          error.insertAfter(element);
  },
  submitHandler: function(form) {
      form.submit();
  }
  });
}
// Review Section End

window.setTimeout(function() {
  $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove(); 
  });
}, 1000);

$(document).on('change', '.select2, .select2_multiple', function(){
  if($(this).val() != ''){
    $(this).closest('.form-group').find('.error').remove();
  }
});
$('.venue_exclude_dates').datepicker({
  multidate: true,
	format: 'dd-mm-yyyy'
});
