<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Information;
use App\Models\User;
use App\Http\Resources\Users as UserResource;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

        // $headers = apache_request_headers();
        // if (!$headers['Pass-Key']) {
        //     abort(400, 'Pass-Key is required');
        // }
        // $this->dbConnectionName = setDb($headers['Pass-Key']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function testold(){
        $result = Information::count();
        return response()->json($result, 200);
    }

    function test(){

        // $spirits_db_conn = mysqli_connect('18.118.204.10', "alltechp_ridge", "Alltech89!", "alltechp_ridge", 3306);
        // if (!$spirits_db_conn) {
        //     die('Failed to connect to MySQL: ' . mysqli_connect_error());
        // }
        // echo "<pre>"; print_r($spirits_db_conn); die();


        $results = DB::connection(setDb())
                ->table(DB::raw('PG_SALES'))
                ->select(DB::raw('TRUNCATE(SUM(total), 2) AS total_sum, COUNT(DISTINCT invoice_no) AS distinct_invoices'))
                ->whereRaw('DATE(transactiontime) = CURDATE()')
                ->get();
        echo "<pre>"; print_r($results); die();
    }
    
    public function getStoreById($id)
    {
       
        try {
            $store = User::where('storenumber',$id)->first();
            if ($store) {
                $result = array(
                    'success' => true,
                    'message' => 'User details fetched successfully',
                    'data' => new UserResource($store)
                );
                return response()->json($result, 200);
            } else {
                return response()->json([ 'success' => false,'message' => 'Store not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false,'message' => $th->getMessage()], 500);
        }
    }
    
}
