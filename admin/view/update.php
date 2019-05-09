
<?php
 include 'config.php';

   if(isset($_POST['submit'])){
    

    try {


 $sql = "update product set product_id = '".$_POST['txt_productId']."',
 product_name = '".$_POST['txt_productname']."',
 category_id = '".$_POST['txt_categoryId']."',
 quantity = '".$_POST['txt_quantity']."',
 price = '".$_POST['txt_price']."'
 where id = ".$_GET['id']."";
 if(mysqli_query($link,$sql)){
 header('Location:index.php');
 }else{
 
 echo"Error".mysqli_error($link);
}
}catch (Exception $e) {echo $e-getMessage();}

}
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Chỉnh sửa</h1>
                    </div>
                  <form method="post">
                      
                           <div class="form-group">
                            <label >Mã Sản Phẩm</label>
                            <input type="name" class="form-control"  name="txt_productId" >       
                          </div>
                          <div class="form-group">
                            <label >Tên Sản Phẩm</label>
                            <input type="name" class="form-control"  name="txt_productname" >       
                          </div>
                            <div class="form-group">
                            <label >Loại</label>
                            <select name ="txt_categoryId" class = "form-control">
                             
                              <option value="123" >Nước ngọt</option>
                            </select>                          
                          </div>
                          <div class="form-group">
                            <label >Số lượng</label>
                            <input type="gia" class="form-control"  name="txt_quantity" >                          
                          </div>
                          <div class="form-group">
                            <label >Giá tiền</label>
                            <input type="status" class="form-control"  name="txt_price"  >                            
                          </div>
                          <input type="submit" class = "btn btn-primary" name="submit" value="Submit">
                      </form>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>