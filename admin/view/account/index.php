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
     <div class="modal fade" id="up-account-Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">Update Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="up-account-form">
            <input type="hidden" name="id" id="up-acc-id" class="form-control"/>
            <label>User Name:</label>
            <input type="text" name="username" id="up-username" class="form-control"/>
            </br>
            <label>Pass Word:</label>
            <input type="text" name="password" id="up-password" class="form-control"/>
            </br>
            <label>Type:</label>
            <input type="text" name="type" id="up-type" class="form-control"/>
            </br>
            <label>Point:</label>
            <input type="text" name="point" id="up-point" class="form-control"/>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  class=" btn btn-success" id="up-account-btn">Submit</button>
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
                <h2 ><center>DANH SÁCH ACCOUNT</center></h2>
              <table class="table table-bordered" id="accountTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                     <th>STT</th>
                    <th>USER NAME</th>
                    <th>PASS WORD</th>
                    <th>TYPE</th>
                    <th>POINT</th>
                    <th><button  type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Add New Account
                  </button></th>
                  </tr>
                </thead>
               
                <tbody>
                  <?php 
                       require_once "config.php";
                    $result  = mysqli_query($link ,'SELECT * FROM account');
                      while($row=mysqli_fetch_array($result)){
                  ?>
                                <tr>
                                  <td class="id"><?php echo $row['id']; ?></td>
                                  <td class="username"><?php echo $row['username']; ?></td>
                                  <td class="password"><?php echo $row['password']; ?></td>
                                  <td class="type"><?php echo $row['type']; ?></td>
                                  <td class="point"><?php echo $row['point']; ?></td>
                                  <td>
                                      <a a href="#" data-id="<?php echo $row['id'] ;?>">
                                          <button  type="button" data-toggle="modal" data-target="#up-account-Modal"  class="up-acc-btn btn btn-warning">Update</button> 
                                      |
                                      <button  type="button" data-toggle="modal" data-target="#delete-account-modal" class="btn btn-danger delete-account">Delete</button></a>
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
 <!-- Modal ADD NEW ACCOUNT -->
  <div class="modal fade" id="add_data_Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">ADD NEW ACCOUNT USER</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="add-account-form">
            <label>User Name:</label>
            <input type="text" name="username" id="username" class="form-control"/>
            </br>
            <label>Pass Word:</label>
            <input type="text" name="password" id="password" class="form-control"/>
            </br>
            <label>Type:</label>
            <input type="text" name="type" id="type" class="form-control"/>
            </br>
            <label>Point:</label>
            <input type="text" name="point" id="point" class="form-control"/>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="add-account-btn" class=" btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- delete account -->
<div id="delete-account-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Bạn Có Muốn Xoá Account ?</h4>
      </div>
      <div class="modal-body">
        <form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ?>" id='delete-account-form'>
          <input type="hidden" name="id" id="del-id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" id='delete-account-btn'>Yes. Delete</button>
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
  <script src="../../control/script_trang.js"></script>

</body>
</html>



