



 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



    <div class="max-w mx-auto ">

        <div class="p-6 bg-white">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>

        <div class="grid grid-cols-4 gap-4 max-w-7xl mx-auto px-3 py-5">            
            <div class="bg-amber-800 overflow-hidden shadow-xl  px-6 py-12 text-md text-white font-medium h-48 text-right rounded-md">

                                                    @if (Auth::user()->user_level == 11)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level11_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 10)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level10_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 9)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level9_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 8)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level8_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 7)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level7_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 6)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level6_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                                <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 5)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level5_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 4)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level4_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 3)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level3_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 2)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level2_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

                                                    @if (Auth::user()->user_level == 1)
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($level1_tobesubmite as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Pending</font>  Sheets </a>
                                                    @endif

            </div>



            <div class="bg-sky-700 overflow-hidden shadow-xl  px-6 py-12 text-lg text-white font-medium h-48 text-right rounded-md">

                @if (Auth::user()->user_level == 11)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit11 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 10)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit10 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif
                
                @if (Auth::user()->user_level == 9)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit9 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 8)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit8 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 7)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit7 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 6)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit6 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 5)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit5 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 4)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit4 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 3)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit3 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 2)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit2 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif

                @if (Auth::user()->user_level == 1)
                    <div class="hidden"> {{$c=0}} </div>  
                    @foreach ($resubmit1 as $item)
                        <div class="hidden"> {{$c++}} </div> 
                    @endforeach
                    <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"> <div class="text-6xl font-bold">{{$c}}</div>Sheets to be <font class="text-2xl">Re-checked</font> </a>
                @endif
            </div>





            
            <div class="bg-orange-700 overflow-hidden shadow-xl  px-6 py-12 text-white font-medium h-48 text-right rounded-md">
                                                    @if ((Auth::user()->user_level > 6) )
                                                    <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($incomplete as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list.status', ['param' =>  Auth::user()->institute ,'param2' =>  'I']) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">On-going</font> OT Sheets</a>
                                                    @else
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($incompleteall as $item)
                                                            <div class="hidden">
                                                            {{
                                                            $ot_rec_check=DB::table("ot_records")
                                                            ->select('List_id','ot_range')
                                                            ->where('List_id', '=', $item->id )
                                                            ->where('ot_range', '=', $item->ot_range)
                                                            ->count()
                                                            }}   
                                                            </div> 
                                                            @if (($ot_rec_check!=0) || ($item->ot_range=='r1') )
                                                            <div class="hidden"> {{$c++}} </div> 
                                                            @endif
                                                        @endforeach
                                                        <a href="{{ route('ot.list.status', ['param' =>  Auth::user()->institute ,'param2' =>  'I']) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">On-going</font> OT Sheets</a>
                                                    @endif                      
            </div>






            <div class="bg-green-700 overflow-hidden shadow-xl  px-6 py-12 text-lg text-white font-medium h-48 text-right rounded-md">
                                                    @if ((Auth::user()->user_level > 6) )
                                                        <div class="hidden"> {{$c=0}} </div>  
                                                        @foreach ($complete as $item)
                                                            <div class="hidden"> {{$c++}} </div>  
                                                        @endforeach
                                                        <a href="{{ route('ot.list.status', ['param' =>  Auth::user()->institute,'param2' =>  'C' ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Completed</font> OT Sheets</a>
                                                    @else
                                                        <div class="hidden"> {{$c=0}} </div> 
                                                        @foreach ($completeall as $item)
                                                            <div class="hidden"> {{$c++}} </div>  
                                                        @endforeach
                                                        <a href="{{ route('ot.list.status', ['param' =>  Auth::user()->institute,'param2' =>  'C' ]) }}"> <div class="text-6xl font-bold">{{$c}}</div> <font class="text-2xl">Completed</font> OT Sheets</a>
                                                    @endif                              
            </div>


            
        </div>


        <div class="grid grid-cols-2 gap-4 max-w-7xl mx-auto px-3 py-5">  
            <div>
                <div class="text-center text-xl">
                    {{now()->year}}  Total OT Hours -  Month Wise Count
                  </div>
                          
                  <div class="chart-container">
                    <div class="pie-chart-container">
                      <canvas id="pie-chart"></canvas>
                    </div>
                  </div>
            </div>
            <div class="text-right p-5 text-sky-800">
                
                {{now()->year}} Total Approved OT hours - 
                <strong class="text-3xl">
                @foreach($totalOTHour as $item)
                    {{$item->total_value}}
                @endforeach
                </strong>
            </div>
           
        </div>
        
        <div class="grid grid-cols-1 gap-4 max-w-2xl mx-auto px-3 py-5 ">

            
            
             
              <!-- javascript -->
             
               <script>
              $(function(){
                  //get the pie chart canvas
                  var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                  var ctx = $("#pie-chart");
             
                  //pie chart data
                  var data = {
                    labels: cData.label,
                    datasets: [
                      {
                        label: "OT Hours Count",
                        data: cData.data,
                        backgroundColor: [
                          "#0d70a6",
                          "#0d70a6",
                          "#0d70a6",
                          "#0d70a6",
                          "#0d70a6",
                          "#0d70a6",
                          "#0d70a6",
                        ],
                        borderColor: [
                          "#074363",
                          "#074363",
                          "#074363",
                          "#074363",
                          "#074363",
                          "#074363",
                          "#074363",
                        ],
                        borderWidth: [1, 1, 1, 1, 1,1,1]
                      }
                    ]
                  };
             
                  //options
                  msg=""

                  var options = {
                    responsive: true,
                    title: {
                      display: true,
                      position: "top",
                      text:  msg,
                      fontSize: 18,
                      fontColor: "#111"
                    },
                    legend: {
                      display: true,
                      position: "bottom",
                      labels: {
                        fontColor: "#333",
                        fontSize: 16
                      }
                    }
                  };
             
                  //create Pie Chart class object
                  var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                  });
             
              });
            </script>

            
        </div>




        
    </div>



    

                   

                    
                    
                    
                    

                  
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>




