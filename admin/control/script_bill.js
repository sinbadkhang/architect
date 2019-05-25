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
  
  //GET BILL
  $.ajax({
    method: 'GET',
    url: '../../../api/bill/read.php',
    dataType: 'json',
  }).done(function (bill_arr) {
    console.log(bill_arr);
    var rows ="";
    $.each(bill_arr.data, function(index,bill){

      console.log(bill.id);
      rows +="<tr>";
      rows +="<td class='id'>"+bill.id+"</td>";
      rows +="<td class='bill-code' >"+bill.bill_code+"</td>";
      rows +="<td class='bill-total-price' >"+bill.total_price+"</td>";
      rows +="<td class='bill-date'>"+bill.created_date+"</td>";
      rows +="<td class='bill-total-point'>"+bill.total_point+"</td>";
      rows +="<td class='bill-customer-name' >"+bill.customer_name+"</td>";
      rows +="<td class='bill-cashier-name' >"+bill.cashier_name+"</td>";
      rows +="<td class='option'><a href='update.php'><button class='btn-primary update-bill' value='Edit'>EDIT</button></a><button class='btn-warning bill-detail' value='DETAIL'>DETAIL</button></td>";
      rows +="</tr>";
    })
    $("#bill-table tbody").html(rows);
    
  }).fail(function (jqXHR, statusText, errorThrown) {
    console.log('fail: '+ jqXHR.responseText);
    console.log(statusText);
    console.log(errorThrown);
  })

  //DATE TIME PICKER
//    $(".form_datetime").datetimepicker({
//         format: "dd MM yyyy - hh:ii"
//     });
    //ADD PRODUCT BTN ON MODAL

    $('#add-billitem-btn').click(function(){
        var proname = $('#proname-select').val();
        var quantity =$('#bill-quantity').val();
        var total = $('#bill-totalprice').val();
        var rows ="";

      rows +="<tr>";
      rows +="<td class='bill-itemname' >"+proname+"</td>";
      rows +="<td class='bill-itemquantity' >"+quantity+"</td>";
      rows +="<td class='bill-itemtotal' >"+total+"</td>";
      rows +="<td class='option'><button class='btn-primary update-billitem' value='Edit' data-toggle='modal' data-target='#up-account-Modal'>EDIT</button><button class='btn-danger bill-itemdel' value='DELETE'>DELETE</button></td>";
      rows +="</tr>";
      console.log(rows);
      $("#add-billitem-table tbody").append(rows);
    })
   
    // location.reload();

    $.ajax({
      method : 'GET',
      url: '../../../api/product/read.php',
      dataType : 'json',
    }).done(function(product_arr){
      var rows = "";
      $.each(product_arr.data, function(index,pro){

      rows+=   "<option value='"+pro.product_name+"'>"+pro.product_name+"</option>";


      })
      $("#add-billitem-modal select").html(rows);
    })

    $('#submit-bill-btn').click(function(){

      var formData = JSON.stringify($('#add-bill-form').serializeObject());
      console.log(formData);
      $.ajax({
        method: 'POST',
        url:'../../../api/bill/create.php',
        dataType : 'json',
        data: formData,
      }).done(function(data){
        console.log(data);

      })
    })
});