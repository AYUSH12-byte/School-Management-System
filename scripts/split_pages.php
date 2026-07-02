<?php

$dir = new RecursiveDirectoryIterator('app/Filament/Resources');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if (str_ends_with($file->getFilename(), 'Pages.php')) {
        $content = file_get_contents($file->getPathname());
        $namespace = '';
        if (preg_match('/namespace\s+([^;]+);/', $content, $matches)) {
            $namespace = trim($matches[1]);
        }

        $uses = [];
        preg_match_all('/use\s+([^;]+);/', $content, $useMatches);
        if (!empty($useMatches[1])) {
            $uses = $useMatches[1];
        }

        $classes = [];
        preg_match_all('/class\s+(\w+)\s+extends\s+\w+\s*\{.*?\n\}/s', $content, $classMatches, PREG_SET_ORDER);

        foreach ($classMatches as $classMatch) {
            $className = $classMatch[1];
            $classBody = $classMatch[0];
            
            $newContent = "<?php\n\nnamespace $namespace;\n\n";
            foreach ($uses as $use) {
                $newContent .= "use $use;\n";
            }
            $newContent .= "\n$classBody\n";
            
            file_put_contents(dirname($file->getPathname()) . '/' . $className . '.php', $newContent);
            echo "Created $className.php\n";
        }
        
        unlink($file->getPathname());
        echo "Deleted {$file->getFilename()}\n";
    }
}
