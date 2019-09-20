<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ParsePlaylist implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $xml;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->xml = 'playlist/playlist.xml';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        DB::table('musics')->truncate();
        $xml=Storage::get($this->xml);
        $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
        foreach($xml->children() as $song) {
            $fileInfo = pathinfo($song['FilePath']);
            $file_name_array = explode('-',$fileInfo['filename']);
            $name = array_splice($file_name_array,count($file_name_array)-1)[0];
            $author=implode(' ',$file_name_array);
            $language = $fileInfo['dirname'];
            $firstSeen =  $song->Infos['FirstSeen'] ? Carbon::createFromTimestamp($song->Infos['FirstSeen']) : null;
            $playCount =  $song->Infos['PlayCount'] ? $song->Infos['PlayCount'] : 0;
            $language  = explode('\\',$language);
            $language = count($language) > 2 ? $language[2]  : 'N/A';
            
            // Save to the database;
            Music::create([
                'name' =>$name,
                'artist' => $author,
                'play_count' => $playCount,
                'language' => $language,
                'first_seen' => $firstSeen,
                
            ]);
            
            // echo $language."* ".$firstSeen."* ".$firstPlay. "* ".$lastPlay."* ".$playCount. 'Name: '.$name.'Author : '.$author. "<br />";
            
        }
    }
}
