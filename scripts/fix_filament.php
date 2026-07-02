<?php

$files = glob('app/Filament/Resources/*Resource.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace the $navigationIcon property with a method
    $content = preg_replace(
        '/protected static \$navigationIcon = \'([^\']+)\';/',
        'public static function getNavigationIcon(): string|\BackedEnum|null { return \'$1\'; }',
        $content
    );
    
    // Replace the $navigationGroup property with a method
    $content = preg_replace(
        '/protected static \$navigationGroup = \'([^\']+)\';/',
        'public static function getNavigationGroup(): ?string { return \'$1\'; }',
        $content
    );
    
    file_put_contents($file, $content);
    echo "Fixed $file\n";
}
