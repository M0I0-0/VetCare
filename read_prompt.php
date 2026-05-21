<?php

$logPath = 'C:\\Users\\benja\\.gemini\\antigravity\\brain\\8f5c8ab6-f6e8-4fdf-9ca5-55cd3868ba57\\.system_generated\\logs\\transcript.jsonl';
if (!file_exists($logPath)) {
    die("Log file not found!\n");
}

$file = fopen($logPath, 'r');
if ($file) {
    $firstLine = fgets($file);
    fclose($file);
    
    $data = json_decode($firstLine, true);
    if (isset($data['content'])) {
        $content = $data['content'];
        $len = strlen($content);
        $chunkSize = 2000;
        
        echo "Total length: $len characters\n";
        for ($i = 0; $i < $len; $i += $chunkSize) {
            echo "--- CHUNK starting at $i ---\n";
            echo substr($content, $i, $chunkSize) . "\n";
        }
    } else {
        echo "No content found in first step!\n";
    }
} else {
    echo "Could not open log file!\n";
}
