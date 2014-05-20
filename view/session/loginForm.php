
    <!-- Le styles -->

    <style type="text/css">
      /* défaut */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 80px; 
      }
      .container1 {
        width: 300px;
      }

      /* Le fond blanc */
      .container1 > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      .login-form {
        margin-left: 65px;
      }
    
      legend {
        margin-right: -50px;
        font-weight: bold;
        color: #404040;
      }

    </style>
  <?php
  if(isset($_SESSION['login']))
  {
    //unset($_SESSION['login']);
    header ("Refresh: 2;URL=".BASE_URI."");
  ?>
  <div class="container1">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Redirection<h2>
            <p>Vous allez être redirigé dans quelques secondes</p>
          </div>
        </div>
      </div>
    </div>
<?php 
}else{ ?>

  <div class="container1">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Connexion</h2>
          <form action="../Session/Connection" method="post">
            <fieldset>
              <div class="clearfix">
                <input type="text" name="login" placeholder="Nom d'utilisateur">
              </div>
              <div class="clearfix">
                <input type="password" name="pass" placeholder="Mot de passe">
              </div>
              <button class="btn primary" type="submit">Connexion</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div> <!-- /container -->
<?php
} ?>