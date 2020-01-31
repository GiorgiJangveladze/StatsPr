<?php 
namespace App\Imports;

use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToCollection, WithStartRow
{
	 public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        	$formatedDate = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]));
         	$client = Client::where('name','=',$row[0])->first();
        	Product::updateOrCreate(
			    [
			    	'client_id' => $client->id,
			    	'product' => $row[1],
			    	'date' => $formatedDate,
			    ],
			    [
			    	'total' => $row[2],
			    ]
			);
        }
    }
}