<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FileUploadRepository;
use App\Http\Requests\UploadRequest;

class FileUploadController extends Controller
{
    private $repository;
    public function __construct(FileUploadRepository $repository) {
        $this->repository = $repository; 
    }

    public function index() {   
    	return $this->repository->index();
    }

    public function store(UploadRequest $request) {
        try {
            $this->repository->uploadFile($request);
        } catch (\Throwable $e) {
             return back()->with('error',"Can't upload File ");
        }

        return back()->with('success','File uploaded');
    }
}
