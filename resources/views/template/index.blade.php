<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RetroMonsters</title>
    <link rel="icon" type="image/png" href="images/favico.png" />

    <link
      href="https://fonts.googleapis.com/css2?family=Creepster&family=Roboto:wght@100;400;900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
    <style>
      .monster-card[data-monster-type="cosmique"] {
        background: linear-gradient(to right, #6e48aa, #9d50bb);
      }

      .monster-card[data-monster-type="aquatique"] {
        background: linear-gradient(to right, #395ca6, #546da4);
      }

      .monster-card[data-monster-type="terrestre"] {
        background: linear-gradient(to right, #3a4146, #657581);
      }

      .monster-card[data-monster-type="volant"] {
        background: linear-gradient(to right, #2e5063, #457791);
      }

      .monster-card[data-monster-type="spectral"] {
        background: linear-gradient(to right, #7b195a, #9d3078);
      }
      body {
        font-family: "Roboto", sans-serif;
      }
      .creepster {
        font-family: "Creepster", system-ui;
        font-size: 2rem;
        letter-spacing: 0.2rem;
      }

      .noUi-connect {
        background: #516ba4;
      }
    </style>
  </head>
  <body class="bg-gray-800 text-white font-sans">
    <!-- Header -->
    <header class="bg-gray-900 shadow-lg relative top-8" x-data="{ open: false, loggedIn: true, userMenuOpen: false }">
      <nav
        class="container mx-auto px-4 py-4 mb-16 flex justify-between items-center"
      >
        <div class="flex items-center">
          <a href="{{route('posts.index')}}">
            <img
              src="{{ asset('images/Logo_RetroMonsters.png') }}"
              alt="LogoMonsters"
              class="h-32 mr-3 absolute"
              style="top: -28px"
            />
          </a>
          <a href="{{route('posts.index')}}" class="text-white font-bold text-xl hidden">RetroMonsters</a>
        </div>

        <button @click="open = !open" class="text-white md:hidden">
          <i class="fa fa-bars"></i>
        </button>

        <div class="hidden md:flex items-center">
          <a
            class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
            href="{{ route('posts.monsters') }}"
            >Monstres</a
          >
          <a
            class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700 active"
            href="{{ route('posts.addMonster') }}"
            >Ajouter un monstre</a
          >
      </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">
      <div class="container mx-auto text-center">
        <p>&copy; 2024 RetroMonsters. Tous droits réservés.</p>
      </div>
    </footer>
  </body>
</html>
