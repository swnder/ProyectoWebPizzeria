<?php
  include_once "login/user.php";
  include_once "login/user_session.php";

  $userSession = new UserSession();
  $user = new User();

  if(isset($_session['user'])){
    echo "Hay secion";
  }else if(isset($_POST['loginname']) && isset($_POST['password'])){

  }else {
    include_once "../index.php";
  }


 ?>
