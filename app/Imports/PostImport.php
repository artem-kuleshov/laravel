<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Post::firstOrCreate([
            'title' => $row[0]
        ], [
            'title' => $row[0],
            'content' => $row[1],
            'category_id' => 4
        ]);
    }
}
