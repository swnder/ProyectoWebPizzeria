<?php
  class UserSession{
    public function _contructu(){
      session_start();
    }
    // para ponerle un valor a la session
    public function setCurrentUser($user){
      $_session['user'] = $user;
    }
    public function getCurrentUser(){
      return $_session['user'];
    }
    public function closeSession(){
      session_unset();
      session_destroy();
    }
  }

 ?>
