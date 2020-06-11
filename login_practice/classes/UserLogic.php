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
        /**
     * ログイン処理
     * @param string $email,$password
     * @return bool $result
     */
    public static function login($email,$password)
    {
      //結果
      $result = false;
      //ユーザーemailから検索して取得
      $user = self::getUserByEmail($email);

      if(!$user){
        $_SESSION['msg']='emailが一致しません';
        return $result;
      }
      //パスワードの照会
      if(password_verify($password,$user['password'])){
        //ログイン成功
        session_regenerate_id(true);//古いセッションを破棄して新しいセッションを作る
        $_SESSION['login_user']= $user;
        $result = true;
        return $result;
      }
      $_SESSION['msg']='パスワードが一致しません';
      return $result;
    }

        /**
     * emailからユーザーを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
      //sqlの準備
      //sqlの実行
      //sqlをの結果を返す
      $sql = "SELECT * FROM users WHERE email=?";

      //emailを配列にいれる
      $arr =[];
      $arr[]= $email;

      try{
        //sqlの準備
        $stmt = connect()->prepare($sql);
        $result=$stmt->execute($arr);
        //sqlの結果を返す
        $user=$stmt->fetch();
        return $user;

      }catch(\Exception $e){
        return $result;
      }
    }
    /**
     * ログインチェック
     * @param void
     * @return bool $result
     */
    public static function checkLogin()
    {
      $result = false;
      //セッションにログインユーザーが入っていなかったらfalse
      
      if(isset($_SESSION['login_user']) && isset($_SESSION['login_user']['id']) > 0)
      {
        return $result = true;
      }
      return $result;
    }
    /**
     * ログアウト処理
     */
    public static function logout()
    {
      $_SESSION = array();
      session_destroy();
    }
  }
?>