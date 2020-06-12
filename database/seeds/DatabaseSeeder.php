<?php

use App\Video;
use App\Report;
use App\User;
use App\Comment;
use App\Playlist;
use App\Playlist_Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Video::truncate();
        Report::truncate();
        Comment::truncate();
        Playlist::truncate();
        //Playlist_Video::truncate();

        $video = new Video();
        $user = User::where('name', 'Mihails Tumasevics')->first();
        $video->Users()->associate($user);
        $video->name = 'Waves';
        $video->type = '1';
        $video->category = 'Nature';
        $video->desc = 'Beautiful waves during the sunset.';
        $video->am_of_likes = '1';
        $video->ltd_ratio = '0.5';
        $video->save();
        $video = new Video();
        $user = User::where('name', 'Mihails Tumasevics')->first();
        $video->Users()->associate($user);
        $video->name = 'Waves2';
        $video->type = '1';
        $video->category = 'Nature';
        $video->desc = 'Beautiful waves during the sunset.';
        $video->am_of_likes = '3';
        $video->ltd_ratio = '0.4';
        $video->save();
        $video = new Video();
        $user = User::where('name', 'Mihails Tumasevics')->first();
        $video->Users()->associate($user);
        $video->name = 'Waves3';
        $video->type = '1';
        $video->category = 'Nature';
        $video->desc = 'Beautiful waves during the sunset.';
        $video->am_of_likes = '10';
        $video->ltd_ratio = '1';

        $video->save();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
