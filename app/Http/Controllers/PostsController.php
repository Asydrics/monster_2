<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\Monster_type;

class PostsController extends Controller
{
    public function index() {
        // Chercher des infos dans la database
        $posts = Monster::orderBy('created_at', 'desc')
            ->take(9)
            ->get();
        // Afficher un monstre aléatoire
        $randomMonster = Monster::inRandomOrder()->first();

        // Charger une vue
        return view('posts.index', compact('posts', 'randomMonster'));
    }

    public function showMonsters() {
        $posts = Monster::all();
        return view('posts.showMonsters', compact('posts'));
    }

    public function addMonster() {
        return view('posts.addMonster');
    }

    //Ajouter un monstre
    public function store() {
        $name = request('name');
        $type = request('type');

        $typeId = Monster_type::where('name', $type)->first()->id;  // Utilisation du modèle MonsterType

        $monster = new Monster();
        $monster->name = $name;
        $monster->type_id = $typeId;
        $monster->rarety_id = 1;
        $monster->rarity = "Rare";
        $monster->pv = 100;
        $monster->attack = 150;
        $monster->defense = 200;
        $monster->created_at = now();
        $monster->updated_at = now();
        $monster->save();
        return redirect()->route('posts.index')->with('success', 'Monstre ajouté avec succès !');
    }

    //Supprimer un monstre
    public function destroy($id) {
        $monster = Monster::findOrFail($id);
        $monster->delete();
        return redirect()->route('posts.index')->with('success', 'Monstre supprimé avec succès !');
    }

    public function show($id, $slug) {
        $monster = Monster::where('id', $id)
        ->where('name', $slug)
        ->firstOrFail();
        return view('posts.show', compact('monster'));
    }

    public function edit($id) {
        // Récupère le monstre à partir de son ID
        $monster = Monster::findOrFail($id);
    
        // Retourne la vue 'update' avec les données du monstre
        return view('posts.edit', compact('monster'));
    }

    public function update($id) {
        // Trouver le monstre ou renvoyer une 404 si non trouvé
        $monster = Monster::findOrFail($id);
    
        // Récupérer les valeurs depuis la requête
        $pv = request('pv');
        $attack = request('attack');
        $defense = request('defense');
        $type = request('type');
        $name = request('name');
        $description = request ('description');

        $typeId = Monster_type::where('name', $type)->first()->id;
        
        // Mise à jour des champs du monstre
        $monster->pv = $pv;
        $monster->attack = $attack;
        $monster->defense = $defense;
        $monster->name = $name;
        $monster->description = $description;
        $monster->updated_at = now();
        $monster->type_id = $typeId;

        // dd($monster);
        // Sauvegarder les modifications
        $monster->save();
    
        // Redirection avec un message de succès
        return redirect()->route('posts.index')->with('success', 'Monstre mis à jour avec succès !');
    }
    
    public function showSearch()
    {
        // Récupérer la chaîne de recherche envoyée par l'utilisateur
        $query = request('text');

        // Rechercher les monstres dont le nom contient le terme de recherche (insensible à la casse)
        $monster = Monster::where('name', 'like', '%' . $query . '%')
            ->get();
        // Retourner les résultats dans une vue spécifique
        return view('posts.showSearch', compact('monster', 'query'));
    }

    public function showSearchCrit() {
        // Récupérer les valeurs des critères de filtre depuis la requête
        $type = request('type');
        $rarete = request('rarete');
        $minPv = request('min_pv');
        $maxPv = request('max_pv');
        $minAttaque = request('min_attaque');
        $maxAttaque = request('max_attaque');

        // Construire la requête avec les filtres
        $query = Monster::query();

        if ($type) {
            // Joindre la table des types de monstres et filtrer par type
            $query->whereHas('monster_type', function ($q) use ($type) {
                $q->where('name', $type);
            });
        }

        if ($rarete) {
            $query->where('rarity', $rarete);
        }

        if ($minPv && $maxPv) {
            $query->whereBetween('pv', [$minPv, $maxPv]);
        }

        if ($minAttaque && $maxAttaque) {
            $query->whereBetween('attack', [$minAttaque, $maxAttaque]);
        }
        // Exécuter la requête pour récupérer les monstres filtrés
        $monster = $query->get();

        // Retourner la vue avec les résultats
        return view('posts.showSearchCrit', compact('monster'));
    }
    
};


