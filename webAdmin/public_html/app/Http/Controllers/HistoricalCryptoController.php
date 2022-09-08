<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use Illuminate\Http\Request;

class HistoricalCryptoController extends Controller
{
    // TrashedCryptoSignalsIndex

    public function TrashedCryptoSignalsIndex()
    {
        return view('historicalCrypto.index');
    }
    // deleteCryptoSignal
    public function updateHistoricalCryptoSignal(Request $request, $id)
    {
        $crypto = Crypto::withTrashed()->find($id);
        $crypto->update([
            'symbol' => $request->symbol,
            'type' => $request->type,
            'tp' => $request->tp,
            'sl' => $request->sl,
            'lot' => $request->lot,
            'profit' => $request->profit
        ]);
        toastr()->success("Historical Crypto Signal updated successfully");
        return redirect()->back();
    }
    public function deleteCryptoSignal($id)
    {
        // dd("here");
        Crypto::onlyTrashed()->find($id)->forceDelete();
        toastr()->success("historical Crypto signal deleted successfully");
        return redirect()->back();
    }
}
