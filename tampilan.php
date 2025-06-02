<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>REST API Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="min-h-screen flex flex-col items-center justify-center p-6">
    <div class="max-w-4xl w-full">
      <h1 class="text-4xl font-bold mb-6 text-center text-blue-700">📦 REST API Directory Dashboard</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php
          $dirs = [
            'json' => '📁 JSON',
            'wpu-hut' => '📁 WPU HUT',
            'wpu-movie' => '📁 WPU Movie',
            'wpu-portfolio' => '📁 WPU Portfolio',
            'wpu-rest-client' => '📁 WPU Rest Client',
            'wpu-rest-server' => '📁 WPU Rest Server'
          ];

          foreach ($dirs as $dir => $label) {
            $path = __DIR__ . "/$dir";
            $modified = file_exists($path) ? date("Y-m-d H:i", filemtime($path)) : "N/A";
            echo <<<HTML
              <a href="/rest-api/$dir/" class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition">
                <h2 class="text-xl font-semibold text-indigo-600">$label</h2>
                <p class="text-sm mt-2">Last modified: $modified</p>
              </a>
            HTML;
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
