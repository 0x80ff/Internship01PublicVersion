<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
      
        <link rel="stylesheet" href="<?php  echo BASE_URI.'/'.'css'.'/'.'bootstrap.min.css'; ?>" media="screen">
        <link rel="stylesheet" href="<?php  echo BASE_URI.'/'.'css'.'/'.'bootstrap-twitter.css'; ?>" media="screen">
        
        <style>
            .tab-pane {min-height: 400px;}
        </style>
    </head>
    <body>
        <div class="topbar">
            <div class="fill">
                <div class="container">
                    <h3><a href="<?php echo BASE_URI; ?>">AG T&eacute;l&eacute;phonie</a></h3>
                    <ul>
                        <li><a href="<?php echo BASE_URI.'/Recherche/Preparation'; ?>">Recherche</a></li>
                        <li><a href="<?php echo BASE_URI.'/Statistiques/Preparation'; ?>">Statistiques</a></li>
                        <li><?php if(!empty($_SESSION['login'])){
                            echo '<a href="'.BASE_URI.'/Session/Index">Administration</a>'; }?></li>
                        <li><?php if(!empty($_SESSION['login'])){
                            echo '<a href="'.BASE_URI.'/Session/Disconnected"><i class="icon-user icon-white"></i> Se déconnecter</a>';
                        }else{
                            echo '<a href="'.BASE_URI.'/Session/Connect'.'"><i class="icon-user icon-black"></i> Connexion</a>';
                        }
                        ?>
                        </li>
                        <li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 60px;">               
            <?php echo $content_for_layout; ?>
        </div>
    

   
    <!-- ==============================================  -->
        <script src="<?php echo BASE_URI.'/'.'js'.'/'.'jquery.js'; ?>"></script>
        <script src="<?php echo BASE_URI.'/'.'js'.'/'.'bootstrap.min.js'; ?>"></script>                                          
        <script type="text/javascript" src="<?php echo BASE_URI.'/'.'js'.'/'.'functions.js'; ?>" /></script>
    </body> 
</html>