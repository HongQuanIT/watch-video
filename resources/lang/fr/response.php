<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'success' => [
        'add' => [
            'default' => 'Ajouter avec succès.',
            'list' => 'Ajouter \':name\'  avec succès.',
        ],
        'auth' => [
            'login' => 'Connecté avec succès',
            'logout' => 'Déconnexion réussie',
            'reset_password' => 'Réinitialisation du mot de passe réussie !.'
        ],
        'register' => [
            'default' => 'Succès de l\'inscription.',
            'name' => 'enregistrement \':name\' réussi.'
        ],
        'verify' => [
            'default' => 'vérification réussie.',
            'name' => 'vérification \':name\' réussi.'
        ],
        'create' => [
            'default' => 'Créer avec succès.',
            'name' => 'Créer \':name\' avec succès.',
        ],
        'import' => [
            'default' => 'réussite de l\'importation',
            'name' => 'succès de l\'importation \':name\'.',
        ],
        'update' => [
            'default' => 'Mettre à jour avec succès.',
            'name' => 'Mettre à jour \':name\' avec succès.',
        ],
        'delete' => [
            'default' => 'Supprimer avec succès',
            'name' => 'Supprimer \':name\' avec succès.',
        ],
        'upload' => [
            'default' => 'Téléchargement du fichier réussi.',
            'name' => 'Fichier \':name\' téléchargé avec succès',
        ],
        'invite' => [
            'default' => 'Inviter des membres avec succès.',

            'email' => 'Email membre \':email\' a été invité.',
        ],
        'list' => [
            'default' => 'Obtenir list avec succès.',
            'name' => 'Obtenir list \':name\' avec succès.',
        ],
        'item' => [
            'default' => 'téléchargement réussi.',
            'name' => 'téléchargement \':name\' réussi.',
        ],
        'install' => [
            'default' => 'Installer avec succès.',
            'name' => 'Installer \':name\'  avec succès.',
        ],
    ],
    'errors' => [
        'item' => 'Obtenir :attribute avec :id échouer.',
        'list' => 'Obtenir list :attribute échouer.',
        'add' => [
            'default' => 'Ajouter échouer.',
            'list' => 'Ajouter \':name\'  avec échouer.',
            'list_or_exits' => 'Ajouter \':name\'  avec échouer ou existe déjà.',
        ],
        'update' => 'Mettre à jour :attribute avec :id échouer.',
        'delete' => 'Effacer :attribute avec :id échouer.',
        'register' => 'S\'inscrire :attribute échouer.',
        'invite' => 'Invite :attribute échouer.',
        'auth' => [
            'validate_password' => 'Le mot de passe de validation incorrect.',
        ],
        'verify' => [
            'default' => 'Vérifier échouer.',
            'name' => 'Vérifier \':name\' échouer.'
        ],
        'permission' => [
            'validate_permission' => 'L\'utilisateur n\'a pas les bonnes autorisations.',
        ]
    ],
];
