<?php
class AdminModel extends Model{
    public function Index(){
        return;
    }

    public function manageshares(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $this->query('SELECT * FROM shares ORDER BY create_date DESC');
        $result_shares = $this->resultSet();

        if(isset($post['submit'])){
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

    public function manageusers(){
        $this->query('SELECT * FROM users WHERE role_id IN (2,3) AND id !=' . $_SESSION['user_data']['id'] . ' ORDER BY register_date DESC');
        $rows = $this->resultSet();
        return $rows;
    }
}

?>
