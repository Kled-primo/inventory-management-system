<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Str;

class ProductImportController extends Controller
{
    public function create()
    {
        return view('products.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $row_range    = range(2, $row_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'name'          => $sheet->getCell('A' . $row)->getValue(),
                    'slug'          => $sheet->getCell('B' . $row)->getValue(),
                    'category_id'   => $sheet->getCell('C' . $row)->getValue(),
                    'unit_id'       => $sheet->getCell('D' . $row)->getValue(),
                    'producttype'       => $sheet->getCell('E' . $row)->getValue(),
                    'code'          => $sheet->getCell('F' . $row)->getValue(),
                    'quantity'      => $sheet->getCell('G' . $row)->getValue(),
                    "quantity_alert" => $sheet->getCell('H' . $row)->getValue(),
                    'unit_number'  => $sheet->getCell('I' . $row)->getValue(),
                    'selling_price' => $sheet->getCell('J' . $row)->getValue(),
                    'user_id'      => $sheet->getCell('K' . $row)->getValue(),
                    'notes' => $sheet->getCell('L' . $row)->getValue(),

                ];
                $startcount++;
            }

            foreach ($data as $product) {

                Product::firstOrCreate([
                    "slug" => $product["slug"],
                    "code" => $product["code"],
                    "user_id" => $product["user_id"],
                ], $product);
            }
        } catch (Exception $e) {
            throw $e;
            // $error_code = $e->errorInfo[1];
            return redirect()
                ->route('products.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }
}
