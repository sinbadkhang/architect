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
    // GET CATEGORY
  $.ajax({
    method: 'GET',
    url: '../../../api/category/read.php',
    dateType: 'json',
  }).done(function (category_arr) {
    console.log(category_arr);
    var rows ="";
    $.each(category_arr.data, function(index,cate){

      console.log(cate.category_id);
      rows +="<tr>";
      rows +="<td class='id'>"+cate.id+"</td>";
      rows +="<td class='cate-id' id='cate-id'>"+cate.category_id+"</td>";
      rows +="<td class='cate-name' id='cate-name'>"+cate.category_name+"</td>";
      rows +="<td class='option'><button class='btn-primary update-cate' value='Edit'data-target='#up_cate_Modal'>EDIT</button><button value='delete' class='btn-danger delete-category' id='delete-cate-btn'>DELETE</button></td>";
      rows +="</tr>";
    })
    $("#cate-table tbody").html(rows);
    
  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })

  // BTN ADD CATEGORY
  $('#add-cate-btn').click(function(){
    
    var formData = JSON.stringify($('#add-cate-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/category/create.php',
      dateType: 'json',
      data: formData,
    }).done(function (data) {
      console.log(data);
       $('#add_cate_Modal').modal('hide');
          location.reload();
      
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  })

  // BTN UPDATE CATEGORY ON TABLE
  $('#cate-table tbody').on('click', '.update-cate', function () {
    // GET DATA
    var id =$(this).parents('tr').find('.id').text();
    var category_id = $(this).parents('tr').find('.cate-id').text();
    var category_name = $(this).parents('tr').find('.cate-name').text();
    
    // SET DATA
    $('#edit_category_id').val(category_id);    
    $('#edit_category_name').val(category_name);
    $('#up-id').val(id);
     
    // UPDATE MODAL
    $('#up_cate_Modal').modal();
  })

  // BTN DELETE CATEGORY ON TABLE
  $('#cate-table tbody').on('click', '.delete-category', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
   
    // SET DATA
    $('#del-id').val(id);
        
    // UPDATE MODAL
    $('#delcate_Modal').modal();
  })

  // BTN UPDATE CATEGORY
   $('#up-cate-btn').click(function(e){
    
    var formData = JSON.stringify($('#up-cate-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/category/update.php',
      dateType: 'json',
      data: formData,
    }).done(function (data) {
      console.log(data);
      location.reload();
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  }) 

  // BTN DELETE CATEGORY
  $('#delete-cate-btn').click(function (e) {

    var formData = JSON.stringify($('#delete-cate-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/category/delete.php',
      dateType: 'json',
      data: formData,
    }).done(function (data) {
       console.log(data);
      // HIDE MODAL
      $('#delcate_Modal').modal('hide');
    location.reload();
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  }) 
})