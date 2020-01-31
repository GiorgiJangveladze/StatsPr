<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatsRepository;
use App\Http\Requests\UpdateRequest;

class StatController extends Controller
{
    private $repository;
    public function __construct(StatsRepository $repository) {
        $this->repository = $repository; 
    }

    public function index(Request $request) {   
    	return $this->repository->index($request->except('_token'));
    }
   	
   	public function edit($id) {   
        return $this->repository->setModel($id)->editProducts();
    }

    public function update(UpdateRequest $request, $id) {
        
        try {
            $this->repository->setModel($id)->updateProduct($request->except('_token'));
        } catch (\Throwable $e) {
             return back()->with('error',"Can't update Order ");
        }

        return back()->with('success','Oder Updated');
    }

    public function delete(Request $request) {
    	if($request->ajax()) {
    		return $this->repository->setModel($request->id)->deleteProduct($request->all());
        }
    }

    public function send(Request $request)
    {
        // try {
             $this->repository->sendReport($request->except('_token'));
        // } catch (\Throwable $e) {
        //      return back()->with('error',"Something Went's Wrong");
        // }

        return back()->with('success','Report Sended');


    }
}
