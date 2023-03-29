<?php

namespace App\Console\Commands;

use App\Imports\PostImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import post from excel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Excel::import(new PostImport(), public_path('excel/posts.xlsx'));
    }
}
