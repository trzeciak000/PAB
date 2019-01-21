<?php
class ShareModel extends Model{
  public function Index(){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $this->query('SELECT * FROM shares ORDER BY create_date DESC');
    $result_shares = $this->resultSet();

    if($post['submit']){
        if($post['category'] == 0){
            $this->query('SELECT * FROM shares ORDER BY create_date DESC');
            $result_shares = $this->resultSet();
        } else {
            $this->query('SELECT * FROM shares WHERE category_id=' . $post['category'] . ' ORDER BY create_date DESC');
            $result_shares = $this->resultSet();
        }
    }

    $this->query('SELECT * FROM categories');
    $result_categories = $this->resultSet();


    $rows = array(
        $result_shares,
        $result_categories
    );

    return $rows;
  }

  public function add(){
    //sanitize post
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if($post['submit']){
      //inserting into database
      $this->query('INSERT INTO shares (category_id, title, body, link, user_id) VALUES(:category, :title, :body, :link, :user_id)');
      $this->bind(':category', $post['category']);
      $this->bind(':title', $post['title']);
      $this->bind(':body', $post['body']);
      $this->bind(':link', $post['link']);
      $this->bind(':user_id', $_SESSION['user_data']['id']);
      if(empty($post['title']) || empty($post['body']) || empty($post['link'])){
        echo 'error, fill all fields in form!';
      } else{
          $this->execute();
      }

      //verify
      if($this->lastInsertId()){
        //redirect
        header('Location: '.ROOT_URL.'shares');
      }
    }
      $this->query('SELECT * FROM categories ORDER BY id');
      $rows = $this->resultSet();
      return $rows;
  }
}

 ?>
