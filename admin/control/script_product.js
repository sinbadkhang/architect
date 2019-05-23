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

  //GET PRODUCT
  $.ajax({
    method: 'GET',
    url: '../../../api/product/read.php',
    dateType: 'json',
  }).done(function (product_arr) {
    console.log(product_arr);
    var rows ="";
    $.each(product_arr.data, function(index,pro){
      console.log(pro.id);
      rows +="<tr>";
      rows +="<td class='id'>"+pro.id+"</td>";
      rows +="<td class='pro-code' id='pro-code'>"+pro.product_code+"</td>";
      rows +="<td class='pro-name' id='pro-name'>"+pro.product_name+"</td>";
      rows +="<td class='pro-catid' id='pro-catid'>"+pro.category_code+"</td>";
      rows +="<td class='pro-quantity' id='pro-quantity'>"+pro.quantity+"</td>";
      rows +="<td class='pro-price' id='pro-price'>"+pro.price+"</td>";
      rows +="<td class='option'><button class='btn-primary update-pro' value='Edit' data-toggle='modal' data-target='#up-account-Modal'>EDIT</button></td>";
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
    var product_id = $(this).parents('tr').find('.product_id').text();
    var product_name = $(this).parents('tr').find('.product_name').text();
    var category_id = $(this).parents('tr').find('.category_id').text();
    var quantity = $(this).parents('tr').find('.quantity').text();
    var price = $(this).parents('tr').find('.price').text();

    // SET DATA
    $('#up_id').val(id);
    $('#up_product_id').val(product_id);    
    $('#up_product_name').val(product_name);
    $('#up_category_id').val(category_id);   
    $('#up_quantity').val(quantity); 
    $('#up_price').val(price);
     
    // UPDATE MODAL
    // $('#up_product_Modal').modal();
  })

  // BTN DELETE PRODUCT ON TABLE
  $('#productTable tbody').on('click', '.delete-product', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
   
    // SET DATA
    $('#del-id').val(id);   
     
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
      dateType: 'json',
      data: formData,
    }).done(function (data) {
       console.log(data);
      // HIDE MODAL
      $('#delproduct_Modal').modal('hide');
      // getProduct();
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);
    })
  })
});