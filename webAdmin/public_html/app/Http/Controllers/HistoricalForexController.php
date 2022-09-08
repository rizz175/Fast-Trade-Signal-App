<?php

namespace App\Http\Controllers;

use App\Models\Forex;
use Illuminate\Http\Request;

class HistoricalForexController extends Controller
{
    public function TrashedForexSignalsIndex(){
        return view('historicalForex.index');
    } 
    
    public function updateHistoricalForexSignal(Request $request, $id){
          $forex = Forex::withTrashed()->find($id);
          $forex->update([
              'symbol' => $request->symbol,
              'type' => $request->type,
              'tp' => $request->tp,
              'sl' => $request->sl,
              'profit' => $request->profit
          ]);
          toastr()->success("Historical Forex Signal updated successfully");
          return redirect()->back();
    }
    public function deleteForexSignal($id){
        // dd("here");
        Forex::onlyTrashed()->find($id)->forceDelete();
        toastr()->success("historical forex signal deleted successfully");
        return redirect()->back();
       
    }
}
