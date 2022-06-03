<?php

namespace App\Console\Commands;
use App\Models\Blog;

use Illuminate\Console\Command;

class DeleteBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteblogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete blogs which is 30 days old';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Blog::whereDate( 'created_at', '<=', now()->subDays(30))->delete();
    }
}
