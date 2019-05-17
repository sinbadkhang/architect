<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
   
    <style type="text/css">
        .wrapper{
            width: 650px;
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
     <div class="modal fade" id="up_product_Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">Update Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="up-product-form">
            <label>Id:</label>
            <input type="text" name="id" id="up_id" class="form-control"/>
            <label>Product id:</label>
            <input type="text" name="product_id" id="up_product_id" class="form-control"/>
            </br>
            <label>Product Name:</label>
            <input type="text" name="product_name" id="up_product_name" class="form-control"/>
            </br>
            <label>Category Id:</label>
            <input type="text" name="category_id" id="up_category_id" class="form-control"/>
            </br>
            <label>Quantity:</label>
            <input type="text" name="quantity" id="up_quantity" class="form-control"/>
            </br>
            <label>Price</label>
            <input type="text" name="price" id="up_price" class="form-control" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  class=" btn btn-success" id="up-product-btn">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Product Table -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                   
                   <div >
            <div >
                <h2 ><center>Bảng sản phẩm</center></h2>
              <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                     <th>Id</th>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Category Id</th>
                    <th>Quantity</th>
                     <th>Price</th>
                    <th><button  type="button" name="add" id="add" data-toggle="modal" data-target="#add_product_Modal" class="btn btn-success">Add New Account
                  </button></th>
                  </tr>
                </thead>
               
                <tbody>
                  <?php 
                       require_once "config.php";
                    $result  = mysqli_query($link ,'SELECT * FROM product');
                      while($row=mysqli_fetch_array($result)){
                  ?>
                                <tr id="<?php echo $row['id']; ?>">
                                  <td class="id"><?php echo $row['id']; ?></td>
                                  <td class="product_id"><?php echo $row['product_id']; ?></td>
                                  <td class="product_name"><?php echo $row['product_name']; ?></td>
                                  <td class="category_id"><?php echo $row['category_id']; ?></td>
                                  <td class="quantity"><?php echo $row['quantity']; ?></td>
                                  <td class="price"><?php echo $row['price']; ?></td>
                                  <td>
                                      <a a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">
                                          <button  type="button" data-toggle="modal" data-target="#up_product_Modal" class="btn btn-warning update-product">Sửa</button>
                                           <button  type="button" data-toggle="modal" data-target="#delproduct_Modal" class="btn btn-primary delete-product">Xoá</button>
                                      </a>
                                     
                                  </td>
                                </tr>
                    <?php 
                      }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
            </div>        
        </div>
    </div>
   

 
 <!-- Add -->


  <div class="modal fade" id="add_product_Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">ADD NEW PRODUCT</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" id="add-product-form">
            <label>Product id:</label>
            <input type="text" name="product_id" id="product_id" class="form-control"/>
            </br>
            <label>Product Name:</label>
            <input type="text" name="product_name" id="product_name" class="form-control"/>
            </br>
            <label>Category Id:</label>
            <input type="text" name="category_id" id="category_id" class="form-control"/>
            </br>
            <label>Quantity:</label>
            <input type="text" name="quantity" id="quantity" class="form-control"/>
            </br>
            <label>Price</label>
            <input type="text" name="price" id="price" class="form-control" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"id="add-product-btn" class=" btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- delete product -->
<div id="delproduct_Modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Bạn có muốn xoá sản phẩm ?</h4>
      </div>
      <div class="modal-body">
        <form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ?>" id='delete-product-form'>
          <input type="hidden" name="id" id="del-id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id='delete-product-btn'>Yes. Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No. Cancel</button>
      </div>
    </div>
  </div>
</div><!-- delete modal-->




   <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <script src="../../control/script_tuan.js"></script>

</body>
</html>



