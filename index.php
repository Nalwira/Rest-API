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
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow-sm py-4 mb-8">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
      <h1 class="text-2xl md:text-3xl font-bold text-blue-700">REST API Dashboard</h1>
      <span class="text-sm text-gray-500">📅 <?= date("Y-m-d") ?></span>
    </div>
  </header>

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
          <a href="/rest-api/$dir/" class="block bg-white rounded-xl shadow-sm hover:shadow-md transition border hover:border-blue-600 p-5">
            <div class="flex items-center justify-between mb-2">
              <div class="text-3xl">$icon</div>
              <div class="text-xs text-gray-400">Modified</div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">$label</h2>
            <p class="text-sm text-gray-500 mt-1 font-mono">$modified</p>
          </a>
          HTML;
        }
      ?>
    </section>
  </main>

  <!-- Footer -->
  <footer class="mt-12 py-6 border-t text-center text-sm text-gray-400">
    &copy; <?= date("Y") ?> REST API Dashboard • Built with PHP & TailwindCSS
  </footer>

</body>
</html>
