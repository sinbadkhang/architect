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
  <!-- ACCOUNT TABLE -->
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div>
            <div>
              <h2><center>ACCOUNT LIST</center></h2>
              <button class="btn btn-info">SYNC DATA</button>
              <button class="btn btn-success pull-right" data-toggle="modal" data-target="#add-data-Modal">ADD ACCOUNT</button>
              <table class="table table-bordered" id="accountTable" width="100%" cellspacing="0">
                <thead>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>TYPE</th>
                    <th>POINT</th>
                    <th>OPTION</th>
                </thead>
                <tbody>
                 
                </tbody>
                <tfoot>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>TYPE</th>
                    <th>POINT</th>
                    <th>OPTION</th>
                </tfoot>
              
              </table>
            </div>
          </div>
        </div>
      </div>        
    </div>
  </div>

  <!-- MODAL ADD ACCOUNT -->
  <div class="modal fade" id="add-data-Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" text-align="left">
          <h4 class="modal-title">ADD NEW ACCOUNT USER</h4>
          
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="add-account-form">
            <label>Username:</label>
            <input type="text" name="username" id="username" class="form-control"/>
            </br>
            <label>Password:</label>
            <input type="text" name="password" id="password" class="form-control"/>
            </br>
            <label>Type:</label>
            <select name="type" id="type" class="form-control">
            <option value ="Customer">Customer</option>
            <option value ="Employee">Employee</option>
            </select>
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

  <!-- MODAL UPDATE ACCOUNT -->
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
            <select name="type" id="up-type" class="form-control">
            <option value ="Customer">Customer</option>
            <option value ="Employee">Employee</option>
            </select>
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

  <!-- MODAL DELETE ACCOUNT -->
  <!-- <div id="delete-account-modal" class="modal fade" role="dialog">
    <div class="modal-dialog"> -->
      <!-- Modal content-->
      <!-- <div class="modal-content">
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
  </div> -->

  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <script Type="text/javascript" src="../../control/script_account.js"></script>
</body>
</html>



