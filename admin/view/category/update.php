
<?php
 include 'config.php';

   if(isset($_POST['submit'])){
    

    try {


 $sql = "UPDATE category set category_id = '".$_POST['txt_categoryid']."', category_name = '".$_POST['txt_categoryname']."' WHERE id = ".$_GET['id']."";
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
       <h1 style="color: red" align="center"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSodJsYqTQb4uPw5oTcjRSVgjLIFnyJYUhVduhCjYB0l3Le3txe" width="100" height="100" align="center">VL MART</h1>
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Chỉnh sửa</h2>
                    </div>
                  <form method="post">
                      
                           <div class="form-group">
                            <label >Category ID</label>
                            <input type="name" class="form-control"  name="txt_categoryid" >       
                          </div>
                          <div class="form-group">
                            <label >Category Name</label>
                            <input type="name" class="form-control"  name="txt_categoryname" >       
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
<style type="text/css">
    h1 {
  font-family: "Arial Black", Gadget, sans-serif
}
 h2{
    text-align: center;
    
}
 }

   }
</style>
</html>