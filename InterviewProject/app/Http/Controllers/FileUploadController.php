<?php

namespace App\Http\Controllers;
use App\Traits\SafeResponse;
use http\Exception;
use Illuminate\Http\Request;
use App\Repositories\FileUploadRepository;
use App\Http\Requests\UploadRequest;

class FileUploadController extends Controller
{
    use SafeResponse;

    private $repository;
    public function __construct(FileUploadRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return view('upload');
    }

    public function store(UploadRequest $request) {
        $messages = [
            'success' => "File uploaded",
            'error' => "Can't upload File"
        ];

        list($responseType, $responseText) = $this->safeResponse(function() use ($request) {
            $this->repository->uploadFile($request);
        }, $messages);
        return  back()->with($responseType, $responseText);
    }
}
