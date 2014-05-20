<?php

		if (move_uploaded_file($_FILES['nomfichier']['tmp_name'], $this->uploadfile)) {
			?>
			    <div class="alert alert-success">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<h4>Succès</h4>
    			Le fichier est valide et a été téléchargé.
    			</div>
    		<?php
		    echo "Le fichier est valide, et a été téléchargé
		           avec succès. Voici plus d'informations :\n";
		} else { ?>
			    <div class="alert alert-block">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<h4>Erreur!</h4>
    			Le fichier n'a pas été téléchargé.
    			</div>
    		<?php
		    echo "Attaque potentielle par téléchargement de fichiers.
		          Voici plus d'informations :\n";
		}

		echo 'Voici quelques informations de débogage :';
		print_r($_FILES);
