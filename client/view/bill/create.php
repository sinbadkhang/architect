<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    
    <style type="text/css">
        .wrapper{
            width: 850px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        label.head{
            display: inline-block;
            width: 140px;
            text-align: right;

        }
        h2.pull-left{
            text-align: center;
        }
    </style>
</head>
<body>
    
    <div class="wrapper">
        <h1 style="color: red" align="center"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSodJsYqTQb4uPw5oTcjRSVgjLIFnyJYUhVduhCjYB0l3Le3txe" width="100" height="100" align="center">VL MART</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Bảng Thêm Bill</h2>
                        <br>
                        <br>
                        <br>
                        <div class="block">
                        <label class="head">Bill Code:</label>
                        <input type="text"/>
                        </div>
                        <div class="block">
                        <label class="head"> Created Date:</label>
                        <input type="text"  id="2" readonly/>
                        </div>
                        <div class="block">
                        <label class="head">Customer Name:</label>
                        <input type="text"/>
                        </div>
                        <div class="block">
                        <label class="head">Cashier Name:</label>
                        <input type="text"/>
                        </div>
                        <a class="btn btn-success pull-right " data-toggle="modal" data-target="#add-billitem-modal">Thêm Product</a>                  
                    <table id="add-billitem-table" class="table table-bordered table-striped">
                        <thead>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity </th>
                            <th>Total Price</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity </th>
                            <th>Total Price</th>
                            <th>Option</th>
                        </tfoot>
                    </table>
                </div>
            </div>        
        </div>
    </div>
</div>
 <!-- ADD BILL ITEM MODAL -->
 <div class="modal fade" id="add-billitem-modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">ADD NEW PRODUCT</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="add-billitem-form">
            <label>Product Name:</label>
            <input type="text" name="bill-productname" id="bill-productname" class="form-control"/>
            </br>
             <label>Product Code:</label>
             <input type="text" name="bill-productcode" id="bill-productcode" class="form-control"/>
            </br>
            <label>Quantity:</label>
            <input type="text" name="bill-quantity" id="bill-quantity" class="form-control"/>
            </br>
            <label>Total Price:</label>
            <input type="text" name="bill-totalprice" id="bill-totalprice" class="form-control"/>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success " id="add-billitem-btn">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="../../../admin/control/script_bill.js"></script> 
<script>
var today = new Date();
var dd = today.getDate();

var mm = today.getMonth()+1; 
var yyyy = today.getFullYear();
if(dd<10) 
{
    dd='0'+dd;
} 

if(mm<10) 
{
    mm='0'+mm;
} 
today = yyyy+'-'+mm+'-'+dd;
console.log(today);

$('#2').val(today);

</script>
</html>