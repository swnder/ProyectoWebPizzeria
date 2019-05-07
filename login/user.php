<?php
  class User extends DB{
    private $nombre;
    private $username;
    public function userExists($user,$pass){
      $md5 = md5($pass);
      $query = $this->connect()->prepare('select * from usuario where usuario= :user and pass = :pass');
      // se ejecuta el query con los paragametos
      $query->execute(['user' => $user, 'pass'=> $md5]);
      // se valida si es que hubo una consulta
      if ($query->rowcount()) {
        return true;
        // code...
      }else {
        return false;
      }

    }
    public function setUser($user){
      $query = $this->connect()->prepare('select * from usuario where usuario = :user');
      $query->execute(['user'=>$user]);

      foreach ($query as $currentUse => $value) {
        // code...
      }
    }
  }

 ?>
