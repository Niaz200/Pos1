<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name'=>$row[0],
            'cat_id'=>$row[1],
            'sup_id'=>$row[2],
            'product_code'=>$row[3],
            'product_garage'=>$row[4],
            'product_route'=>$row[5],
            'product_image'=>$row[6],
            'product_des'=>$row[7],
            'buy_date'=>$row[8],
            'expire_date'=>$row[9],
            'buying_price'=>$row[10],
            'selling_price'=>$row[11],

        ]);
    }
}
