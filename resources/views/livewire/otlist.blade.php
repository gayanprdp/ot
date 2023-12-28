<div>


  <div class="grid grid-cols-2 p-3 bg-white" >
    <div>
      <h2 class="font-semibold text-xl text-sky-800 leading-tight">
        {{ __('Manage OT Sheets') }}
      </h2>
      <div aligne="left" class=" py-3 text-left text-sky-700 dark:text-gray-300 uppercase tracking-wider"> 
      @if (Auth::user()->user_level>5)
        @foreach ($ins as $item1)                        
            <td class="px-6 py-4 whitespace-nowrap">{{$item1->institute}}</td>                        
        @endforeach
      @endif
      </div>
    </div>


   
    
    <div>
      <div class="flex justify-end m-2 p-2">  
        <input data-bs-toggle="tooltip" data-bs-placement="top" title="Search with Institute , Year or Month" type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search...  " class="block w-64  transition duration-150 ease-in-out appearance-none bg-white border border-sky-700 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
      </div>

      <div class="flex justify-end m-2 ">  
        @if((Auth::user()->user_level==8) || (Auth::user()->user_level==11) )  
          <x-jet-button wire:click="showOtListModal"  class="bg-sky-800 hover:bg-sky-600 m-2">Create New OT Sheet </x-jet-button> &nbsp;
        @endif  
        <x-jet-button wire:click="back()"  class="bg-sky-800 hover:bg-sky-600 m-2">Back</x-jet-button> 
      </div>
    </div>
  </div>

  
  <div class="max-w mx-auto px-3 bg-white">
    <table  class="w-full divide-y divide-sky-700">
      <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
      <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
        <tr>
          <th scope="col"  class=" w-1 text-white text-sm">Index</th>
          <th scope="col"  class=" w-36 text-white text-sm ">Year</br>අවුරුද්ද</th>
          <th scope="col"  class=" w-36 text-white text-sm">Month</br>මාසය  </th>
          <th scope="col"  class=" w-36 text-white text-sm">Sheet Type  </th>

          @if (Auth::user()->user_level<=8)
            <th scope="col"  class=" w-1/2 text-white text-sm">Sub Institute</br>ආයතනය </th>
          @endif
          
          <th scope="col"  class=" w-36 text-white">-  </th>
          <th scope="col"  class=" w-12 text-white text-sm">Record Count  </th>
          
          <th scope="col"  class="px-12  text-white text-sm" align="right">Action</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-sky-500">
                     
      <div class="hidden">
        {{$c=1}}
      </div> 
      
         

@foreach ($otlist as $key =>$item)
      
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
        @if((Auth::user()->user_level==11) && ($item->L11==1) && ($item->L10==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==10) && ($item->L10==1) && ($item->L9==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==9) && ($item->L9==1) && ($item->L8==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==8) && ($item->L8==1) && ($item->L7==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==7) && ($item->L7==1) && ($item->L6==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==6) && ($item->L6==1) && ($item->L5==0))
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==5) && ($item->L5==1) && ($item->L4==0))
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==4) && ($item->L4==1) && ($item->L3==0)) 
          <tr class="bg-emerald-200">
        @elseif((Auth::user()->user_level==3) && ($item->L3==1) && ($item->L2==0))  
          <tr class="bg-emerald-200">
        @else
          <tr>
        @endif

          <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">{{$otlist->firstItem()+$key}}</div>
          <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">{{$item->year}}</td>
          <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">{{$item->month}}</td>
          @if ($item->type==0)
            <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">Pre Approval</td>
          @else
          <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">Post Approval</td>
          @endif

          @if (Auth::user()->user_level<=8)
            @if (Auth::user()->institute==$item->insid)
              <td valign="top" class="px-6 py-3 whitespace-nowrap  text-sky-800"><textarea class="border-none  w-full bg-transparent" name="" id="" cols="30" ></textarea></td>
            @else
              <td valign="top" class="px-6 py-3 whitespace-nowrap  text-sky-800"><textarea class="border-none  w-full bg-transparent" name="" id="" cols="30" >{{$item->institute_code}} - {{$item->institute}}</textarea></td>
            @endif  
          @endif 

          @if ($item->ot_range=='r1')
            <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For Director Approval   </td>
          @elseif ($item->ot_range=='r2')
            <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For Director- Admin Approval  </td>
          @elseif ($item->ot_range=='r3')
            <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For ADG Approval  </td>
          @endif
          <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">{{$ot_rec_check}}</td>
          
          

                           
          <td class="px-6  text-right text-sm">

            <table align="right">
              <tr>
                <td>




                    <!-- 11 Subject clark sub institute -- -->
                            @if((Auth::user()->user_level==11) && ($item->L11==0))  
                              

                            <div class="hidden">
                              {{
                              $minute=DB::table("minutes")
                            ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                            ->join('users','users.id','=','minutes.user')
                            ->join('user_designation','user_designation.id','=','users.designation_id')
                            ->where('ot_list_number', '=', $item->otlistid )
                            
                            ->orderBy('minutes.id', 'DESC')
                            ->get()
                              }}   
                            </div>    
                          
                          
                                    @if ($minute->count()<>0)
                                      @foreach ($minute as $mn)                                          
                                      
                                                                            
                                            @if ($loop->first) 
                                            
                                                @if ($mn->type=="B")
                                                <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                                <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                                    @break                                  
                                                  
                                                @else
                                                  
                                                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                                  @break
                                                @endif
                                              @else
                                                
                                                <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                                @break
                                              @endif                                                                      
                                        
                                      
                                      @endforeach

                                    @else
                                    
                                    <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                    @endif
                                    
                          @else
                            @if((Auth::user()->user_level==11) && ($item->L11==1) && ($item->L10==0)) 
                            <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" > 
                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                            @endif                                          
                          @endif 


                  <!-- 10 Subject clark sub institute -- -->
                  @if((Auth::user()->user_level==10) && ($item->L10==0))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                
                
                          @if ($minute->count()<>0)
                            @foreach ($minute as $mn)                                          
                            
                                                                  
                                  @if ($loop->first) 
                                  
                                    @if ($mn->type=="B")
                                    <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                    <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                        @break                                  
                                      
                                    @else
                                                
                                                <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                                @break
                                              @endif
                                    @else
                                      
                                      <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                      @break
                                    @endif                                                                      
                              
                            
                            @endforeach
  
                          @else
                          
                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                          @endif
                          
                @else
                  @if((Auth::user()->user_level==10) && ($item->L10==1) && ($item->L9==0)) 
                  <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" > 
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                  @endif                                          
                @endif 
  

                
                    <!-- 9 Subject clark sub institute -- -->
                    @if((Auth::user()->user_level==9) && ($item->L9==0))  
                  

                    <div class="hidden">
                      {{
                      $minute=DB::table("minutes")
                    ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                    ->join('users','users.id','=','minutes.user')
                    ->join('user_designation','user_designation.id','=','users.designation_id')
                    ->where('ot_list_number', '=', $item->otlistid )
                    
                    ->orderBy('minutes.id', 'DESC')
                    ->get()
                      }}   
                    </div>    
                  
                  
                            @if ($minute->count()<>0)
                              @foreach ($minute as $mn)                                          
                              
                                                                    
                                    @if ($loop->first) 
                                    
                                        @if ($mn->type=="B")
                                        <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                        <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                            @break                                  
                                          
                                        @else
                                          
                                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                          @break
                                        @endif
                                      @else
                                        
                                        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                        @break
                                      @endif                                                                      
                                
                              
                              @endforeach
    
                            @else
                            
                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                            @endif
                            
                  @else
                    @if((Auth::user()->user_level==9) && ($item->L9==1) && ($item->L8==0)) 
                    <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" > 
                    <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                    @endif                                          
                  @endif 
    
    



                  <!-- 8 Subject clark-- -->
                @if((Auth::user()->user_level==8) && ($item->L8==0))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                
                
                          @if ($minute->count()<>0)
                            @foreach ($minute as $mn)                                          
                            
                                                                  
                                  @if ($loop->first) 
                                  
                                      @if ($mn->type=="B")
                                      <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                      <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                          @break                                  
                                        
                                      @else
                                        
                                        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                        @break
                                      @endif
                                    @else
                                      
                                      <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                      @break
                                    @endif                                                                      
                              
                            
                            @endforeach

                          @else
                          
                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                          @endif
                          
                @else
                  @if((Auth::user()->user_level==8) && ($item->L8==1) && ($item->L7==0)) 
                  <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" > 
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                  @endif                                          
                @endif 


                <!-- 7 ao-- -->
                @if((Auth::user()->user_level==7) && ($item->L7==0) && ($item->L8==1))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                
                
                          @if ($minute->count()<>0)
                            @foreach ($minute as $mn)                                          
                            
                                                                  
                                  @if ($loop->first) 
                                  
                                      @if ($mn->type=="B")
                                      <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                      <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                          @break                                  
                                        
                                      @else
                                        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                        @break
                                      @endif
                                    @else
                                      <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                      @break
                                    @endif                                                                      
                              
                            
                            @endforeach

                          @else
                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                          @endif
                          
                @else
                  @if((Auth::user()->user_level==7) && ($item->L7==1) && ($item->L6==0)) 
                  <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" > 
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                  @endif                                          
                @endif 



                <!-- 6 director-- -->
                @if((Auth::user()->user_level==6) && ($item->L6==0) && ($item->L7==1))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                                                    
                            
                                                                  
                            @if ($minute->count()<>0)
                            @foreach ($minute as $mn)                                          
                            
                                                                  
                                  @if ($loop->first) 
                                  
                                      @if ($mn->type=="B")
                                      <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                      <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                          @break                                  
                                        
                                      @else
                                        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                        @break
                                      @endif
                                    @else
                                      <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                      @break
                                    @endif                                                                      
                              
                            
                            @endforeach

                          @else
                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                          @endif
                          
                @else
                  @if((Auth::user()->user_level==6) && ($item->L6==1) && ($item->L5==0))
                  <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" >   
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
                  
                  @endif                                          
                @endif 

                


                <!-- 5- s clark- -->
                @if((Auth::user()->user_level==5) && ($item->L5==0) && ($item->L6==1))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                
                
                  @if ($minute->count()<>0)
                  @foreach ($minute as $mn)                                          
                  
                                                        
                        @if ($loop->first) 
                        
                            @if ($mn->type=="B")
                            <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                            <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                @break                                  
                              
                            @else
                              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                              @break
                            @endif
                          @else
                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                            @break
                          @endif                                                                      
                    
                  
                  @endforeach

                @else
                <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                @endif
                
      @else
        @if((Auth::user()->user_level==5) && ($item->L5==1) && ($item->L4==0)) 
        <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" >  
        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
        
        @endif                                          
      @endif 

            


                <!-- 4--ao a -->
                @if((Auth::user()->user_level==4) && ($item->L4==0) && ($item->L5==1))  
                  

                  <div class="hidden">
                    {{
                    $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                  
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                    }}   
                  </div>    
                
                
                  @if ($minute->count()<>0)
                  @foreach ($minute as $mn)                                          
                  
                                                        
                        @if ($loop->first) 
                        
                            @if ($mn->type=="B")
                            <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                            <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                @break                                  
                              
                            @else
                              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                              @break
                            @endif
                          @else
                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                            @break
                          @endif                                                                      
                    
                  
                  @endforeach

                @else
                   
                  @if((Auth::user()->user_level==4) && ($item->L4==0) && ($item->L3==1)) 
                  <x-jet-button class="text-white bg-green-600 hover:bg-green-600 px-4 py-2 rounded-md cursor-default" >Submited</x-jet-button>   
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
        
                  @else
                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                  @endif
                  @endif
                
      @else
        @if((Auth::user()->user_level==4) && ($item->L4==1) && ($item->L3==0))
        <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" >   
        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
        
        @endif                                          
      @endif 

                <!-- 3-- -->
                @if((Auth::user()->user_level==3) && ($item->L3==0) && ($item->L4==1))  
                  

                  <div class="hidden">
                  {{
                  $minute=DB::table("minutes")
                  ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                  ->join('users','users.id','=','minutes.user')
                  ->join('user_designation','user_designation.id','=','users.designation_id')
                  ->where('ot_list_number', '=', $item->otlistid )
                
                  ->orderBy('minutes.id', 'DESC')
                  ->get()
                  }}   
                  </div>   
                
                
                  @if ($minute->count()<>0)
                  @foreach ($minute as $mn)                                          
                  
                                                        
                        @if ($loop->first) 
                        
                            @if ($mn->type=="B")
                            <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                            <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                @break                                  
                              
                            @else
                              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                              @break
                            @endif
                          @else
                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                            @break
                          @endif                                                                      
                    
                  
                  @endforeach

                @else
                <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                @endif
                
      @else
        @if((Auth::user()->user_level==3) && ($item->L3==1) && ($item->L2==0))  
        <input type="button" value="Submitted" class=" bg-emerald-200 text-sky-800 px-4 py-2  cursor-default" >   
        <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>                    
        
        @endif                                          
      @endif 



                <!-- Additional Director General (Admin)  2 -->
                @if((Auth::user()->user_level==2 ) && ($item->L2==0) && ($item->L3==1) && ($item->completed==0) ) 
                  
                <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>
                @endif 


                @if((Auth::user()->user_level==1 ) && ($item->completed==0) ) 
                  
                    <div class="hidden">
                      {{
                        $minute=DB::table("minutes")
                        ->select('name','designation','minutes.updated_at as updated_at','minute','type','submit_level')
                        ->join('users','users.id','=','minutes.user')
                        ->join('user_designation','user_designation.id','=','users.designation_id')
                        ->where('ot_list_number', '=', $item->otlistid )                                            
                        ->orderBy('minutes.id', 'DESC')
                        ->get()
                      }}
                    </div>

                          @if ($minute->count()<>0)
                            @foreach ($minute as $mn)         
                                @if ($loop->first) 
                                  @if ($mn->type=="B")
                                  <text  class="text-orange-400 ">(Resubmitted by {{$mn->designation}})</text>
                                  <x-jet-button class="bg-orange-400 hover:bg-orange-600" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                      @break                                  
                                    
                                  @else
                                    <x-jet-button class="hidden bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                    @break
                                  @endif
                                @else
                                  <x-jet-button class="hidden bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                                  @break
                                @endif 
                            @endforeach
                          @else
                            <x-jet-button class="hidden bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},0,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>  
                          @endif
                    

                @endif 
                </td>
                <td>
                                              
                </td>

              
              </tr>
             </table>
                                  

                                            
                                        
                                               <!--                                           
                                              <x-jet-button class="bg-black-500 hover:bg-gray-500" wire:click="printotrecords({{$item->id}})">Print</x-jet-button>
                                              -->
                                            
                                             
                                    </td>

                      </tr>
  @endif
  @endforeach
  
                      
  
                      <!-- More items... -->
                    </tbody>
    </table>

    <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
      {{ $otlist->links() }}
    </div>

    <div class="m-2 p-2"></div>
               
  </div>              

 

      

  <div>
    <x-jet-dialog-modal wire:model="showingOtListModal"  >              
         
          @if ($isEditMode)
          <x-slot name="title">Update Institute</x-slot>
          @else
          <x-slot name="title">Create New OT Sheet</x-slot>
          @endif  
              
                 
              

          
          <x-slot name="content">
            <div >
              <form enctype="multipart/form-data">

                <div class="sm:col-span-6">
                  <label for="type" class="block text-sm font-medium text-sky-800"> Type  </label>
                    <div class="mt-1">
                      <select name="type"  wire:model.lazy="type" class=" block mt-1 w-full border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value=""></option>
                        <option value="0">Pre Approval / පූර්ව අනුමැතිය</option>
                        <option value="1">Post Approval / පසු අනුමැතිය </option>
                  
                      </select>
                  </div>
                  @error('type') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>


                <div class="sm:col-span-6">
                  <label for="year" class="block text-sm font-medium text-sky-800"> Year / අවුරුද්ද </label>
                    <div class="mt-1">
                      <select name="year"  wire:model.lazy="year" class=" block mt-1 w-full border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm">
                      <option value=""></option>
                  
                        @if ((now()->month)>10)
                          <div class="hidden">
                            {{$c=(now()->year)+1}}  
                          </div>
                          @for($x=1;$x<4;$x++)
                            <option value="{{$c}}">{{$c}}</option><div class="hidden">{{$c--}}</div>
                          @endfor
                        @else
                          <div class="hidden">
                            {{$c=(now()->year)}}  
                          </div>
                          @for($x=1;$x<4;$x++)
                            <option value="{{$c}}">{{$c}}</option><div class="hidden">{{$c--}}</div>
                          @endfor
                        @endif
                      </select>
                  </div>
                  @error('year') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-6">
                  <label for="month" class="block text-sm font-medium text-sky-800"> Month / මාසය</label>
                    <div class="mt-1">
                      <select name="month"  wire:model.lazy="month" class=" block mt-1 w-full border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option></option>                          
                        <option value="January">January / ජනවාරි</option>
                        <option value="February">February /  පෙබරවාරි</option>
                        <option value="March">March /  මාර්තු</option>  
                        <option value="April">April / අප්‍රේල්</option>
                        <option value="May">May /  මැයි</option>
                        <option value="June">June /  ජුනි</option>    
                        <option value="July">July /  ජූලි</option>   
                        <option value="August">August / අගෝස්තු</option>   
                        <option value="September">September /  සැප්තැම්බර්</option>   
                        <option value="October">October /  ඔක්තොම්බර්</option>   
                        <option value="November">November / නොවැම්බර්</option>   
                        <option value="December">December / දෙසැම්බර්</option>                         
                      </select>
                    </div>
                    @error('month') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>                   
              </form>
            </div>
                


          </x-slot>
          <x-slot name="footer" class="bg-sky-700">
              
              @if ($isEditMode)
              <x-jet-button wire:click="editIns" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Update</x-jet-button>
              @else
              <x-jet-button wire:click="storeOtList({{Auth::user()->institute}})" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Create</x-jet-button>
              @endif   
              <x-jet-button wire:click="close" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Close</x-jet-button>
            </x-slot>
    </x-jet-dialog-modal>
  </div>



  <div>
    <x-jet-dialog-modal wire:model="showingdeletemodal"  class=" z-50 bg-opacity-100">
      <x-slot name="title"></x-slot>
    
      <x-slot name="content" >

        <div class="text-center">
          <label for="designation" class="block text-xl font-medium text-sky-800"> Are you sure you want to delete this record?</label>  
        </div>

        <input type="text" id="deleteID" wire:model.lazy="deleteID" name="deleteID" class="hidden block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
    
        <div class="text-center p-6 "> 
          <x-jet-button wire:click="DeleteModal" class="bg-sky-800 hover:bg-red-500">Yes</x-jet-button>        
          <x-jet-button wire:click="HideDeleteModal" class="bg-sky-800 hover:bg-sky-600" >No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer">

      </x-slot>
    </x-jet-dialog-modal>
  </div>



  <div>
    <x-jet-dialog-modal wire:model="showingsubmitmodal"  class=" z-50 bg-opacity-100">
      <x-slot name="title"></x-slot>
    
      <x-slot name="content" >

        <div class=' py-5 h-32'>
          <div class="">
            <label for="designation" class="block text-xl font-medium text-sky-800"> Minute </label> 
          </div>
          <div class="w-full">
            <input type="text" id="minute" wire:model.lazy="minute" name="minute" class=" w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
          @error('minute') <span class="text-red-400">{{ $message }} </span> @enderror
          </div>
        </div>

        <div class="text-right">
          <!-- 8 -->

          @if((Auth::user()->user_level==8)) 
              <div class="hidden">
              {{
              $otrec=DB::table("ot_list_status")
              ->select('id','List_id','ot_range')
              ->where('List_id', '=', $this->SubmitID )
              ->where('ot_range', '=', $this->OT_range )
              ->get()
              }}   
              </div>   

              <div class="hidden">
                {{
                $otrec1=DB::table("ot_records")
                ->where('List_id', '=', $this->SubmitID )
                ->where('ot_range', '=', $this->OT_range )
                ->get()
                }}   
                </div>  
                         
              
                  @foreach($otrec as $item)  
                      @if ($otrec1->count()==0)
                      <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14" >Forward</x-jet-button>
                      <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
                      @else
                      
                      <x-jet-button wire:click="Submit8('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14">Forward</x-jet-button>
                      <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
                      @endif                   
                      
                  @endforeach
              
          @endif 

          <!-- 7 -->
          @if((Auth::user()->user_level==7 ))

          <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div>  
            @foreach($otrec as $item)  
              <x-jet-button class="bg-sky-800 hover:bg-sky-600" wire:click="Submit7('{{ $item->id}}')">Forward</x-jet-button>
              <x-jet-button class="bg-orange-600 hover:bg-orange-400 mr-14" wire:click="RESubmit7('{{ $item->id}}')">Resubmit</x-jet-button>
              <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
            @endforeach
          @endif 

          <!-- 6 -->
          @if(((Auth::user()->user_level==6 ))) 
            
            <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div> 
            @foreach($otrec as $item)

              @if ($this->OT_range=='r1')
                <x-jet-button class="bg-sky-800 hover:bg-sky-600"  wire:click="approve('{{ $item->id}}')">Approve</x-jet-button> 
              @else
                <x-jet-button class="bg-sky-800 hover:bg-sky-600" wire:click="Submit6('{{ $item->id}}')">Forward</x-jet-button>
              @endif

              
              <x-jet-button class="bg-orange-600 hover:bg-orange-400 mr-14" wire:click="RESubmit6('{{ $item->id}}')">Resubmit</x-jet-button>
              <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
            @endforeach
          @endif 



          <!-- 5 -->
          @if((Auth::user()->user_level==5 )) 

          <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div> 
            @foreach($otrec as $item)
              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mr-14" wire:click="Submit5('{{ $item->id}}')">Forward</x-jet-button>
              <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
            @endforeach
          @endif 

          <!-- 4-->
          @if(((Auth::user()->user_level==4 ) ))
          <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div> 
            @foreach($otrec as $item)
              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mr-14" wire:click="Submit4('{{ $item->id}}')">Forward</x-jet-button>
              <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
            @endforeach
          @endif                                      
  
          <!-- 3 -->
          @if((Auth::user()->user_level==3 )) 
          <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div> 
            @foreach($otrec as $item)

            @if ($this->OT_range=='r2')
              <x-jet-button class="bg-sky-800 hover:bg-sky-600"  wire:click="ApproveDA('{{ $item->id}}')">Approve</x-jet-button> 
            @elseif ($this->OT_range=='r3')
              <x-jet-button class="bg-sky-800 hover:bg-sky-600" wire:click="Submit3('{{ $item->id}}')">Forward</x-jet-button>
            @endif

              <!--<x-jet-button class="bg-sky-800 hover:bg-sky-600" wire:click="Submit3('{{ $item->id}}')">Forward</x-jet-button>-->
              <x-jet-button class="bg-orange-600 hover:bg-orange-400 mr-14" wire:click="RESubmit3('{{ $item->id}}')">Resubmit</x-jet-button>
              <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
            @endforeach
          @endif 

          <!--  2 -->
          @if((Auth::user()->user_level==2 )) 
          <div class="hidden">
            {{
            $otrec=DB::table("ot_list_status")
            ->select('id','List_id','ot_range')
            ->where('List_id', '=', $this->SubmitID )
            ->where('ot_range', '=', $this->OT_range )
            ->get()
            }}   
            </div> 
            @foreach($otrec as $item)
          
            <x-jet-button class="bg-sky-800 hover:bg-sky-600 " wire:click="Submit2('{{ $item->id}}')">Approve</x-jet-button>
            <x-jet-button class="bg-orange-600 hover:bg-orange-400 mr-14" wire:click="RESubmit2('{{ $item->id}}')">Resubmit</x-jet-button> 
            <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button> 
            @endforeach         
          @endif 

          
        </div>
        <input type="text" id="SubmitID" wire:model.lazy="SubmitID" name="SubmitID" class="hidden w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
      </x-slot>
      
      <x-slot name="footer">

      </x-slot>
    </x-jet-dialog-modal>
  </div>

</div>



