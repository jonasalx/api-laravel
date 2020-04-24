<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

//use App\Jobs\JobQueue;  

class JobController extends Controller
{

    public function take( $processor ){
        if( !$this->isEnabled($processor) )
            return json_encode( ["code"=>204, "result"=>"work already assigned"] );

        $job = Job::where('state',0)->whereNull('processor_id')->orderBy('id', 'asc')->first();
        $job->processor_id = $processor;
        $job->command = "TAKE";
        $job->update();
        return json_encode( ["code"=>200, "result"=>$job->id] ); 
    }

    public function close( $id ){
        $job = Job::findOrFail($id); //Job::where('id', $id)->first();
        return $job;
        $job->command = "CLOSE";
        $job->state = true;
        $job->update();
        return json_encode( ["code"=>200, "result"=>$job->id] ); 
    }

    public function show($id){
        return Job::select('id','processor_id','submitter_id','command','state')->where('id', $id)->get();
    }

    public function create(Request $request){
 
        //JobQueue::dispatch(1,$request);

        $job = new Job;
        if( !$request->submitter ) return response()->json([
                                                        'error' => 'Bad request.'
                                                    ], 400);
        $job->submitter_id = $request->submitter;
        $job->command = "CREATE";
        $job->save(); 
        return $job->id;
        
    }

    public function index()
    {
        return Job::all();
    }

    private function isEnabled( $processor ){
        $filter = ['state' => 0, 'processor_id' => $processor];
        return Job::where( $filter )->first() ? false:true;
    }
  
}
