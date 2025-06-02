<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>REST API Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      transition: background-color 0.3s, color 0.3s;
    }
    .dark {
      background-color: #1f2937;
      color: #f3f4f6;
    }
    .dark a {
      background-color: #374151;
      border-color: #4b5563;
    }
    .dark .text-gray-800 {
      color: #f3f4f6;
    }
    .dark .text-gray-500 {
      color: #d1d5db;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 ease-in-out">

  <!-- Header -->
  <header class="bg-white shadow-sm py-4 mb-6 dark:bg-gray-800 dark:shadow-md transition duration-300">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
      <h1 class="text-2xl md:text-3xl font-bold text-blue-700 dark:text-blue-300">REST API Dashboard</h1>
      <div class="flex items-center gap-4">
        <span class="text-sm text-gray-500 dark:text-gray-300">📅 <?= date("Y-m-d") ?></span>
        <button onclick="document.body.classList.toggle('dark')" class="text-xs border px-2 py-1 rounded-md hover:bg-blue-100 dark:hover:bg-gray-700 transition-all duration-300">
          🌗 Toggle Dark Mode
        </button>
      </div>
    </div>
  </header>

  <!-- Search Bar -->
  <div class="max-w-7xl mx-auto px-4 mb-6">
    <input type="text" id="search" placeholder="🔍 Cari folder..." class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 transition duration-300">
  </div>

  <!-- Content -->
  <main class="max-w-7xl mx-auto px-4">
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
        $dirs = [
          'json' => 'JSON Resources',
          'wpu-hut' => 'WPU HUT',
          'wpu-movie' => 'WPU Movie',
          'wpu-portfolio' => 'WPU Portfolio',
          'wpu-rest-client' => 'WPU REST Client',
          'wpu-rest-server' => 'WPU REST Server'
        ];

        foreach ($dirs as $dir => $label) {
          $path = __DIR__ . "/$dir";
          $modified = file_exists($path) ? date("Y-m-d H:i", filemtime($path)) : "N/A";
          $count = is_dir($path) ? count(scandir($path)) - 2 : 0;
          $icon = match ($dir) {
            'json' => '🗂',
            'wpu-hut' => '🎉',
            'wpu-movie' => '🎬',
            'wpu-portfolio' => '💼',
            'wpu-rest-client' => '🔗',
            'wpu-rest-server' => '🛠',
            default => '📁'
          };

          echo <<<HTML
          <a href="/rest-api/$dir/" 
             class="api-card block bg-white rounded-xl shadow-sm hover:shadow-xl transition-all transform hover:scale-[1.02] duration-300 border hover:border-blue-600 p-5 dark:bg-gray-800 dark:border-gray-700 dark:hover:border-blue-400 opacity-0 translate-y-3 animate-fade-in-up" 
             data-label="$label">
            <div class="flex items-center justify-between mb-2">
              <div class="text-3xl">$icon</div>
              <div class="text-xs text-gray-400 dark:text-gray-300">Modified</div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">$label</h2>
            <p class="text-sm text-gray-500 mt-1 font-mono">$modified</p>
            <p class="text-xs text-gray-500 mt-1">$count file(s)</p>
          </a>
          HTML;
        }
      ?>
    </section>
  </main>

  <!-- Footer -->
  <footer class="mt-12 py-6 border-t text-center text-sm text-gray-400 dark:text-gray-500 dark:border-gray-700">
    &copy; <?= date("Y") ?> REST API Dashboard • Built with PHP & TailwindCSS
  </footer>

  <!-- Animasi Fade In Up -->
  <style>
    @keyframes fade-in-up {
      from {
        opacity: 0;
        transform: translateY(12px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.6s ease-out forwards;
    }

    .api-card:nth-child(1) { animation-delay: 0.05s; }
    .api-card:nth-child(2) { animation-delay: 0.1s; }
    .api-card:nth-child(3) { animation-delay: 0.15s; }
    .api-card:nth-child(4) { animation-delay: 0.2s; }
    .api-card:nth-child(5) { animation-delay: 0.25s; }
    .api-card:nth-child(6) { animation-delay: 0.3s; }
  </style>

  <!-- Search Function -->
  <script>
    document.getElementById("search").addEventListener("input", function() {
      const val = this.value.toLowerCase();
      document.querySelectorAll(".api-card").forEach(card => {
        const name = card.dataset.label.toLowerCase();
        card.style.display = name.includes(val) ? "block" : "none";
      });
    });
  </script>

</body>
</html>
