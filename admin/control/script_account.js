console.log('ok');

// 
// function intervalFunc() {
//   myVar = setInterval(syncFunc, 3000);
// };

// 
// function syncFunc(){
//   console.log('Sync successfully');
// };

// TURN JSON INTO JSON OBJECT
$.fn.serializeObject = function()
  {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// DOCUMENT READY
$(document).ready(function(){
    // BTN UPDATE ACCOUNT ON TABLE
  $('#accountTable tbody').on('click', '.up-acc-btn', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
    var username = $(this).parents('tr').find('.username').text();
    var password = $(this).parents('tr').find('.password').text();
    var type = $(this).parents('tr').find('.type').text();
    var point = $(this).parents('tr').find('.point').text();

    // SET DATA
    $('#up-acc-id').val(id);
    $('#up-username').val(username);
    $('#up-password').val(password);
    $('#up-type').val(type); 
    $('#up-point').val(point);    
    // UPDATE MODAL
    $('#up_data_Modal').modal();
     
    // UPDATE MODAL
    // $('#up_product_Modal').modal();
  })

  // BTN UPDATE ACCOUNT
  $('#up-account-btn').click(function (e) {
    // var tagForm = $("#up-acc-form").serialize();
    var formData = JSON.stringify($('#up-accountt-form').serializeObject());
    $.ajax({
      method: 'PUT',
      url: '../../../api/account/update.php',
      dataType: 'json',
      data: formData,

    }).done(function (data) {
      // erase INPUT DATA and HIDE MODAL
      $('#up-account-Modal input').val('');
      $('#up-account-Modal').modal('hide');
      location.reload();
      //getTag();
      console.log(data);

    }).fail(function (data,jqXHR, statusText, errorThrown) {
      console.log(data);
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  }) 

  // BTN ADD ACCOUNT 
  $('#add-account-btn').click(function(){
      
    var formData = JSON.stringify($('#add-account-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/account/create.php',
      dateType: 'json',
      data: formData,
    }).done(function (data) {
      console.log(data);
      alert('Add Successfully');
      location.reload();
      
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  })
});