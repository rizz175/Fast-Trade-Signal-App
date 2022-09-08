<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Forex;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ForexController extends Controller
{

    ///////////  api method for creating forex signal /////////
    public function createForexSignal(Request $request){
            
            Log::debug($request->all());
            $rules = [
                'symbol' => 'required',
                'type' => 'required',
                'tp' => 'required',
                'sl' => 'required',
                'lot' => 'required',    
            ];
            $validator = Validator::make(request()->all(), $rules);
            if ($validator->fails()) {
                return $this->apiResponse(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, 'message', $validator->errors());
            }
            try {
                DB::beginTransaction();
                $data = [
                    'symbol' => $request->symbol,
                    'type' => $request->type,
                    'tp' => $request->tp,
                    'sl' => $request->sl,
                    'lot' => $request->lot,
                ];
                
                Forex::create($data);
                
                DB::commit();
                return $this->apiResponse(JsonResponse::HTTP_OK, 'message',"forex signal successfully created");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::debug($e->getMessage());
                return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
            }
        
    }

    public function getAllForexSignal()
    {
        $forex = Forex::all();
        return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $forex);
    }

    public function updateForexSignal(Request $request,$id)
    {

        Log::debug($id);
        try {
            DB::beginTransaction();
            $forex=Forex::find($id);
            $forex->update($request->all());
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'data',$forex);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    public function getForexSignal($id)
    {
        Log::debug($id);
        try {
            DB::beginTransaction();
            $forex=Forex::find($id);  
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'data',$forex);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
     public function deleteForexSignal($id)
    {
        Log::debug($id);
        try {
            DB::beginTransaction();
            $forex=Forex::find($id)->delete();  
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'data',$forex);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    public function getHistoricalForex(){
        // dd("here");
        $forex = Forex::onlyTrashed()->get();
        return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $forex);
    }



}
