<?php session_start(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BILL</title>
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
    </style>
</head>
<body>
    
    <div class="wrapper">
        <h1 style="color: red" align="center"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSodJsYqTQb4uPw5oTcjRSVgjLIFnyJYUhVduhCjYB0l3Le3txe" width="100" height="100" align="center">VL MART</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Bảng Bill</h2>
                        <a class="btn btn-success pull-right" href="create.php">Thêm Bill</a></br>
                      </br> 

                        <a class="btn btn-info pull-right" data-toggle ="" data-target="">Đồng bộ hóa</a>
                   

                    <table id="bill-table" class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Bill Code</th>
                            <th>Total Price</th>
                            <th>Created Date</th>
                            <th>Total Point</th>
                            <th>Customer Name</th>
                            <th>Cashier Name</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>Bill Code</th>
                            <th>Total Price</th>
                            <th>Created Date</th>
                            <th>Total Point</th>
                            <th>Customer Name</th>
                            <th>Cashier Name</th>
                            <th>Option</th>
                        </tfoot>
                    </table>
                </div>
            </div>        
        </div>
    </div>
</div>


    <!-- ADD BILL MODAL -->
    <!-- <div class="modal fade" id="add-bill-modal" role="dialog">
    <div class="modal-dialog"> -->
      <!-- Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">ADD NEW BILL</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="add-bill-form">
            <label>Bill Code:</label>
            <input type="text" name="category-code" id="category-code" class="form-control"/>
            </br>
             <label>Date:</label>
             <div class="input-append date form_datetime">
             <input size="16" type="text" value="" readonly>
             <span class="add-on"><i class="icon-th"></i></span>
            </div>
            </br>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success " id="add-cate-btn">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div> -->

 <!-- UPDATE BILL MODAL -->

    <div class="modal fade" id="up_cate_Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">EDIT CATEGORY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="up-cate-form">
            <label>Category Code:</label>
            <input type="text" name="category_code" id="edit_category_code"  class="edit_category_code form-control" />
            </br>
             <label>Category Name:</label>
            <input type="text" name="category_name" id="edit_category_name" class="edit_category_name form-control" />
            </br>
             <input type="hidden" name="id" id="up-id">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success " id="up-cate-btn">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--  DELETE BILL MODAL -->

<div id="delcate_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Bạn có muốn xoá sản phẩm ?</h4>
      </div>
      <div class="modal-body">
        <form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ?>" id='delete-cate-form'>
          <input type="hidden" name="id" id="del-id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id='delete-cate-btn'>Yes. Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No. Cancel</button>
      </div>
    </div>
  </div>
</div><!-- delete modal-->

</body>

<style type="text/css">
    h1 {
  font-family: "Arial Black", Gadget, sans-serif
}

</style>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="../../../admin/control/script_bill.js"></script> 
</html>