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
                $imgexcl = $row[13];
                $imagearray = explode(',', $imgexcl);
                foreach($imagearray as $key => $value){
                    $primg[$key] = '/images/products/'.$value;
                }
                $images = json_encode($primg);

                $isFeatured =  $row[4];
                if($isFeatured=='yes'){
                    $featured='on';
                }else{
                    $featured='null';
                }

                $white_label = $row[5];
                if($white_label=='yes'){
                    $white_label='on';
                }else{
                    $white_label='null';
                }
                
                $parent_category =  $row[7];

                Product::create([
                    'title' => $row[1],
                    'sku' => $row[2],
                    'short_description' => $row[3],
                    'is_featured' => $featured,
                    'white_label' => $white_label,
                    'brand' => $row[6],
                    'parent_category' => $parent_category,
                    'category' => $row[8],
                    'price' => $row[9],
                    'sale_price' => $row[10],
                    'description' => $row[11],
                    'vendor_id' => $row[12],
                    'images' => $images,
                    'slug' => $row[14],
                    'status' => $row[15],
                ]);
            }
            $count++;
        }
    }
}
