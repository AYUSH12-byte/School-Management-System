<?php

$files = glob('app/Filament/Resources/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace 'use Filament\Forms\Form;' with 'use Filament\Schemas\Schema;'
    $content = str_replace('use Filament\Forms\Form;', 'use Filament\Schemas\Schema;', $content);
    
    // Replace 'public static function form(Form $form): Form' with 'public static function form(Schema $form): Schema'
    $content = str_replace('public static function form(Form $form): Form', 'public static function form(Schema $form): Schema', $content);
    
    // Save
    file_put_contents($file, $content);
    echo "Fixed Form -> Schema in $file\n";
}
