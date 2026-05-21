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
        
        // Write the full raw user request to a clean text file
        file_put_contents('d:\\proyectogax\\full_prompt.txt', $content);
        echo "Full prompt written to d:\\proyectogax\\full_prompt.txt successfully!\n";
    } else {
        echo "No content found in first step!\n";
    }
} else {
    echo "Could not open log file!\n";
}
