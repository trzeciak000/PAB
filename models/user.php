<?php
class UserModel extends Model{
  public function register(){
    $connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
    mysqli_select_db($connect,DB_NAME);
    //sanitize post
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $password = md5($post['password']);
    $password2 = md5($post['password2']);

    if($post['submit']){
      //inserting into database
      $this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
      $this->bind(':name', $post['name']);
      $this->bind(':email', $post['email']);
      $this->bind(':password', $password);

      if(empty($post['name']) || empty($post['email']) || empty($post['password'])){
          Messages::setMsg('error, fill in all fields in form!', 'error');
          return;
      }

      if(mysqli_num_rows(mysqli_query($connect,"SELECT name FROM users WHERE name = '".$post['name']."';")) != 0){
          Messages::setMsg('error, account with this username exists!', 'error');
          return;
      }

      if($password != $password2){
			     Messages::setMsg('error, passwords are differents', 'error');
           return;
      }

      $this->execute();
      header('Location: '.ROOT_URL.'users/login');

    }


        return;
      }

    public function login(){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $password = md5($post['password']);

      if($post['submit']){
        //inserting into database
        $this->query('SELECT * FROM users WHERE name = :name AND password = :password');
        $this->bind(':name', $post['name']);
        $this->bind(':password', $password);

        $row = $this->single();

        if($row){
          $_SESSION['is_logged_in'] = true;
          $_SESSION['user_data'] = array(
            "id"    => $row['id'],
            "name"  => $row['name'],
            "email" => $row['email'],
            "role_id" => $row['role_id']
          );
          header('Location: '.ROOT_URL.'shares');
        } else{
            Messages::setMsg('Incorrect username or password', 'error');
        }

      }
      return;
    }

}
 ?>
