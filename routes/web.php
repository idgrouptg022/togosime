<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Visitors\MainController@index')->name('index');
Route::get('produits/categorie/{id}', 'Visitors\ProductViewController@produitCategorie')->name('produit_categorie');
Route::get('produits/rechercher', 'Visitors\ProductViewController@produitRechercher')->name('produit_rechercher');
Route::get('produits/{id}/detail', 'Visitors\ProductViewController@produitDetail')->name('produit_detail');
Route::get('annonces/{id}/details', 'Visitors\MainController@detailsAnnonce')->name('vDetailsAnnonce');
Route::get('pages/{id}/details', 'Visitors\MainController@detailsPage')->name('vDetailsPage');
Route::get('services', 'Visitors\MainController@services')->name('services');
Route::get('sitesTouristiques', 'Visitors\MainController@sitesTouristiques')->name('sitesTouristiques');

Route::get('admin', 'Admin\MainController@index')->name('indexAdmin');
Route::get('admin/login', 'Admin\MainController@login')->name('login');

/* PAGES - ADMINISTRATION */

Route::get('admin/pages/ajouter', 'Admin\PageController@create')->name('ajouterPage');
Route::post('admin/pages/ajouter', 'Admin\PageController@store')->name('ajouterPageFrom');
Route::get('admin/pages', 'Admin\PageController@index')->name('listePage');
Route::get('admin/pages/{id}/details', 'Admin\PageController@edit')->name('detailsPage');
Route::post('admin/page/{id}/update', 'Admin\PageController@update')->name('updatePage');
Route::get('admin/pages/{id}/supprimer', 'Admin\PageController@show')->name('supprimerPage');
Route::get('admin/pages/{id}/supprimer/confirm=true', 'Admin\PageController@destroy')->name('supprimerPageForm');

/* CONTACTS - ADMININSTRATION */

Route::get('admin/contacts', 'Admin\ContactController@index')->name('listeContact');
Route::post('admin/contacts/ajouter', 'Admin\ContactController@store')->name('ajouterContact');
Route::get('admin/contacts/{id}/details', 'Admin\ContactController@edit')->name('detailsContact');
Route::post('admin/contacts/{id}/update', 'Admin\ContactController@update')->name('ajouterContactFrom');
Route::get('admin/contacts/{id}/supprimer', 'Admin\ContactController@show')->name('supprimerContact');
Route::get('admin/contacts/{id}/supprimer/confirm=true', 'Admin\ContactController@destroy')->name('supprimerContactForm');

/* A PROPOS - ADMININSTRATION */

Route::get('admin/a_propos', 'Admin\AProposController@index')->name('aPropos');
Route::post('admin/a_propos', 'Admin\AProposController@store')->name('ajouterAProposFrom');

/* IMAGES - ADMINISTRATION */

Route::post('admin/images', 'Admin\ImageController@store')->name('ajouterImage');
Route::get('admin/images', 'Admin\ImageController@index')->name('listeImage');
Route::get('admin/images/{id}/supprimer', 'Admin\ImageController@show')->name('supprimerImage');
Route::get('admin/images/{id}/supprimer/confirm=true', 'Admin\ImageController@destroy')->name('supprimerImageForm');

/* UTILISATEURS - ADMINSTRATEURS */

Route::get('admin/users', 'Admin\UserController@index')->name('listeUser');
Route::post('admin/users', 'Admin\UserController@store')->name('ajouterUser');
Route::get('admin/users/{id}/supprimer', 'Admin\UserController@show')->name('supprimerUser');
Route::get('admin/users/{id}/supprimer/confirm=true', 'Admin\UserController@destroy')->name('supprimerUserForm');

/* CONNEXION - DECONNEXION - ADMINISTRATEURS */

Route::post('admin/login/form', 'Admin\UserController@login')->name('login');
Route::get('admin/logout', 'Admin\UserController@logout')->name('logout');

/* MOT DE PASSE OUBLIE ADMINITRATEURS */

Route::post('admin/resets/password', 'Admin\ResetController@password')->name('resetPassword');
Route::get('admin/password/success', 'Admin\ResetController@passwordSuccess')->name('passwordSuccess');

/* PROFIL ADMINSTRATEURS */

Route::get('admin/profil', 'Admin\UserController@profil')->name('profil');
Route::post('admin/profil/{id}/', 'Admin\UserController@update')->name('updateProfil');
Route::post('admin/password/update', 'Admin\ResetController@updatePassword')->name('updatePassword');

/* ANNONCES ADMINSTRATEURS */

Route::get('admin/annonces', 'Admin\AnnonceController@index')->name('listeAnnonce');
Route::post('admin/annonces', 'Admin\AnnonceController@store')->name('ajouterAnnonce');
Route::get('admin/annonces/{id}/details', 'Admin\AnnonceController@edit')->name('detailsAnnonce');
Route::get('admin/annonces/{id}/supprimer', 'Admin\AnnonceController@show')->name('supprimerAnnonce');
Route::get('admin/annonces/{id}/supprimer/confirm=true', 'Admin\AnnonceController@destroy')->name('supprimerAnnonceForm');
Route::post('admin/annonces/{id}/update', 'Admin\AnnonceController@update')->name('updateAnnonce');

/* CATEGORIES ADMINSTRATEURS */

Route::get('admin/categories', 'Admin\CategorieController@index')->name('listeCategorie');
Route::post('admin/categories', 'Admin\CategorieController@store')->name('ajouterCategorie');
Route::get('admin/categories/{id}/details', 'Admin\CategorieController@edit')->name('detailsCategorie');
Route::get('admin/categories/{id}/supprimer', 'Admin\CategorieController@show')->name('supprimerCategorie');
Route::get('admin/categories/{id}/supprimer/confirm=true', 'Admin\CategorieController@destroy')->name('supprimerCategorieForm');
Route::post('admin/categories/{id}/update', 'Admin\CategorieController@update')->name('updateCategorie');

/* PRODUITS ADMINSTRATEURS */

Route::get('admin/produits', 'Admin\ProduitController@index')->name('listeProduit');
Route::post('admin/produits', 'Admin\ProduitController@store')->name('ajouterProduit');
Route::get('admin/produits/{id}/details', 'Admin\ProduitController@edit')->name('detailsProduit');
Route::get('admin/produits/{id}/supprimer', 'Admin\ProduitController@show')->name('supprimerProduit');
Route::get('admin/produits/{id}/supprimer/confirm=true', 'Admin\ProduitController@destroy')->name('supprimerProduitForm');
Route::post('admin/produits/{id}/update', 'Admin\ProduitController@update')->name('updateProduit');

/* EQUIPE ADMINISTRATEURS */
Route::get('admin/equipe/ajouter-membre', 'Admin\TeamController@create')->name('ajouterMembre');
Route::post('admin/equipe/ajouter-membre', 'Admin\TeamController@store')->name('storeMembre');
Route::get('admin/equipe/membres', 'Admin\TeamController@index')->name('listeMembre');
Route::get('admin/equipe/membre/{team}-{slug}/details', 'Admin\TeamController@show')->name('showMembre');
Route::patch('admin/equipe/membre/{team}-{slug}/update', 'Admin\TeamController@update')->name('updateMembre');
Route::delete('admin/equipe/membre/{team}', 'Admin\TeamController@destroy')->name('deleteMembre');

/* SERVICES ADRIMINISTRATEURS */
Route::get('admin/services/ajouter', 'Admin\ServiceController@create')->name('ajouterService');
Route::post('admin/services/ajouter-processing', 'Admin\ServiceController@store')->name('storeService');
Route::get('admin/services', 'Admin\ServiceController@index')->name('listeService');
Route::get('admin/services/{service}-{slug}/details', 'Admin\ServiceController@show')->name('showService');
Route::patch('admin/services/{service}-{slug}/update-processing', 'Admin\ServiceController@update')->name('updateService');
Route::delete('admin/services/{service}/delete-processing', 'Admin\ServiceController@destroy')->name('deleteService');

/* SITES ADRIMINISTRATEURS */
Route::get('admin/sites/ajouter', 'Admin\SiteController@create')->name('ajouterSite');
Route::post('admin/sites/ajouter-processing', 'Admin\SiteController@store')->name('storeSite');
Route::get('admin/sites', 'Admin\SiteController@index')->name('listeSite');
Route::get('admin/sites/{site}-{slug}/details', 'Admin\SiteController@show')->name('showSite');
Route::patch('admin/sites/{site}-{slug}/update-processing', 'Admin\SiteController@update')->name('updateSite');
Route::delete('admin/sites/{site}/delete-processing', 'Admin\SiteController@destroy')->name('deleteSite');

// Banierre produit
Route::get('admin/produits/ajouterProduitAuBanniere/{id}', 'Admin\ProduitController@ajouterProduitAuBanniere')->name('ajouterProduitAuBanniere');
Route::get('admin/produits/{id}/supprimerProduitDuBanniere', 'Admin\ProduitController@supprimerProduitDuBanniere')->name('supprimerProduitDuBanniere');
Route::get('admin/produits/listeProduitDeBanniere', 'Admin\ProduitController@listeProduitBanniere')->name('listeProduitDeBanniere');
Route::post('admin/produits/modifierNombreBanniere', 'Admin\ProduitController@modifierNombreBanniere')->name('modifierNombreBanniere');
Route::get('admin/produits/valeurNombreBanniere', 'Admin\ProduitController@valeurNombreBanniere')->name('valeurNombreBanniere');


/* MESSAGES ADMINISTRATEURS */

Route::get('admin/messages', 'Admin\MainController@messages')->name('message');

/* BANIERES ADMINISTRATEURS */
Route::get('admin/banieres', 'Admin\MainController@baniere')->name('banieres');
