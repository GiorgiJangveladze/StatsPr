<?php
namespace App\Repositories;
use App\Models\Product;
use App\Models\Client;
use App\Events\File;

class FileUploadRepository extends BaseRepository
{
    // private $university;
    // private $destinition_path =  'dashboard/uploads/lectors/';

    // public function __construct(Lector $model,University $university) {
    //     parent::__construct($model);
    //     $this->university = $university;
    // }
    
    // public function index() { 
    //   $lectors = $this->model->With('university')->get();
    //   return view('admin.modules.lectors.index',compact('lectors'));
    // } 

    // public function createLector() { 
    //   $universities = $this->university->get();
    //   return view('admin.modules.lectors.add',compact('universities'));
    // } 

    //  public function editLector($id) { 
    //   $universities = $this->university->get();
    //   $lector = $this->model->find($id)->with('university')->first();
    //   return view('admin.modules.lectors.edit',compact('lector','universities'));
    // } 
  
    // public function storeLector(array $attributes) {
    //     $attributes['image'] = event(new File($attributes['image'],$this->destinition_path))[0];
    //     return $this->create($attributes);
    // }
    
    // public function updateLector($attributes) {
    //   if(isset($attributes['image'])) {
    //     $this->fileDelete($this->currentModel->image);
    //     $attributes['image'] = event(new File($attributes['image'],$this->destinition_path))[0];
    //   }
    //   return $this->currentModel->update($attributes);
    // }

    // public function deleteLector($attributes) {
    //   $response = [
    //     'status' => true,
    //     'msg' => 'Lector Deleted',
    //   ];
    //   try{
    //     $this->fileDelete($this->currentModel->image);
    //     $this->currentModel->delete();
    //     return $response;
    //   } catch (\Throwable $e) {
    //     return $response = [
    //       'status' => false,
    //       'msg' => 'Something whent wrong',
    //     ];
    //   }
    // }
}