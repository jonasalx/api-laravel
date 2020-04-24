<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\Models\Track;


class JobQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $trackerPublicID;
    private $url;

    public function __construct($tracker_public_id, Request $request)
    {
        $this->trackerPublicID = $tracker_public_id;
        $this->url = $request->get('url');
    }

    public function handle()
    {
        return "ok";
        $job = new Track;
        if( !$this->request->submitter ) return response()->json([
                                                        'error' => 'Bad request.'
                                                    ], 400);
        $job->submitter_id = $this->request->submitter;
        $job->command = "CREATE";
        $job->save(); 
        return $job->id;
    }
}
