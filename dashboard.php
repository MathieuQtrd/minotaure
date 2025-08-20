<?php  

// Nous avons mis en place un outil de gestion de projet
// Nous avons commencé par les users et la gestion de leurs rôles et permissions.
// Nous allons maintenant mettr en place des projets voir aussi des tâches


//----------
// TABLES
//----------

// projects
    // contient les projets : 
        // name
        // description
        // user_id      (clé étrangère) -> ManyToOne
        // status       (en cours, terminé)

// project_user 
    // table pivot pour les liens entre les projets et les développeur affectés aux projets
        // project_id
        // user_id
        
// tasks
    // contient les tâches à réaliser sur les projets
        // name
        // description
        // user_id      (clé étrangère) -> ManyToOne
        // status       (à faire, en cours, terminé)


