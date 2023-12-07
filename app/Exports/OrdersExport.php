<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class OrdersExport implements FromArray, WithHeadings
{
    private $data;
    private $headings;

    public function __construct(array $data, array $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $data = $this->data;

        foreach ($data as &$item) {
            if (isset($item['Image'])) {
                // Get the image file name from the URL
                $imageName = basename($item['Image']);

                // Store the image in the public storage directory
                $imagePath = Storage::disk('public')->putFileAs('images/products', $item['Image'], $imageName);

                // Get the public URL of the stored image
                $item['Image'] = Storage::url($imagePath);
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->headings;
    }
}
