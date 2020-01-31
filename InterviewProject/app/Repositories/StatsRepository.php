<?php
namespace App\Repositories;
use App\Models\Client;
use App\Models\Product;

class StatsRepository extends BaseRepository
{
    private $clien;
    private $types = [
            "client",
            "product",
            "total",
            "date"
    ];
    
    public function __construct(Product $model, Client $client) {
        parent::__construct($model);
        $this->client = $client;
    }
    
    public function index($attr) {
        $types = $this->types;
        // try {

            $products = $this->returnProducts($attr);

        // } catch (\Throwable $e) {
        //      return back()->with('error',"Something went's wrong!");
        // }
        
        return view('stats',compact('products','types', 'attr'));
    }

    private function returnProducts($attr) {

        $sort = isset($attr['sortedBy']) ? $this->types[$attr['sortedBy']] : 'date';
        $result = $this->model->join('clients', 'client_id', '=', 'clients.id')->select('products.id' ,'product', 'total', 'date' , 'clients.name AS client');
     
       if(isset($attr['keyword']) && $attr['keyword']) {
            $searchBy = empty($attr['type']) ? ['product', 'total', 'client.name', 'date'] : array($this->generateDateForSearch($attr));
            $result = $result->whereLike($searchBy, $attr['keyword'])->orderBy($sort)->paginate(2);
        }else {
            $result = $result->orderBy($sort)->paginate(2);
        }

        return $result;
    }

    private function generateDateForSearch($attr) {
        return $attr['type'] === "client" ? 'client.name' : $attr['type'];
    }

    public function editProducts($id) {
      $product = $this->model->where('id', $id)->with('client')->first();
      $clients = $this->client->get();
      return view('modules.products.edit',compact('product', 'clients'));
    } 
  
    // public function storeCategory(array $attributes) {
    //    $attributes['intro'] = event(new File($attributes['intro'],$this->destinition_path))[0];
    //     return $this->create($attributes);
    // }
    
    // public function updateCategory($attributes) {
    //     if(isset($attributes['intro'])) {
    //       $this->fileDelete($this->currentModel->intro);
    //     $attributes['intro'] = event(new File($attributes['intro'],$this->destinition_path))[0];
    //   }
    //   return $this->currentModel->update($attributes);
    // }

    public function deleteProduct($attributes) {
      $response = [
        'status' => true,
        'msg' => 'Product Deleted',
      ];

      try{
        $this->currentModel->delete();
        return $response;
      } catch (\Throwable $e) {
        return $response = [
          'status' => false,
          'msg' => 'Something whent wrong',
        ];
      }
    }
}