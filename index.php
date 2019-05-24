<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>
  
</head>
    <body>
    <div class="login-page">
  <div class="form">
    <form method="GET" class="login-form" id="login-form">
      <input type="text" placeholder="username" name="username"/>
      <input type="password" placeholder="password" name="password"/>
      <button class="btn btn-success" type="button" id="login-btn"/>LOGIN</button>
    </form>
  </div>
</div>
</body>
<?php 
   
  //   require_once "api/account/read.php";
    // require "config/Database.php";
    //         $sql="SELECT * FROM account WHERE username='".$user."' AND password='".$pass."";
    //          $result = mysqli_query($conn, $sql);
    //             if(mysqli_num_rows($result) >0){
    //             while ($row = mysqli_fetch_assoc($result)) {
    //                 $_user = $row["username"];
    //                 $_pass = $row["password"];
    //                 $_type = $row["type"];
    //                 if($user == $_user && $pass = $_pass){
    //                     $_SESSION["login_status"] = "ready";
    //                     $_SESSION["name"] = $_user;
    //                     $_SESSTION["type"] = $_type;
    //                     echo'<script>alert("login success")</script>';
    //                     echo'<script>document.location.href="/client/view/bill/index.php"</script>';
    //                 }else{
    //                     echo'<script>alert("login fail")</script>';
    //                 }
    //             }
            
    //     }else{
    //         echo'<script>alert("khong co bang user")</script>';
    //     }
    // }
?>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<script type="text/javascript">
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
  
    $('#login-btn').click(function(){
      // var formData = JSON.stringify($('#login-form').serializeObject());
      var formData = $('#login-form').serialize();
      console.log(formData);
      //GET ACCOUNT
      $.ajax({
        method: 'GET',
        url: 'api/account/read_single.php?"'+formData+'"',
        dateType: 'json',
        data: formData

      }).done(function (account_arr) {
        console.log(account_arr);
        
        window.location.href = "client/view/bill";

        
      }).fail(function (jqXHR, statusText, errorThrown) {
        console.log('fail: '+ jqXHR.responseText);
        console.log(statusText);
        console.log(errorThrown);
      })


    })

  })
</script>
</html>