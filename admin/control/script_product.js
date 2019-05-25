

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
//get CATE

  $.ajax({
    method: 'GET',
    url: '../../../api/category/read.php',
    dateType: 'json',
  }).done(function (category_arr) {
    console.log(category_arr);
    
    var dropbox ="";
    $.each(category_arr.data, function(index,cate){
        dropbox +="<option class='category_name' value='"+cate.id+"'>"+cate.category_name+"</option>";
      })
      $("#category_id ").html(dropbox);
        }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })
 // BTN
  //GET PRODUCT
  $.ajax({
    method: 'GET',
    url: '../../../api/product/read.php',
    dateType: 'json',
  }).done(function (product_arr) {
    console.log(product_arr);
    var rows ="";
    var dropbox ="";
    $.each(product_arr.data, function(index,pro){
      console.log(pro.id);
      rows +="<tr>";
      rows +="<td class='id'>"+pro.id+"</td>";
      rows +="<td class='product_code' >"+pro.product_code+"</td>";
      rows +="<td class='product_name' >"+pro.product_name+"</td>";
      rows +="<td class='category_id' >"+pro.category_id+"</td>";
      rows +="<td class='category_code' >"+pro.category_code+"</td>";
      rows +="<td class='category_name' >"+pro.category_name+"</td>";
      rows +="<td class='quantity' >"+pro.quantity+"</td>";
      rows +="<td class='price' >"+pro.price+"</td>";
      rows +="<td class='option'><button class='btn-primary update-product' value='Edit' data-toggle='modal' data-target='#up_product_Modal'>EDIT</button><button class='btn-danger delete-product' value='Delte' data-toggle='modal' data-target='#delproduct_Modal'>DELETE</button></td>";
      rows +="</tr>";

    

      
    })
    $("#productTable tbody").html(rows);
  
   
  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })
 // BTN ADD PRODUCT 
 $('#add-product-btn').click(function(){
    
  var formData = JSON.stringify($('#add-product-form').serializeObject());
  console.log(formData);
  $.ajax({
    method: 'POST',
    url: '../../../api/product/create.php',
    dateType: 'json',
    data: formData,
  }).done(function (data) {
    console.log(data);
    alert('thành công');
       location.reload();
    
  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })
})



    // BTN UPDATE PRODUCT ON TABLE
  $('#productTable tbody').on('click', '.update-product', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
    var product_code = $(this).parents('tr').find('.product_code').text();
    var product_name = $(this).parents('tr').find('.product_name').text();
    var category_id = $(this).parents('tr').find('.category_id').text();
    var quantity = $(this).parents('tr').find('.quantity').text();
    var price = $(this).parents('tr').find('.price').text();

    // SET DATA
    $('#up_id').val(id);
    $('#up_product_code').val(product_code);    
    $('#up_product_name').val(product_name);
    $('#up_category_id').val(category_id);   
    $('#up_quantity').val(quantity); 
    $('#up_price').val(price);
     console.log(category_id);
    // UPDATE MODAL
    // $('#up_product_Modal').modal();
  })

  // BTN DELETE PRODUCT ON TABLE
  $('#productTable tbody').on('click', '.delete-product', function () {
    // GET DATA
    var product_code = $(this).parents('tr').find('.product_code').text();
   
    // SET DATA
    $('#delete_product_code').val(product_code);   
     
    // UPDATE MODAL
    // $('#delproduct_Modal').modal();
  })
    
 
  // BTN UPDATE PRODUCT
  $('#up-product-btn').click(function(e){
    
    var formData = JSON.stringify($('#up-product-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/product/update.php',
      dateType: 'json',
      data: formData,
    }).done(function (data) {
      alert('thành công');
       location.reload();
      console.log(data);
      
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  }) 

  // BTN DELETE PRODUCT
  $('#delete-product-btn').click(function (e) {
    var formData = JSON.stringify($('#delete-product-form').serializeObject());
    console.log(formData);
    $.ajax({
      method: 'POST',
      url: '../../../api/product/delete.php',
      dataType: 'json',
      data: formData,
    }).done(function (data) {
       console.log(data);
       alert('thành công');
       location.reload();
      // HIDE MODAL
      $('#delproduct_Modal').modal('hide');
      // getProduct();
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  })

  $('#sync-product-btn').click(function(e){
    syncFunc();
  })
  
 
  function syncFunc(){
  $.ajax({
    method: 'GET',
    url: '../../../api/product/read_latest.php',
    dataType: 'json'
  }).done(function (product_arr) {
    // console.log(account_arr.data);

    $.each(product_arr.data, function(index,pro){
      var data = JSON.stringify(pro); 
      // console.log(acc.username);

      if (pro.operation == 'insert') {
        
        $.ajax({
          method: 'POST',
          url: '../../../../../head2/architect/api/product/create.php',
          dataType: 'json',
          data: data,
        }).done(function (data) {
          console.log(data);         
          
        }).fail(function (jqXHR, statusText, errorThrown) {
          console.log('fail: '+ jqXHR.responseText);
          console.log(statusText);
          console.log(errorThrown);
        })

      } else if (pro.operation == 'update') {
        var data = JSON.stringify(pro);
        $.ajax({
          method: 'POST',
          url: '../../../../../head2/architect/api/product/update.php',
          dataType: 'json',
          data: data,
        }).done(function (data) {
          alert('update thanh cong');       
          
        }).fail(function (jqXHR, statusText, errorThrown) {
          console.log('fail: '+ jqXHR.responseText);
          console.log(statusText);
          console.log(errorThrown);
        })

      } else if (pro.operation == 'delete') {

        $.ajax({
          method: 'POST',
          url: '../../../../../head2/architect/api/product/delete.php',
          dataType: 'json',
          data: data,
        }).done(function (data) {
          console.log(data);         
          
        }).fail(function (jqXHR, statusText, errorThrown) {
          console.log('fail: '+ jqXHR.responseText);
          console.log(statusText);
          console.log(errorThrown);
        })

      }
     
    })
    // get latest head2 version
    var ser_ver;
    var data ;

    $.ajax({
      method: 'POST',
      url: '../../../../../head2/architect/api/sync_log/read_latest.php',
      dataType: 'json'
    }).done(function (product_arr) {
      
      $.each(product_arr.data, function(index,pro){
        ser_ver = parseInt(pro.server_version)+1;
        pro.server_version = ser_ver;
        console.log(pro.server_version);
        data = JSON.stringify(pro);
        console.log(data);
      })    

      $.ajax({
      method: 'POST',
      url: '../../../../../head2/architect/api/sync_log/create.php',
      dataType: 'json',
      data: data
      }).done(function (sync_log) {
                   
        alert('thành công');
      }).fail(function (jqXHR, statusText, errorThrown) {
        console.log('fail: '+ jqXHR.responseText);
        console.log(statusText);
        console.log(errorThrown);
      })          
      
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })

  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })
};
});