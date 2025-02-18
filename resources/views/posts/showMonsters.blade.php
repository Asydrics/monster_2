@extends('template.index')

@section('content')
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
            <main class="w-full md:w-3/4 p-4">
                <!-- Section Derniers monstres -->
                <section class="mb-20">
                    <h2 class="text-2xl font-bold mb-4 creepster">
                        Tous les Monstres
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Monster Item -->
                    @foreach ($posts as $post)
                    <article
                    class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
                    data-monster-type="{{ strtolower($post->monster_type->name) }}"
                    >
                    <img
                        class="w-full h-48 object-cover rounded-t-lg"
                        src="{{ asset('images/' . $post->image_url) }}"
                        alt="AbyssalRevenant"
                    />
                    <div class="p-4">
                        <h3 class="text-xl font-bold">{{ $post->name }}</h3>
                        <h4 class="mb-2">
                        <a href="#" class="text-red-400 hover:underline"
                            >{{ $post->user_id }}</a
                        >
                        </h4>
                        <p class="text-gray-300 text-sm mb-2">
                         {{ $post->description}}
                        </p>
                        <div class="flex justify-between items-center mb-2">
                        <div>
                            <span class="text-yellow-400">★★★★☆</span>
                            <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                        </div>
                        <span class="text-sm text-gray-300">Type: {{ $post->monster_type->name }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-300">{{ $post->pv}}</span>
                        <span class="text-sm text-gray-300">{{ $post->attack}}</span>
                        </div>
                        <div class="text-center">
                        <a
                            href="{{route('posts.show', ['id' => $post->id, 'slug' => Str::slug($post->name, '-')])}}"
                            class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                            >Plus de détails</a
                        >
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button
                        class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
                        style="
                            width: 40px;
                            height: 40px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        "
                        >
                        <i class="fa fa-bookmark"></i>
                        </button>
                    </div>
                    </article>
                    @endforeach
                </div>
                </section>
            </main>
            <!-- Sidebar -->
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