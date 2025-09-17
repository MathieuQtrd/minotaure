User 
    id
    name 
    email 
    password 

Product
    id          
    title           string
    description     text 
    price           integer
    image           string 
    stock           integer 
    category_id     foreign_key

Category 
    id 
    title           string unique

order 
    id 
    user_id         foreign_key
    date            datetime
    total_price     integer 

order_details
    id 
    order_id        foreign_key
    product_id      foreign_key
    quantity        integer 
    unit_price      integer 

EXERCICE :
----------
    Commencer le back office :
    Créer les tables category et product 
    Faire une page création de catégorie
    Faire une page listing des catégories avec possibilité de modifier et supprimer 

    Faire une page création de produit 
    Les catégories proposées doivent être les existantes en BDD
    Faire une page listing des produits avec possibilité de modifier et supprimer
