<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Carbon\Carbon;
use App\Models\OT_list;
use App\Models\temp_chart;



class Otdashboard extends Component
{

    public $chartyear;
    public $tmp;
    

    public function render()
    {

        if (Auth::user()->user_level > 8){
            $record = DB::table('ot_list_status')
                    ->select('ot_list.month')                
                    ->selectRaw("sum(`director_admin_rec_ot_hour`) as totOT")
                    ->join("ot_list","ot_list_status.list_id","=","ot_list.id")
                    ->join("institute","ot_list.institute_id","=","institute.id")
                    ->Join("ot_records", function($join){
                        $join->on("ot_list_status.list_id", "=", "ot_records.list_id")
                        ->on('ot_list_status.ot_range', "=", "ot_records.ot_range");
                    })
                    ->where ('ot_list.year',"=",now()->year)
                    ->where('completed','=','1')
                    ->where(function($c) {
                        $c->where('institute_id', '=', Auth::user()->institute )
                        ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                    }) 
                    ->groupBy('ot_list.month')
                    ->get();
        }elseif (Auth::user()->user_level > 5){
                $record = DB::table('ot_list_status')
                ->select('ot_list.month')                
                ->selectRaw("sum(`director_admin_rec_ot_hour`) as totOT")
                ->join("ot_list","ot_list_status.list_id","=","ot_list.id")
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->Join("ot_records", function($join){
                    $join->on("ot_list_status.list_id", "=", "ot_records.list_id")
                    ->on('ot_list_status.ot_range', "=", "ot_records.ot_range");
                })
                ->where ('ot_list.year',"=",now()->year)
                ->where('completed','=','1')
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                }) 
                ->groupBy('ot_list.month')
                ->get();
        }else{
                $record = DB::table('ot_list_status')
                ->select('ot_list.month')                
                ->selectRaw("sum(`director_admin_rec_ot_hour`) as totOT")
                ->join("ot_list","ot_list_status.list_id","=","ot_list.id")
                ->Join("ot_records", function($join){
                    $join->on("ot_list_status.list_id", "=", "ot_records.list_id")
                    ->on('ot_list_status.ot_range', "=", "ot_records.ot_range");
                })

                ->where ('ot_list.year',"=",now()->year)
                ->where('completed','=','1')
                //->where('institute_id', '=', Auth::user()->institute )
                ->groupBy('ot_list.month')
                ->get();

        }
  
        

        $this->tmp=temp_chart::findOrFail(1);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(2);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(3);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(4);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(5);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(6);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(7);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(8);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(9);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(10);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(11);
        $this->tmp->update(['value'=>0]);

        $this->tmp=temp_chart::findOrFail(12);
        $this->tmp->update(['value'=>0]);


        foreach($record as $row) {
            
            if ($row->month=='January'){
                $this->tmp=temp_chart::findOrFail(1);
                $this->tmp->update(['value'=>$row->totOT,]);                
            }elseif ($row->month=='February'){
                $this->tmp=temp_chart::findOrFail(2);
                $this->tmp->update([ 'value'=>$row->totOT,]);
            }elseif ($row->month=='March'){
                $this->tmp=temp_chart::findOrFail(3);
                $this->tmp->update([ 'value'=>$row->totOT,]);
            }elseif ($row->month=='April'){
                $this->tmp=temp_chart::findOrFail(4);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='May'){
                $this->tmp=temp_chart::findOrFail(5);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='June'){
                $this->tmp=temp_chart::findOrFail(6);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='July'){
                $this->tmp=temp_chart::findOrFail(7);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='August'){
                $this->tmp=temp_chart::findOrFail(8);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='September'){
                $this->tmp=temp_chart::findOrFail(9);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='October'){
                $this->tmp=temp_chart::findOrFail(10);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='November'){
                $this->tmp=temp_chart::findOrFail(11);
                $this->tmp->update(['value'=>$row->totOT,]);
            }elseif ($row->month=='December'){
                $this->tmp=temp_chart::findOrFail(12);
                $this->tmp->update(['value'=>$row->totOT,]);
            }
        }
        
        $data = [];
        $record1 = DB::table('temp_chart')->orderby('id')->get();
        foreach($record1 as $row) {

            $data['label'][] = $row->month;
            $data['data'][] = (int) $row->value;
        }
        //temp_chart::truncate();//delete temp table

 
        $data['chart_data'] = json_encode($data);
        
        return view('livewire.otdashboard',$data, 
        [ 

            'totalOTHour'=>DB::table('temp_chart') ->select( DB::raw('SUM(value) as total_value'))->get(),



            //************************************************************************ */
            'incomplete'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->where('completed', '=', '0' )
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get(),

            'incompleteall'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('completed', '=', '0' )
            ->get(),
            //************************************************************************ */



            //************************************************************************ */
            'complete'=>DB::table("ot_list")
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->where('completed', '=', '1' )            
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get(),

            'completeall'=>DB::table("ot_list")
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('completed', '=', '1' )            
            ->get(),
            //************************************************************************ */





            //************************************************************************ */

            'level11_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L11', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            ->where('institute_id', '=', Auth::user()->institute )->get(),

            'level10_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L10', '=', '0' )
            ->where('L11', '=', '1' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            ->where('institute_id', '=', Auth::user()->institute )->get(),

            'level9_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L9', '=', '0' )
            ->where('L10', '=', '1' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            ->where('institute_id', '=', Auth::user()->institute )->get(),



            'level8_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->where('L8', '=', '0' )
            ->where('L9', '=', '1' )
            ->where('completed', '=', '0' )
            ->where('status', '=', '1' )
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get() ,

            'level7_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->where('L8', '=', '1' )
            ->where('L7', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get() ,

            'level6_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->where('L7', '=', '1' )
            ->where('L6', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get() ,


            
            'level5_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L6', '=', '1' )
            ->where('L5', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),

            'level4_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L5', '=', '1' )
            ->where('L4', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
           // ->where('institute_id', '=', Auth::user()->institute )
           ->get(),

            'level3_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L4', '=', '1' )
            ->where('L3', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),

            'level2_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            ->where('L3', '=', '1' )
            ->where('L2', '=', '0' )
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),

            'level1_tobesubmite'=>DB::table("ot_list")
            ->select('ot_list_status.list_id as id','ot_range')
            ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")           
            ->where('completed', '=', '0' )
            ->where('status','=',1)
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),
            //************************************************************************ */



            //************************************************************************ */

            'resubmit11'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '10' )
            ->groupBy("ot_list_number")
            ->where('institute_id', '=', Auth::user()->institute )
            ->get(),



            'resubmit10'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '9' )
            ->groupBy("ot_list_number")
            ->where('institute_id', '=', Auth::user()->institute )
            ->get(),



            'resubmit9'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '8' )
            ->groupBy("ot_list_number")
            ->where('institute_id', '=', Auth::user()->institute )
            ->get(),



            'resubmit8'=>DB::table("minutes")
            ->select("minutes.id",'ot_list_number')
            ->join("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->join("ot_list","ot_list_status.list_id","=","ot_list.id")            
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')                
                ->groupBy("minutes.ot_list_number");
            })
            ->where("minutes.type", "=", 'B')
            ->where('submit_level', '=', '7' )
            ->groupBy("minutes.ot_list_number")
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get(),



            'resubmit7'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '6' )
            ->groupBy("ot_list_number")
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get(),


            

            'resubmit6'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")
            ->join("institute","ot_list.institute_id","=","institute.id")
            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '5' )
            ->groupBy("ot_list_number")
            ->where(function($c) {
                $c->where('institute_id', '=', Auth::user()->institute )
                ->orwhere('institute.main_institute', '=', Auth::user()->institute);
            })
            ->get(),



            'resubmit5'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '4' )
            ->groupBy("ot_list_number")
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),



            'resubmit4'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '3' )
            ->groupBy("ot_list_number")
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),



            'resubmit3'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '2' )
            ->groupBy("ot_list_number")
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),


            'resubmit2'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            ->where('submit_level', '=', '1' )
            ->groupBy("ot_list_number")
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),


            'resubmit1'=>DB::table("minutes")
            ->select("minutes.id")
            ->leftjoin("ot_list_status","minutes.ot_list_number","=","ot_list_status.id")
            ->leftjoin("ot_list","ot_list_status.list_id","=","ot_list.id")

            ->whereIn("minutes.id", function($query){
                $query->from("minutes")
                ->selectRaw('max(minutes.id)')
                
                ->groupBy("ot_list_number");
            })
           ->where("minutes.type", "=", 'b')
            //->where('submit_level', '=', '1' )
            ->groupBy("ot_list_number")
            //->where('institute_id', '=', Auth::user()->institute )
            ->get(),

            //************************************************************************ */

           


        ]);

        
    }

   
}
