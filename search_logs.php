<?php

$logPath = 'C:\\Users\\benja\\.gemini\\antigravity\\brain\\8f5c8ab6-f6e8-4fdf-9ca5-55cd3868ba57\\.system_generated\\logs\\transcript.jsonl';
if (!file_exists($logPath)) {
    die("Log file not found!\n");
}

$file = fopen($logPath, 'r');
$index = 0;
while (($line = fgets($file)) !== false) {
    $data = json_decode($line, true);
    if ($data && isset($data['type']) && $data['type'] === 'USER_INPUT') {
        file_put_contents("d:\\proyectogax\\user_input_{$index}.txt", $data['content']);
        echo "Found USER_INPUT at step {$data['step_index']}, written to user_input_{$index}.txt\n";
        $index++;
    }
}
fclose($file);
