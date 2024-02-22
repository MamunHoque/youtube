<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class DownloadController extends Controller
{
   public function download(Request $request)
   {
       $url = $request->url;
       if(empty($url)) {
           return response()->json([
               'error' => 'The requested URL is required'
           ]);
       }
       $yt = new YoutubeDl();
       $collection = $yt->download(
           Options::create()
               ->downloadPath('/home/mamun/www/youtube/storage/download')
               ->yesPlaylist()
               ->url($url)
       );

       foreach ($collection->getVideos() as $video) {
           if ($video->getError() !== null) {
               echo "Error downloading video: {$video->getError()}.";
           } else {
              echo $video->getTitle();
           }
       }
       return false;
   }
}
