



var myVar;

// 
function intervalFunc() {
  myVar = setInterval(syncFunc, 3000);
};

// 
function syncFunc(){
  console.log('Sync successfully');
};



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

  // Khang ajax get template
  
  // update product

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
    $('#up_product_Modal').modal();
  })
    

// Add product

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


   
  // update product

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
      getProduct();
    }).fail(function (jqXHR, statusText, errorThrown) {
      console.log('fail: '+ jqXHR.responseText);
      console.log(statusText);
      console.log(errorThrown);

    })
  })


$('#productTable tbody').on('click', '.delete-product', function () {
    // GET DATA
    var id = $(this).parents('tr').find('.id').text();
   
    // SET DATA
    $('#del-id').val(id);
   
     
    // UPDATE MODAL
    $('#delproduct_Modal').modal();
  })