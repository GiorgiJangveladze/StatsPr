<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatsRepository;

class StatController extends Controller
{
    private $repository;

    public function __construct(StatsRepository $repository) {
        $this->repository = $repository; 
    }

    public function index(Request $request) {   
    	return $this->repository->index($request->except('_token'));
    }
   	
   	// public function create() {   
   	// 	return view('admin.modules.categories.add');
    // }
   	
   	public function edit($id) {   
        return $this->repository->editProducts($id);
    }
   	

    // public function store(StoreRequest $request) {
    // 	try {
    //         $this->repository->storeCategory($request->except('_token'));
    //     } catch (\Throwable $e) {
    //          return back()->with('error',"Can't create Category ");
    //     }

    //     return back()->with('success','Category Created');
    // }

    public function update(UpdateRequest $request, $id) {
        // try {
        //     $this->repository->setModel($id)->updateCategory($request->except('_token'));
        // } catch (\Throwable $e) {
        //      return back()->with('error',"Can't update Category ");
        // }

        return back()->with('success','Oder Updated');
    }

    public function delete(Request $request) {
    	if($request->ajax()) {
    		return $this->repository->setModel($request->id)->deleteProduct($request->all());
        }
    }
}
