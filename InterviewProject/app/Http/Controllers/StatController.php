<?php

namespace App\Http\Controllers;

use App\Traits\SafeResponse;
use Illuminate\Http\Request;
use App\Repositories\StatsRepository;
use App\Http\Requests\UpdateRequest;

class StatController extends Controller
{
    use SafeResponse;

    private $repository;

    public function __construct(StatsRepository $repository) {
        $this->repository = $repository;
    }

    public function index(Request $request) {
        try{

            list($products, $types, $attr, $chart) = $this->repository->index($request->except('_token'));
            return view('stats',compact('products','types', 'attr', 'chart'));

        } catch (\Throwable $e) {
             return redirect()->route('home')->with('error',"Something went's wrong!");
        }
    }

   	public function edit($id) {
        list($product, $clients) =  $this->repository->setModel($id)->editProducts();
        return view('modules.products.edit',compact('product', 'clients'));
    }

    public function update(UpdateRequest $request, $id) {
        $messages = [
            'success' => "Oder Updated",
            'error' => "Can't update Order"
        ];

        list($responseType, $responseText) = $this->safeResponse(function() use ($request, $id) {
            $this->repository->setModel($id)->updateProduct($request->except('_token'));
        }, $messages);
        return  back()->with($responseType, $responseText);
    }

    public function delete(Request $request) {
    	if($request->ajax()) {
    		return $this->repository->setModel($request->id)->deleteProduct($request->all());
        }
    }

    public function send(Request $request)
    {
        $messages = [
            'success' => "Report successfuly sended",
            'error' => "Something Went's Wrong"
        ];

        list($responseType, $responseText) = $this->safeResponse(function() use ($request) {
            $this->repository->sendReport($request->except('_token'));
        }, $messages);

        return  back()->with($responseType, $responseText);
    }
}
