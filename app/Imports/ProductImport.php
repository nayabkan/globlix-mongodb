<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class ProductImport implements ToCollection
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count=1;
        foreach ($rows as $row) 
        {
            if($count != 1){
                $imgexcl = $row[12];
                $imagearray = explode(',', $imgexcl);
                foreach($imagearray as $key => $value){
                    $primg[$key] = '/images/products/'.$value;
                }
                $images = json_encode($primg);
                Product::create([
                    'title' => $row[1],
                    'sku' => $row[2],
                    'short_description' => $row[3],
                    'is_featured' => $row[4],
                    'white_label' => $row[5],
                    'brand' => $row[6],
                    'category' => $row[7],
                    'price' => $row[8],
                    'sale_price' => $row[9],
                    'description' => $row[10],
                    'vendor_id' => $row[11],
                    'images' => $images,
                    'slug' => $row[13],
                    'status' => $row[14],
                ]);
            }
            $count++;
        }
    }
}
