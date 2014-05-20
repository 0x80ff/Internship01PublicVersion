<?php
	if(isset($message)){
	echo $message;
}
		unset($_FILES);
		header ("Refresh: 5;URL=".BASE_URI."/Session/ResUpload"); 
?>

  <div class="container">
    <div class="hero-unit">
      <div class="row">
        <div class="login-form">
          <h2>Redirection<h2>
            <p>Vous allez être redirigé dans quelques secondes</p>
          </div>
        </div>
      </div>
    </div>