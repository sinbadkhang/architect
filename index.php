<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);


</style>
  
</head>
    <body>
    <div class="login-page">
  <div class="form">
    <form method="POST" class="login-form" id="login-form">
      <input type="text" placeholder="username" name="username" id="log-username"/>
      <input type="password" placeholder="password" name="password" id="log-userpass"/>
      <button class="btn btn-success" type="submit" id="login-btn" name="login" value="login" />LOGIN</button>
    </form>
  </div>
</div>
</body>
<?php 
           if(isset($_POST["login"])){
            $user = $_POST['username'];
            $pass = $_POST['password'];
            require "logindb-config.php";
                $sql="SELECT * FROM account";
                $result = mysqli_query($conn , $sql);
                  if(mysqli_num_rows($result) >0){
                  while ($row = mysqli_fetch_assoc($result)) {
                    $_user = $row["username"];
                    $_pass = $row["password"];
                    $_type = $row["type"];
                    if($user == $_user && $pass = $_pass){
                      $_SESSION["login_status"] = "ready";
                      $_SESSION["name"] = $_user;
                      $_SESSION["type"] = $_type;
                     
                      echo'<script>alert("login success")</script>';
                      echo'<script>document.location.href="client/view/bill/index.php"</script>';
                    }else{
                      echo'<script>alert("login fail")</script>';
                    }
                  }
                
              }else{
                echo'<script>alert("khong co bang user")</script>';
        }
    }
?>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<!-- <script type="text/javascript">
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

  $(document).ready(function(){
   var user = 0;
    $('#login-btn').click(function(){
      // var formData = JSON.stringify($('#login-form').serializeObject());
      var formData = $('#login-form').serialize();
      console.log(formData);
      // var user = $('#log-username').val();
      // var pass = $('#log-userpass').val();
      //GET ACCOUNT
      $.ajax({
        method: 'GET',
        url: 'api/account/read_single.php?"'+formData+'"',
        dateType: 'json',
        data: formData

      }).done(function (account_arr) {
         user = account_arr['username'];
        console.log(user);
        // document.write(user);
        <?php 
        // $_user = echo "<script>"; 
        // echo $_user;
        // $_pass = ["password"];
        // $_type = ["type"];
        // $_SESSION["login_status"] = "ready";
        // $_SESSION["name"] = $_user;
        // $_SESSION["type"] = $_type;
        
        ?>
        // window.location.href = "client/view/bill";

        
      }).fail(function (jqXHR, statusText, errorThrown) {
        console.log('fail: '+ jqXHR.responseText);
        console.log(statusText);
        console.log(errorThrown);
      })


    })

  })
</script> -->
</html>