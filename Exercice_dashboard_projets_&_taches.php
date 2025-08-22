<?php 


// Faire les controllers ProjectController & TaskController

// Un admin peut tout faire
// Un admin peut créer un projet
// Un admin et un developpeur peuvent créer une tache (si le dev crée une tache, priorité par défaut : moyen comme déjà prévu)
// Un admin peut changer les priorités des taches
// Un admin peut affecter les taches à un user, si le user a créer une tache, elle lui est affectée par défaut
// Un admin peut affecter les projets à des user
// Un developpeur peut changer le statut d'une tache sauf terminée
// Un Client peut valider (terminée) une tache

// Lorsqu'un utilisateur se connecte, sur son dashboard :
// Un admin voit tous les projets, toutes les taches 
// Un developpeur voit tous ses projets et ses taches
// Un client voit tous ses projets et les taches des projets qui ont le status "en validation"

// L'admin a une page listant tous les clients ainsi que leur projet et leur taches en validation
// L'admin a une page listant tous les developeur ainsi que leur projet et leur taches affectées
