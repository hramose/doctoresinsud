<?php

namespace App\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Http\Controllers\ImportControler;

class ImportDB extends Command implements SelfHandling
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesamiento de los datos del doctor';
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $impor = new ImportControler();
        $impor->epidiImport();
    }
}
