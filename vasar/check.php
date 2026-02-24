<?php
// Проверка конфигурации PHP
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка системы — vasar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1a2e;
            color: white;
            padding: 40px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            color: #667eea;
        }
        .check {
            background: rgba(255,255,255,0.05);
            padding: 15px 20px;
            border-radius: 10px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ok { color: #4ade80; }
        .error { color: #f87171; }
        .warning { color: #fbbf24; }
        a {
            color: #667eea;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Проверка системы vasar</h1>
        
        <?php
        $checks = [];
        
        // Проверка версии PHP
        $phpVersion = phpversion();
        $phpOk = version_compare($phpVersion, '8.0.0', '>=');
        $checks[] = [
            'name' => 'Версия PHP (требуется 8.0+)',
            'value' => $phpVersion,
            'status' => $phpOk ? 'ok' : 'error'
        ];
        
        // Проверка cURL
        $curlEnabled = function_exists('curl_init');
        $checks[] = [
            'name' => 'cURL扩展',
            'value' => $curlEnabled ? 'Включён' : 'Выключен',
            'status' => $curlEnabled ? 'ok' : 'error'
        ];
        
        // Проверка JSON
        $jsonEnabled = function_exists('json_decode');
        $checks[] = [
            'name' => 'JSON',
            'value' => $jsonEnabled ? 'Включён' : 'Выключен',
            'status' => $jsonEnabled ? 'ok' : 'error'
        ];
        
        // Проверка allow_url_fopen
        $allowUrlFopen = ini_get('allow_url_fopen');
        $checks[] = [
            'name' => 'allow_url_fopen',
            'value' => $allowUrlFopen ? 'Включён' : 'Выключен',
            'status' => $allowUrlFopen ? 'ok' : 'warning'
        ];
        
        foreach ($checks as $check) {
            $class = $check['status'];
            $icon = $check['status'] === 'ok' ? '✓' : ($check['status'] === 'error' ? '✗' : '⚠');
            echo "<div class='check'>";
            echo "<span>{$check['name']}</span>";
            echo "<span class='{$class}'>{$icon} {$check['value']}</span>";
            echo "</div>";
        }
        
        $allOk = !in_array('error', array_column($checks, 'status'));
        
        if ($allOk) {
            echo "<div style='margin-top: 30px; padding: 20px; background: rgba(74, 222, 128, 0.1); border-radius: 10px; border: 1px solid rgba(74, 222, 128, 0.3);'>";
            echo "<h2 class='ok'>✓ Все проверки пройдены!</h2>";
            echo "<p>Вы можете перейти на <a href='/vasar/'>главную страницу</a>.</p>";
            echo "</div>";
        } else {
            echo "<div style='margin-top: 30px; padding: 20px; background: rgba(248, 113, 113, 0.1); border-radius: 10px; border: 1px solid rgba(248, 113, 113, 0.3);'>";
            echo "<h2 class='error'>✗ Обнаружены проблемы</h2>";
            echo "<p>Пожалуйста, включите необходимые расширения в <code>php.ini</code>:</p>";
            echo "<ul>";
            if (!$curlEnabled) {
                echo "<li>Раскомментируйте <code>extension=curl</code> в php.ini</li>";
            }
            echo "</ul>";
            echo "<p>После изменений перезапустите Apache в XAMPP Control Panel.</p>";
            echo "</div>";
        }
        ?>
        
        <div style="margin-top: 30px;">
            <a href="/vasar/">← Вернуться на главную</a>
        </div>
    </div>
</body>
</html>
