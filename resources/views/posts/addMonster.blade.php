@extends('template.index')

@section ('content')
<button @click="open = !open" class="text-white md:hidden">
    <i class="fa fa-bars"></i>
  </button>

  <div class="hidden md:flex items-center">
    <!-- <a
      class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
      href="#"
      >Créateurs</a
    > -->
    <!-- <a
      class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
      href="#"
      >Se connecter</a
    > -->

    <!-- Utilisation d'un bouton pour ouvrir le menu déroulant de l'utilisateur -->
    <!-- <div class="relative" x-data="{ userMenuOpen: false }">
      <button @click="userMenuOpen = !userMenuOpen" class="text-white">
        <img src="images/user.webp" alt="" class="w-16" />
      </button>

      <div
        x-show="userMenuOpen"
        @click.away="userMenuOpen = false"
        class="absolute right-0 mt-2 w-48 bg-gray-100 rounded-md shadow-lg pb-1 z-50"
      >
        <div class="text-gray-200 px-4 py-2 bg-gray-400 text-center">
          Username
        </div>
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
          >Mon Profil</a
        >
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
          >Mon Deck</a
        >
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
          >Ajouter un Monstre</a
        >
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
          >Se Déconnecter</a
        >
      </div>
    </div> -->
  </div>
</nav>

<!-- Menu pour mobile -->
<div x-show="open" class="md:hidden p-8">
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Monstres</a
  >
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Ajouter un monstre</a
  >
  <!-- <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Se connecter</a
  >
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Mon Profil</a
  >
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Mon Deck</a
  >
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Ajouter un Monstre</a
  >
  <a
    class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
    href="#"
    >Se Déconnecter</a
  > -->
</div>
</header>

<!-- Main Content -->
<div class="container mx-auto flex flex-wrap pt-4 pb-12">
<main class="w-full md:w-3/4 p-4">
  <div class="container mx-auto pb-12">
    <div class="flex flex-wrap justify-center">
      <div class="w-full">
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold mb-4 text-center creepster">
            Ajouter un monstre
          </h2>
          <form action="{{ route('monsters.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="name" class="block mb-1">Nom</label>
              <input
                type="text"
                name="name"
                id="name"
                class="w-full border rounded px-3 py-2 text-gray-700"
                placeholder="Nom du Monstre"
              />
            </div>
            <div>Le type </div>
            <select name="type" class="w-full p-2 mb-4 bg-gray-800 rounded">
              <option value="" disabled selected>Choisir un type</option>
              <option value="aquatique">Aquatique</option>
              <option value="terrestre">Terrestre</option>
              <option value="volant">Volant</option>
              <option value="cosmique">Cosmique</option>
              <option value="spectral">Spectral</option>
            </select>
            <div class="flex justify-between items-center">
              <button
                type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
              >
                Ajouter
              </button>
              <button
                type="reset"
                class="text-red-400 hover:text-red-500"
              >
                Annuler
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<aside class="w-full md:w-1/4 p-4">
  <!-- Formulaire de Recherche Full Texte -->
  <form
  action="{{ route('posts.search') }}"
  method="GET"
  class="bg-gray-700 rounded-lg shadow-lg p-4 mb-6"
  >
  <h2 class="font-bold text-lg mb-4">Recherche</h2>
  <input
      type="text"
      name="text"
      placeholder="Chercher un monstre..."
      class="w-full p-2 mb-4 bg-gray-800 rounded"
  />
  <button
      type="submit"
      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
  >
      Chercher
  </button>
  </form>
  <!-- Formulaire de Recherche par Critères -->
  <form
  action="{{route('posts.crit')}}"
  method="GET"
  class="bg-gray-700 rounded-lg shadow-lg p-4"
  >
  <h2 class="font-bold text-lg mb-4">Filtrer par Critères</h2>

  <!-- Type -->
  <select name="type" class="w-full p-2 mb-4 bg-gray-800 rounded">
      <option value="" disabled selected>Choisir un type</option>
      <option value="aquatique">Aquatique</option>
      <option value="terrestre">Terrestre</option>
      <option value="volant">Volant</option>
      <option value="cosmique">Cosmique</option>
      <option value="spectral">Spectral</option>
  </select>

  <!-- Rareté -->
  <select name="rarete" class="w-full p-2 mb-4 bg-gray-800 rounded">
      <option value="" disabled selected>Choisir une rareté</option>
      <option value="commun">Commun</option>
      <option value="rare">Rare</option>
      <option value="epique">Épique</option>
      <option value="legendaire">Légendaire</option>
  </select>

  <!-- PV -->
  <div class="bg-gray-700 rounded-lg shadow-lg p-4 mb-4">
      <h2 class="font-bold text-lg mb-4">Filtrer par PV</h2>
      <div id="slider-pv" class="mb-4"></div>
      <span id="slider-pv-value"></span>
      <input type="hidden" id="min-pv" name="min_pv" />
      <input type="hidden" id="max-pv" name="max_pv" />
      <script>
      var sliderPv = document.getElementById("slider-pv");
      var minPv = document.getElementById("min-pv");
      var maxPv = document.getElementById("max-pv");
      var sliderPvValue = document.getElementById("slider-pv-value");

      noUiSlider.create(sliderPv, {
          start: [0, 200], // Valeurs initiales pour min et max PV
          connect: true,
          range: {
          min: 0,
          max: 200,
          },
      });

      sliderPv.noUiSlider.on("update", function (values, handle) {
          minPv.value = values[0];
          maxPv.value = values[1];
          sliderPvValue.innerHTML = "PV: " + values.join(" - ");
      });
      </script>
  </div>

  <!-- Attaque -->
  <div class="bg-gray-700 rounded-lg shadow-lg p-4 mb-4">
      <h2 class="font-bold text-lg mb-4">Filtrer par Attaque</h2>
      <div id="slider-attaque" class="mb-4"></div>
      <span id="slider-attaque-value"></span>
      <input type="hidden" id="min-attaque" name="min_attaque" />
      <input type="hidden" id="max-attaque" name="max_attaque" />
      <script>
      var sliderAttaque = document.getElementById("slider-attaque");
      var minAttaque = document.getElementById("min-attaque");
      var maxAttaque = document.getElementById("max-attaque");
      var sliderAttaqueValue = document.getElementById(
          "slider-attaque-value"
      );

      noUiSlider.create(sliderAttaque, {
          start: [0, 200], // Valeurs initiales pour min et max Attaque
          connect: true,
          range: {
          min: 0,
          max: 200,
          },
      });

      sliderAttaque.noUiSlider.on("update", function (values, handle) {
          minAttaque.value = values[0];
          maxAttaque.value = values[1];
          sliderAttaqueValue.innerHTML = "Attaque: " + values.join(" - ");
      });
      </script>
  </div>

  <button
      type="submit"
      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full"
  >
      Appliquer les filtres
  </button>
  </form>
</aside>
</div>

@endsection