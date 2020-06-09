<?php
  require_once'../dbconnect.php';

  class UserLogic
  {
    /**
     * ユーザーを登録する
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
      $result = false;
      $sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";

      //ユーザーデータを配列にいれる
      $arr =[];
      $arr[]= $userData['username'];
      $arr[]=$userData['email'];
      $arr[]=password_hash($userData['password'],PASSWORD_DEFAULT);

      try{
        //sqlの準備
        $stmt = connect()->prepare($sql);
        $result=$stmt->execute($arr);
        return $result;

      }catch(\Exception $e){
        echo'接続失敗です'.$e->getMessage();
        // return $result;
      }

    }
  }
?>