<?php
// ai-chat.php - Backend für KI-Assistenten

header('Content-Type: application/json');

// Lade .env Datei wenn vorhanden
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    $envLines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, '\'"');
        putenv("$key=$value");
    }
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $message = $input['message'] ?? '';

    if (empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nachricht erforderlich']);
        exit;
    }

    // Prüfe API-Key
    $apiKey = getenv('ANTHROPIC_API_KEY');
    if (!$apiKey || $apiKey === 'your-api-key-here') {
        // Demo-Modus: Gib eine hilfreiche Antwort zurück
        $demoReplies = [
            'Hallo! Um mich vollständig zu nutzen, brauchst du einen Anthropic API-Key. Kopiere die .env.example Datei zu .env und füge deinen Key ein! 🔑',
            'Du kannst einen kostenlosen API-Key auf https://console.anthropic.com/ bekommen. Dann speichere ihn in einer .env Datei im Projektarbeit-Ordner.',
            'Demo-Modus aktiv! Für vollständige KI-Antworten bitte API-Key in .env eintragen.',
            'Ich funktioniere besser mit deinem API-Key! 😊 Hol dir einen auf console.anthropic.com/',
        ];
        
        $reply = $demoReplies[array_rand($demoReplies)];
        echo json_encode([
            'success' => true,
            'reply' => $reply,
            'demo' => true
        ]);
        exit;
    }

    $apiEndpoint = 'https://api.anthropic.com/v1/messages';

    $payload = [
        'model' => 'claude-3-5-sonnet-20241022',
        'max_tokens' => 1024,
        'system' => 'Du bist ein hilfreicher KI-Assistent für die BVB-Fanseite. Du beantwortest Fragen freundlich, kurz und prägnant. Du kannst über BVB, Fußball, Tickets, Shop-Artikel und andere Inhalte der Website sprechen.',
        'messages' => [
            [
                'role' => 'user',
                'content' => $message
            ]
        ]
    ];

    $ch = curl_init($apiEndpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey,
        'anthropic-version: 2023-06-01'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($httpCode !== 200) {
        // Bessere Fehlerbehandlung
        if ($httpCode === 401) {
            echo json_encode(['error' => '❌ API-Key ungültig. Überprüfe deine .env Datei!']);
        } else if ($httpCode === 429) {
            echo json_encode(['error' => '⏱️ Zu viele Anfragen. Warte kurz...']);
        } else if ($curlError) {
            echo json_encode(['error' => '🌐 Verbindungsfehler: ' . $curlError]);
        } else {
            echo json_encode(['error' => 'API-Fehler (Code ' . $httpCode . ')']);
        }
        exit;
    }

    $data = json_decode($response, true);
    $replyText = $data['content'][0]['text'] ?? 'Entschuldigung, ich konnte keine Antwort generieren.';

    echo json_encode([
        'success' => true,
        'reply' => $replyText
    ]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Methode nicht erlaubt']);
?>
