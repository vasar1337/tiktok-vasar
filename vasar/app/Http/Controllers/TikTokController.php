<?php

namespace App\Http\Controllers;

class TikTokController
{
    /**
     * Скачать видео с TikTok без водяного знака
     */
    public function download(): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        // Получаем JSON из запроса
        $input = json_decode(file_get_contents('php://input'), true);
        $url = $input['url'] ?? '';

        if (empty($url)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Пожалуйста, введите ссылку на видео',
            ]);
            return;
        }

        // Проверка, что это ссылка на TikTok
        if (!$this->isTikTokUrl($url)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Пожалуйста, введите корректную ссылку на TikTok видео',
            ]);
            return;
        }

        try {
            $videoData = $this->fetchTikTokVideo($url);

            if ($videoData) {
                echo json_encode([
                    'success' => true,
                    'data' => $videoData,
                ]);
                return;
            }

            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Не удалось получить видео. Проверьте ссылку и попробуйте снова',
            ]);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Произошла ошибка при обработке запроса',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Проверка URL на принадлежность к TikTok
     */
    private function isTikTokUrl(string $url): bool
    {
        $patterns = [
            '/tiktok\.com\/@[\w\.]+\/video\/\d+/i',
            '/vm\.tiktok\.com\/[\w]+/i',
            '/vt\.tiktok\.com\/[\w]+/i',
            '/www\.tiktok\.com\/t\/[\w]+/i',
            '/tiktok\.com\/t\/[\w]+/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Получение данных о видео через TikTok API
     */
    private function fetchTikTokVideo(string $url): ?array
    {
        // Используем публичное API для получения видео без водяного знака
        $apiUrl = 'https://www.tikwm.com/api/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['url' => $url]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($httpCode === 200 && $response && !$error) {
            $data = json_decode($response, true);

            if (isset($data['code']) && $data['code'] === 0 && isset($data['data'])) {
                $tikData = $data['data'];

                return [
                    'id' => $tikData['id'] ?? null,
                    'title' => $tikData['title'] ?? 'Без названия',
                    'author' => [
                        'username' => $tikData['author']['unique_id'] ?? 'unknown',
                        'nickname' => $tikData['author']['nickname'] ?? 'Unknown',
                        'avatar' => $tikData['author']['avatar'] ?? null,
                    ],
                    'video' => [
                        'no_watermark' => $tikData['play'] ?? null,
                        'watermark' => $tikData['wmplay'] ?? null,
                        'music' => $tikData['music'] ?? null,
                        'cover' => $tikData['cover'] ?? null,
                        'dynamic_cover' => $tikData['origin_cover'] ?? null,
                    ],
                    'stats' => [
                        'plays' => $tikData['play_count'] ?? 0,
                        'likes' => $tikData['digg_count'] ?? 0,
                        'comments' => $tikData['comment_count'] ?? 0,
                        'shares' => $tikData['share_count'] ?? 0,
                        'downloads' => $tikData['download_count'] ?? 0,
                    ],
                    'duration' => $tikData['duration'] ?? 0,
                    'created_at' => $tikData['create_time'] ?? null,
                ];
            }
        }

        return null;
    }
}
