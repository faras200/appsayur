<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class UploadImageController extends Controller
{
    public function store(Request $request)
    {
        // $task = new Task();
        // $task->id = 0;
        // $task->exists = true;
        // $image = $task->addMediaFromRequest('upload')->toMediaCollaction('post-images');
        return response()->json([
            'url' => 'http://127.0.0.1:8000/storage/post-images/3FjzQI4f8VnTsI981Yna5vL8arOxan8GYuqTtgZX.png' //$image->getUrl()
        ]);
    }
}
