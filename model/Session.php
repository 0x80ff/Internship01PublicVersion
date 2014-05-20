<?php
class Session extends Model{

	public function verifPass($login, $pass){
	$query  = 'SELECT login, password FROM users WHERE login="'.$login.'" AND password="'.md5($pass).'"';
    $result = $this->getExecution($query);
    if (count($result) == 0)
    {
      $result = false;
    }
    else
    {
      $result = true;
    }
    return $result;
	}
}