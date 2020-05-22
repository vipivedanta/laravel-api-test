<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Str;
use Exception;
use App\Traits\Response;
use App\Models\Product;
use Auth;
use App\Http\Requests\Products\UploadRequest;

class FileController extends Controller
{
    
    use Response;

    public function receiveFile(UploadRequest $request) 
    {
    	try{

            if($request->has('file')) {

    		$file = $request->file('file');

    		$ext = $file->getClientOriginalExtension();

    		$newFile = Str::uuid(4,'').'.'.$ext;
    		$file->move('uploads',$newFile);

            $products = $this->readCSV(public_path('uploads/'.$newFile));

            if(sizeof($products) <= 2) {
                throw new Exception("Uploaded CSV file is empty", 1);                
            }

            //get rid of the header part
            unset($products[0]);

            $user = Auth::user();


            foreach($products as $product) {

                if(is_array($product)) {
                    $newProduct = new Product;
                    $newProduct->name = $product[0];
                    $newProduct->price = $product[1];
                    $newProduct->ski = $product[2];
                    $newProduct->description = $product[3];
                    $user->product()->save($newProduct);
                }                
            }

            return $this->successResponse('Products have been imported successfully',[]);

    	}

    	}catch(Exception $e) {
    		return $this->errorResponse($e);
    	}
    }

    public function readCSV($csvFile,$delimiter=',')
    {
        $file_handle = fopen($csvFile, 'r');
        $data = [];

        while (!feof($file_handle)) {
            $data[] = fgetcsv($file_handle, 0, $delimiter);
        }
        fclose($file_handle);
        return $data;
    }

    public function listProducts()
    {
        try{

            $products = Auth::user()->product;
            return $this->successResponse('List of products',$products);

        }catch(Exception $e){
            return $this->errorResponse($e);
        }
    }
}
