<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements WithHeadings,FromCollection
{
    private $postInfo;
    public function __construct($postInfo)
    {
        $this->postInfo = $postInfo;
    }

    public function headings(): array
    {
        return ["Post Title", "Post Description", "Post User", "Post Date"];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->postInfo;
        return collect($data);
    }
}
