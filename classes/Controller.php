<?php
abstract class Controller{
    protected $request;
    protected $action;

    public function __construct($action, $request){
      $this->request = $request;
      $this->action = $action;
    }

    public function executeAction(){
      return $this->{$this->action}();
    }

    public function returnView($viewmodel, $fullview){
      $view = 'views/'.get_class($this).'/'.$this->action.'.php';
      if($fullview){
        require('views/main.php');
      } else{
        require($view);
      }
    }
}
?>
