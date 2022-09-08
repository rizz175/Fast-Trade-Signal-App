<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Crypto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CryptoController extends Controller
{

    ///////////  api method for creating forex signal /////////

    public function createCryptoSignal(Request $request)
    {
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

            $crypto = Crypto::create($data);

            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'message', $crypto);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    ///////////  api method for get all forex signal /////////

    public function getAllCryptoSignal(Request $request)
    {
        Log::debug($request->all());
        try {
            DB::beginTransaction();
            $crypto = Crypto::all();
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'message', $crypto);
        } catch (\Exception $e) {

            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
    ///////////  api method for update all forex signal /////////

    public function updateCryptoSignal(Request $request, $id)
    {
        Log::debug($id);
        try {
            DB::beginTransaction();
            $crypto = Crypto::find($id);
            $crypto->update($request->all());
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $crypto);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    ///////////  api method for get specific crypto signal /////////

    public function getCryptoSignal($id)
    {
        Log::debug($id);
        try {
            DB::beginTransaction();
            $crypto = Crypto::find($id);
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $crypto);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    ///////////  api method to delete crypto signal /////////

    public function deleteCryptoSignal($id)
    {
        Log::debug($id);
        try {
            DB::beginTransaction();
            $crypto = Crypto::find($id);
            $crypto->delete();
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'message', "deleted successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
    public function getHistoricalCrypto(){
        // dd("here");
        $crypto = Crypto::onlyTrashed()->get();
        return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $crypto);
    }
}
