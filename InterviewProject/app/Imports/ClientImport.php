<?php 
namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientImport implements ToCollection, WithStartRow
{
	 public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        	Client::updateOrCreate(
			    [
			    	'name' => $row[1]
			    ],
			    []
			);
        }
    }
}