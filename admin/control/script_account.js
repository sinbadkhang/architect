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
  
  //GET ACCOUNT
  $.ajax({
    method: 'GET',
    url: '../../../api/account/read.php',
    dateType: 'json',
  }).done(function (account_arr) {
    console.log(account_arr);
    var rows ="";
    $.each(account_arr.data, function(index,acc){

      console.log(acc.id);
      rows +="<tr>";
      rows +="<td class='id'>"+acc.id+"</td>";
      rows +="<td class='acc-name id='acc-name'>"+acc.username+"</td>";
      rows +="<td class='acc-pass' id='acc-pass'>"+acc.password+"</td>";
      rows +="<td class='acc-type' id='acc-type'>"+acc.type+"</td>";
      rows +="<td class='acc-point' id='acc-point'>"+acc.point+"</td>";
      rows +="<td class='option'><button class='btn-primary update-acc' value='Edit' data-toggle='modal' data-target='#up-account-Modal'>EDIT</button></td>";
      rows +="</tr>";
    })
    $("#accountTable tbody").html(rows);
    
  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
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
    // BTN UPDATE ACCOUNT ON TABLE
  $('#accountTable tbody').on('click', '.update-acc', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
    var username = $(this).parents('tr').find('.acc-name').text();
    var password = $(this).parents('tr').find('.acc-pass').text();
    var type = $(this).parents('tr').find('.acc-type').text();
    var point = $(this).parents('tr').find('.acc-point').text();

    // SET DATA
    $('#up-acc-id').val(id);
    $('#up-username').val(username);
    $('#up-password').val(password);
    $('#up-type').val(type); 
    $('#up-point').val(point);    
    // UPDATE MODAL
    $('#up-data-Modal').modal();
     
  })

  // BTN UPDATE ACCOUNT
  $('#up-account-btn').click(function (e) {
    // var tagForm = $("#up-acc-form").serialize();
    var formData = JSON.stringify($('#up-account-form').serializeObject());
    $.ajax({
      method: 'POST',
      url: '../../../api/account/update.php',
      dataType: 'json',
      data: formData,

    }).done(function (data) {
      // erase INPUT DATA and HIDE MODAL
      // $('#up-account-Modal input').val('');
      // $('#up-account-Modal').modal('hide');
      location.reload();
      
      console.log(data);

    }).fail(function (data,jqXHR, statusText, errorThrown) {
      console.log(data);
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  }) 


});