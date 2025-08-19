<?php 

// Sur le projet Dashboard
//------------------------

// Faire un controller pour les roles et un autre pour les permissions
// Accès uniquement pour role:admin ou permission:gerer_role & ou permission:gerer_permission

// Faire une page de gestion des roles :
// on affiche tous les roles
// afficher également les permissions de ces roles
// on ajoute un bouton permettant de créer un nouveau role : nouvelle vue avec formulaire (contrainte unique sur le nom du role)

// Faire une page de gestion des permissions :
// on affiche toutes les permissions
// on ajoute un bouton permettant de créer une nouvelle permission : nouvelle vue avec formulaire (contrainte unique sur le nom de la permission)

// Sur la liste des roles, faire un lien pour aller voir le détail d'un role (nouvelle vue), toutes les permissions doivent être listées avec des cases à cocher.
// les permissions du role doivent être cochées par défaut
// Donner la possibilité de rajouter des permissions ou d'en retirer en cochant/décochant les cases 
// + un bouton de validation qui nous renvoie sur la liste des roles

// Supprime toutes les permissions et en ajoute de nouvelles	
$role->syncPermissions(/*...*/);

?>
<select name="permission[]" id="" multiple>
    <option value=""></option>
    <option value=""></option>
    <option value=""></option>
</select>

<input type="checkbox" name="permission[]">
<input type="checkbox" name="permission[]">
<input type="checkbox" name="permission[]">
<input type="checkbox" name="permission[]">
<input type="checkbox" name="permission[]">
<input type="checkbox" name="permission[]">