<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SaleRecordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $page=8;
    protected $common;
    public function __construct(Request $request){
        $this->common=new CommonController();
        $this->dbConnectionName = setDb(session('passKey'));
    }

    public function saleRecordDayTotal()
    {   
        try {
            $results = DB::connection($this->dbConnectionName)
                ->table(DB::raw('PG_SALES'))
                ->select(DB::raw('TRUNCATE(SUM(total), 2) AS total_sum, COUNT(DISTINCT invoice_no) AS distinct_invoices'))
                ->whereRaw('DATE(transactiontime) = CURDATE()')
                ->get();

            // Check if results are found
            if ($results->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No data found for today date',
                    'data' => []
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Day total fetched successfully',
                'data' => $results
            ]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => $th->getMessage()], 500);
        }
        
        
    }
    
}
