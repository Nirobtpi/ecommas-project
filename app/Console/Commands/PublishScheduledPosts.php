<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-posts';
     

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts=Post::where('published_at','<=', now())->where('status',0)->get();

        foreach ($posts as $post) {
            $post->update(['status' => 1]);
        }
        $this->info('Scheduled posts have been published.');
    }
}
