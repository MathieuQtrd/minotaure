<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employe extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'hiring_date',
        'salary',
        'service_id',
        'photo',
    ];

    // fillable : les colonne pouvant être remplies
    // à l'inverse : 
    // protected $guarded = []
    // les colonnes qui ne peuvent pas être remplies donc toutes les autres le peuvent

    // hiring_date : date d'embauche sera récupérée comme un string afin de l'avoir sous forme de date il faut la caster
    protected $casts = [
        'hiring_date' => 'date', // Transforme en objet carbon (extension de Datetime)
        
        // casts possibles : integer, boolean, date, datetime, collection, json, timestamp, encrypted
    ];

    // Pour la relation entre la table employes et services : mise en place d'une methode qui nous permettra de récupérer le service de l'employé
    public function service()
    {
        // relation ManyToOne
        return $this->belongsTo(Service::class);
    }


    // Accessor : dans notre cas pour récupèrer l'url de la photo
    // - un accessor permet de créer un attribut sur notre objet employe
    // - en bdd le chemin conservé sera relatif : l'accessor nous permettra d'obtenir l'url complète 
    // - Ici on obtiendra $employe->photo_url
    // - Convention d'écriture getMonAttributeExempleAttribute() => $objet->mon_attribute_exemple 
    // - Les accessor sont automatiquement appelé lors de la récupération des données via le model
    // https://laravel.com/docs/12.x/eloquent-mutators#value-object-casting

    public function getPhotoUrlAttribute()
    {
        if($this->photo) {
            return Storage::url($this->photo);
        }
        // s'il n'y a pas de photo pour l'employé (la valeur est null)
        return asset('images/defaut_photo.png'); // photo par défaut à créée. Changer le chemin si nécessaire.
    }

    /*
        L'outil Storage de laravel permet de gérer les fichiers (local, public, cloud) :
        --------------------------------------------------------------------------------
        // https://laravel.com/docs/12.x/filesystem

        - config/filesystems.php

        public place les fichiers dans storage/app/public :
        il nous faudra exécuter sur la console :
        php artisan storage:link
        afin de les rendre disponibles des public/storage 

        cela crée un lien symbolique entre les deux dossiers

        // stocker un fichier photo dans le disque public :
        $path = $request->file('photo')->store('photos', 'public');
        // $path représente le chemin relatif que l'on stockera en bdd : exemple : photos/fichier.jpg

        // Pour supprimer un fichier
        Storage::disk('public')->delete($employe->photo);

        // Pour afficher le fichier dans une vue
        <img src="{{ Storage::url($employe->photo) }}">

        // En passant par l'accessor, nous appliquons le Storage::url() en amont et cela nous permet d'avoir le bon chemin directement dans un  nouvel attribut créé via l'accessor : $employe->photo_url
        <img src="{{ $employe->photo_url }}">

    */


}

