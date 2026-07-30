<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = ['migrations', 'users', 'events', 'registrations', 'coupons'];

file_put_contents(__DIR__ . '/database_mauu.sql', "-- Database: mauu\n-- Generated: " . date('Y-m-d H:i:s') . "\n\n");

foreach ($tables as $table) {
    $cols = DB::select("SHOW CREATE TABLE `{$table}`");
    $createSQL = $cols[0]->{'Create Table'} . ";\n\n";
    file_put_contents(__DIR__ . '/database_mauu.sql', "DROP TABLE IF EXISTS `{$table}`;\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/database_mauu.sql', $createSQL, FILE_APPEND);
    
    $rows = DB::table($table)->get();
    if ($rows->isEmpty()) continue;
    
    $headers = array_keys((array)$rows[0]);
    $chunks = $rows->chunk(100);
    
    foreach ($chunks as $chunk) {
        $values = [];
        foreach ($chunk as $row) {
            $vals = [];
            foreach ($headers as $h) {
                $v = $row->$h;
                if (is_null($v)) {
                    $vals[] = 'NULL';
                } elseif (is_numeric($v) && !is_string($v)) {
                    $vals[] = $v;
                } else {
                    $vals[] = "'" . str_replace(["\\", "'"], ["\\\\", "\\'"], $v) . "'";
                }
            }
            $values[] = '(' . implode(',', $vals) . ')';
        }
        
        $sql = "INSERT INTO `{$table}` (`" . implode('`,`', $headers) . "`) VALUES\n" . implode(",\n", $values) . ";\n\n";
        file_put_contents(__DIR__ . '/database_mauu.sql', $sql, FILE_APPEND);
    }
}

echo "SQL file created: database_mauu.sql\n";
