<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Index of /rest-api/json</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">
  <div class="max-w-4xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Index of /rest-api/json</h1>
    <table class="table-auto w-full border-t border-gray-300">
      <thead>
        <tr class="text-left border-b border-gray-200">
          <th class="py-2 px-3">Name</th>
          <th class="py-2 px-3">Last modified</th>
          <th class="py-2 px-3">Size</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        <tr class="border-b border-gray-100">
          <td class="py-2 px-3">
            <a href="../" class="text-blue-600 hover:underline">Parent Directory</a>
          </td>
          <td class="py-2 px-3">-</td>
          <td class="py-2 px-3">-</td>
        </tr>
        <?php
          $files = array_diff(scandir(__DIR__), array('..', '.','index.php'));
          foreach ($files as $file) {
            $filePath = __DIR__ . '/' . $file;
            $isDir = is_dir($filePath);
            $size = $isDir ? '-' : filesize($filePath);
            $modified = date("Y-m-d H:i", filemtime($filePath));
            $sizeFormatted = $isDir ? '-' : (round($size / 1024, 1) . 'K');
            echo "<tr class='border-b border-gray-100 hover:bg-gray-50'>
              <td class='py-2 px-3'>
                <a href=\"$file\" class='text-blue-600 hover:underline'>" . htmlspecialchars($file) . "</a>
              </td>
              <td class='py-2 px-3'>$modified</td>
              <td class='py-2 px-3'>$sizeFormatted</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>
    <p class="text-xs text-gray-400 mt-6">
      Apache/2.4.58 (PHP <?= phpversion(); ?>) Server at localhost Port 8080
    </p>
  </div>
</body>
</html>
