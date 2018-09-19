<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function generarBackup() {
        try{
            $archivo = 'backup-' . date('Y-m-d');
            Artisan::call('backup:mysql-dump',
                         [
                             'filename' => $archivo
                         ]);
            return response()
                    ->download(
                        storage_path('app/backups/'.$archivo.'.sql.gz')
                    );
        } catch(\Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()]
            );
        }
    }
}
