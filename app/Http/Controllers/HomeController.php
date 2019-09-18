<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nathanmac\Utilities\Parser\Facades\Parser;
// use Laravie\Parser\Xml\Reader;
// use Laravie\Parser\Xml\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $musics = Music::all();
        
        return view('home', compact('musics'));
    }

    public function showPlaylistView(){
        return view('upload_playlist');
    }

    public function uploadPlaylist(Request $request){

        if(!request()->has('file') || !request()->file('file')->isValid('file')){
            return back()->with('error','Please Select an file to upload');
        }else{
            $extensions = array("xml");
            
            $result = array(request()->file('file')->getClientOriginalExtension());
            
            if(in_array($result[0],$extensions)){
                // Save the file to a path
                // upon saving the file parse the file content
                // upload to a database


                $path = $request->file('file')->storeAs(
                    'playlist', 'playlist.xml'
                );
                // $this->parseXML($path);
                
                // once done delete the file from the database
                // Storage::delete('playlist.xml');
                return redirect()->back()->with('success','Playlist Uploaded. Processing Playlist...');
                // Excel::import(new BaseDataImport,request()->file('file'));    
                // return back()->with('success','Data Imported Successfully');
                // Do something when Succeeded 

            }else{
                // Do something when it fails
                return back()->with('error','Only XML files can be uploaded');
            }
        }
    }

    public function parseXML($xml='playlist/playlist.xml'){
        DB::table('musics')->truncate();
        $xml=Storage::get($xml);
        $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
        foreach($xml->children() as $song) {
            $fileInfo = pathinfo($song['FilePath']);
            $file_name_array = explode('-',$fileInfo['filename']);
            $name = array_splice($file_name_array,count($file_name_array)-1)[0];
            $author=implode(' ',$file_name_array);
            $language = $fileInfo['dirname'];
            $firstSeen =  $song->Infos['FirstSeen'] ? Carbon::createFromTimestamp($song->Infos['FirstSeen']) : null;
            $firstPlay =  $song->Infos['FirstPlay'] ? Carbon::createFromTimestamp($song->Infos['FirstPlay']) : null;
            $lastPlay =  $song->Infos['LastPlay'] ? Carbon::createFromTimestamp($song->Infos['LastPlay']) : null;
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
                'first_play' => $firstPlay,
                'last_play' => $lastPlay
            ]);
            
            // echo $language."* ".$firstSeen."* ".$firstPlay. "* ".$lastPlay."* ".$playCount. 'Name: '.$name.'Author : '.$author. "<br />";
            
        }
        echo 'All done';
        // Parser::payload();
        // Parser::xml($xml);
        // $val=Parser::all();
        // dd($val);
        // $xml = $xml = XmlParser::load($xml);
        // dd($xml);
        // $user = $xml->parse([
        //     'fileName' => ['uses' => 'Song::FilePath'],
        //     'added' => ['uses' => 'Song.Infos::FirstSeen'],
        //     'lastPlayed' => ['uses' => 'Song.Infos::LastPlay'],
        //     'playCount' => ['uses' => 'Song.Infos::PlayCount'],
        //     'firstPlayed' => ['uses' => 'Song.Infos::FirstPlay'],
        // ]);

        // $data=\Parser::xml($xml);
        // dd($user);
        // $xml = (new Reader(new Document()))->load($xml);
        // dd($xml);
        // $data = $xml->parse([
        //     'fileName' => ['uses' => 'Song::FilePath'],
        //     'added' => ['uses' => 'Song.Infos::FirstSeen'],
        //     'lastPlayed' => ['uses' => 'Song.Infos::LastPlay'],
        //     'playCount' => ['uses' => 'Song.Infos::PlayCount'],
        //     'firstPlayed' => ['uses' => 'Song.Infos::FirstPlay'],
        // ]);
        // return $data;

    }
}
