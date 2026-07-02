<?php

$files = glob('app/Filament/Resources/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Add use Filament\Actions; if not present
    if (strpos($content, 'use Filament\Actions;') === false) {
        $content = str_replace('use Filament\Tables;', "use Filament\Actions;\nuse Filament\Tables;", $content);
    }
    
    // Replace Tables\Actions with Actions
    $content = str_replace('Tables\Actions\\', 'Actions\\', $content);
    
    file_put_contents($file, $content);
    echo "Fixed Actions namespace in $file\n";
}
