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
        // creator_id           (clé étrangère) -> ManyToOne - createur du projet
        // client_id            (clé étrangère) -> ManyToOne - client concerné
        // status               (en cours, terminé)

// project_user 
    // table pivot pour les liens entre les projets et les employés affectés aux projets
        // project_id       (clé étrangère) -> ManyToMany - projet
        // user_id          (clé étrangère) -> ManyToMany - developpeur | commercial | chef de projet | admin ...
        
// tasks
    // contient les tâches à réaliser sur les projets
        // name
        // description
        // user_id      (clé étrangère) -> ManyToOne - developpeur | commercial | chef de projet | admin ...
        // project_id   (clé étrangère) -> ManyToOne - projet
        // status       (à faire, en cours, terminé)
        // priority     (bloquant, urgent, élevé, moyen, faible)


