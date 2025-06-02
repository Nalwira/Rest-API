<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <title>Index of /rest-api/wpu-hut</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Enable dark mode toggle
    tailwind.config = {
      darkMode: 'class',
    };
  </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans">
  <div class="max-w-5xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold">Index of /rest-api/wpu-hut</h1>
      <button id="toggleDark" class="text-sm px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
        🌙 Toggle Dark Mode
      </button>
    </div>

    <input type="text" id="searchInput" placeholder="Cari file atau folder..." class="w-full mb-4 px-3 py-2 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">

    <div class="overflow-x-auto">
      <table class="table-auto w-full border-t border-gray-300 dark:border-gray-700">
        <thead>
          <tr class="text-left border-b border-gray-300 dark:border-gray-600">
            <th class="py-2 px-3">Name</th>
            <th class="py-2 px-3">Last modified</th>
            <th class="py-2 px-3">Size</th>
          </tr>
        </thead>
        <tbody id="fileTable">
          <tr>
            <td class="py-2 px-3">
              <a href="../" class="text-blue-600 dark:text-blue-400 hover:underline">⬅️ Parent Directory</a>
            </td>
            <td class="py-2 px-3">-</td>
            <td class="py-2 px-3">-</td>
          </tr>
          <?php
            $files = array_diff(scandir(__DIR__), ['.', '..', 'index.php']);
            foreach ($files as $file) {
              $path = __DIR__ . '/' . $file;
              $isDir = is_dir($path);
              $icon = $isDir ? "📁" : "📄";
              $lastMod = date("Y-m-d H:i", filemtime($path));
              $size = $isDir ? '-' : (round(filesize($path) / 1024, 1) . ' KB');
              echo "<tr class='border-b border-gray-200 dark:border-gray-700'>
                      <td class='py-2 px-3'>
                        <a href='$file' class='text-blue-600 dark:text-blue-400 hover:underline'>$icon $file" . ($isDir ? '/' : '') . "</a>
                      </td>
                      <td class='py-2 px-3'>$lastMod</td>
                      <td class='py-2 px-3'>$size</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>

    <p class="text-xs text-gray-400 mt-6">
      Apache/<?= apache_get_version(); ?> PHP <?= phpversion(); ?> Server at localhost Port 8080
    </p>
  </div>

  <script>
    // Toggle dark mode
    document.getElementById('toggleDark').addEventListener('click', () => {
      document.documentElement.classList.toggle('dark');
    });

    // Filter file/folder by search input
    document.getElementById('searchInput').addEventListener('keyup', function () {
      const filter = this.value.toLowerCase();
      const rows = document.querySelectorAll('#fileTable tr');
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
