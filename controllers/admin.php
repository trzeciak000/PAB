<?php
class Admin extends Controller{
  protected function Index(){
    $viewmodel = new AdminModel();
    $this->ReturnView($viewmodel->Index(), true);
  }

  protected function manageshares(){
      if(!isset($_SESSION['is_logged_in'])){
          header('Location: '.ROOT_URL);
      }
      $viewmodel = new AdminModel();
      $this->ReturnView($viewmodel->manageshares(), true);
    }
    protected function manageusers(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }
        $viewmodel = new AdminModel();
        $this->ReturnView($viewmodel->manageusers(), true);
    }
}

 ?>
