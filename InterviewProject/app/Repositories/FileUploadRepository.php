<?php
namespace App\Repositories;
use App\Models\Product;
use App\Models\Client;
use App\Events\File;
use App\Imports\ClientImport;
use App\Imports\ProductImport;
use Excel;

class FileUploadRepository extends BaseRepository
{
    private $client;
    private $productImport;
    private $clientImport;
    private $destinition_path =  'dashboard/uploads/lectors/';

    public function __construct(Product $model, Client $client, ClientImport $clientImport, ProductImport $productImport) {
        parent::__construct($model);
        $this->client = $client;
        $this->clientImport = $clientImport;
        $this->productImport = $productImport;
    }
    
    public function index() { 
      return view('upload');
    } 

    public function uploadFile($request) {
        $path = $request->file('file')->getRealPath();
        $importer = $request->type == "clients" ? $this->clientImport : $this->productImport;
        return Excel::import($importer, $path); 
    }
}