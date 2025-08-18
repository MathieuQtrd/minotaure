<?php 

#-------------
# PROJET BLOG
#-------------

# Installation d'un nouveau projet Laravel
# Choisir un thème graphique
# Page index : 
    # Listing des articles du plus récent au plus ancien (Image principale, titre, catégorie, date, auteur, début de l'article + un bouton pour aller voir la fiche avec l'article complet)
    # faire une liste des catégories ayant des articles afin de filtrer pour afficher les articles selon la catégorie
    # faire un champ recherche pour afficher les article selon la recherche (on recherche dans le titre, dans le contenu, dans les auteurs.)
# CRUD pour les catégories (création, affichage dans un tableau, update, delete)
    # Nom
    # *Description
    # *Image
# CRUD pour les articles (création, affichage dans un tableau, update, delete) 
    # Titre
    # auteur
    # created_at, updated_at (timestamp)
    # catégorie id (clé étrangère)
    # contenu
    # image principale
    # *début de l'article
    # *slug (unique)

# Page article :
    # on affiche l'article au complet

# Page contact :
    # Un formulaire permettant soit l'envoi de mail soit l'enregistrement en bdd soit les deux


# Bonus :
    # Donner la possibilité d'écrire des commentaires sur les articles
        # un formulaire en bas de la page article
        # nouvelle table avec l'id de l'article concerné + nom, prénom, email, message, active
        # on affiche les commentaire sous le formulaire du plus récent au plus ancien

        # Pour la modération préparer une page qui liste dans un tableau tous les commentaires quelque soit l'article correspondant avec la possibilité pour l'admin de désactiver l'article voir de le supprimer

# Bonus :
    # Gestion des mots clé
    # mettre en place une table : nom du mot clé
    # créer une table de relation : post_keyword avec keyword_id et post_id en clé étrangère
    # dans les models mettre des relations belongsToMany
    # Faire une page de création de mot clé, puis une page pour les afficher avec possibilité de modifier et de supprimer
    # Faire une page permettant d'affecter des mots clé à un article ou depuis la création d'article un select multiple permettant de proposer les mots clé et enregistrer les relations dans la table post_keyword
    # Sur l'index faire une liste des mots clé (limitée potentiellement) ayant des articles afin de filtrer pour afficher les articles selon le mot clés choisi
    # Pour le champ recherche sur index permettre aussi la recherche par mot clé

# Bonus :
    # faire une pagination (on affiche 10 articles par page)

# Bonus :
    # Permettre la possibilité sur les articles de charger une galerie photo (nouvelle table)

# Bonus : aller plus loin rajouter selon vos idées.




