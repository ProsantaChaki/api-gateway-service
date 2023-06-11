<?php

namespace App\Services;


class FileUploadService extends BaseService
{
    public function imageUpload(Request $request){

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('images'), $imageName);

    }

}
