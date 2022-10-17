<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use URL;
use File;

class PostmanController extends Controller
{
    public function index()
    {
        $filePath = base_path() . "/postman/API_PIMMM.postman_collection.json";
        $content = File::get($filePath);
        return response($content);//->download($filePath, $fileName, $headers);
    }
}