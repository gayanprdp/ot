

<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}
 


  <div class="grid grid-cols-2 p-4 bg-white" >
    <div>
      <h2 class="font-semibold text-xl text-sky-800 leading-tight">
        {{ __('OT Sheet - ') }}
        
        <?php 
        $nitifi=DB::table("ot_list")->join("institute","institute.id","=","ot_list.institute_id")->where('ot_list.id', '=', $param )->get()
        ?> 
         @foreach ($nitifi as $item)
         {{$item->year}} - {{$item->month}} 
         @endforeach
  
      </h2>

     


        <?php 
        $nitifi=DB::table("ot_list")->join("institute","institute.id","=","ot_list.institute_id")->where('ot_list.id', '=', $param )->get()
        ?> 
         @foreach ($nitifi as $item)
          <p class="text-sky-800">{{$item->institute}}</p>
         @endforeach
    </div>
    <div>
      <div class="flex justify-end m-2 p-2">

        <input type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search..." class="block w-64 appearance-none bg-white border border-sky-700 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">

      </div>
      <div class="flex justify-end m-2 p-2">

    

        
        <div class="hidden">{{$otrec=DB::table("ot_list_status")->select('id','List_id','ot_range')->where('List_id', '=', $this->param)->where('ot_range', '=', $this->param2 )->get()}}</div>   
        <div class="hidden">{{$otrec1=DB::table("ot_records")->where('List_id', '=', $this->param )->where('ot_range', '=', $this->param2 )->get()}}</div> 
        <div class="hidden">{{$otrec2=DB::table("ot_records")->where('List_id', '=', $this->param )->where('ot_range', '=', $this->param2 )->where('mark', '=', '1' )->get()}}</div> 
          @foreach($otrec as $item) 
          @if (Auth::user()->user_level!=1)
                @if ($otrec1->count()==0)                
                  <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14"  wire:loading.attr="disabled">Forward</x-jet-button>                
                @else
                  @if ($param1==1)                   
                    <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14"  wire:loading.attr="disabled">Forward</x-jet-button>
                  @else

                        @if ($otrec2->count()!=0) 
                          @if(Auth::user()->user_level!=8) 
                          <x-jet-button class="bg-sky-800 hover:bg-sky-600 mr-2" wire:click="ShowResubmitModal" wire:loading.attr="disabled">Resubmit</x-jet-button>
                          @endif
                          <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14"  wire:loading.attr="disabled">Forward</x-jet-button>
                        @else

                                @if((Auth::user()->user_level==6)&& ($this->param2=='r1')||((Auth::user()->user_level==3)&& ($this->param2=='r2')) ||((Auth::user()->user_level==2)&& ($this->param2=='r3'))) 
                                          
                                          @if(Auth::user()->user_level!=8 && ($otrec2->count()!=0))  
                                            <x-jet-button class="bg-sky-800 hover:bg-sky-600 mr-2" wire:click="ShowResubmitModal" wire:loading.attr="disabled">Resubmit</x-jet-button>
                                          @else 
                                            <x-jet-button class="bg-gray-700 hover:bg-gray-700 mr-2" wire:loading.attr="disabled">Resubmit</x-jet-button> 
                                          @endif 

                                  <x-jet-button wire:click="ShowForwardModal" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Approve</x-jet-button>
                                @else
                                          @if(Auth::user()->user_level!=8)
                                          <x-jet-button class="bg-gray-700 hover:bg-gray-700 mr-2" wire:loading.attr="disabled">Resubmit</x-jet-button>
                                          @endif
                                  <x-jet-button wire:click="ShowForwardModal" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                @endif
                        @endif  

                  @endif               
                @endif  
            @endif              
          @endforeach
         

       



        @if ($param1==1)
          @if ((Auth::user()->user_level == 8 )|| (Auth::user()->user_level == 11 ))
          <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300">Add New Record</x-jet-button> &nbsp;
          @endif
        @else
          @if ((Auth::user()->user_level == 8 )|| (Auth::user()->user_level == 11 ))
            <x-jet-button wire:click="showOtRecordModal"  class="bg-sky-800 hover:bg-sky-600 ">Add New Record</x-jet-button> &nbsp;
          @endif
        
        @endif

        
        <x-jet-button class="hidden bg-sky-800 hover:bg-sky-600 mx-1" wire:click="printotrecords({{$param}})">Print</x-jet-button>
        <a href="{{ route('ot.list', ['param' =>  Auth::user()->institute ]) }}"  class="bg-sky-800 hover:bg-sky-600 text-white rounded-md py-1 px-3 text-base leading-normal ">Back</a> &nbsp;
        
      </div>
    </div>
  </div>

  
  <div class="max-w mx-auto px-3 py-1 bg-gray-100">
    <table  class="w-full divide-y divide-sky-700">
      <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
      <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
        <tr>
          <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Index</td>        
          <td scope="col" class="relative px-6 py-3 col-md-1 font-semibold text-white">EMPLOYEE</br>නිලධාරියාගේ නම</td>
          <td scope="col" class="relative px-6 py-3 col-md-3 font-semibold text-white">DESIGNATION</br>තනතුර</td>
          <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white w-1/10">NATURE OF DUTIES </br>රාජකාරී ස්වභාවය</td>

          @if ( (Auth::user()->user_level == 8) || (Auth::user()->user_level == 7)|| (Auth::user()->user_level == 11))
            <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Suggested Hours</br>යෝජිත පැය ගනන</td>
          @endif

          @if ((Auth::user()->user_level == 6) )
            <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Suggested Hours</br>යෝජිත පැය ගනන</td>
            <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Recommended Hours</br>අධ්‍යක්ෂ නිර්දේෂ කරන පැය ගනන</td>
          @endif

          @if ((Auth::user()->user_level == 2) || (Auth::user()->user_level == 3) ||(Auth::user()->user_level == 4) || (Auth::user()->user_level == 5) )
           
            <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Suggested Hours</br>යෝජිත පැය ගනන</td>
            <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Recommended Hours</br>අධ්‍යක්ෂ නිර්දේෂ </br>කරන පැය ගනන</td>
            @if ($this->param2=='r2')
              <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Approved OT Hours</br>අධ්‍යක්ෂ (පාලන) අනුමත</br> කරන පැය ගනන</td>
            @elseif ($this->param2=='r3')
              <td scope="col" class="relative px-6 py-3 col-md-2 font-semibold text-white">Approved OT Hours</br>අ.අ.ජ (පාලන) අනුමත</br> කරන පැය ගනන</td>
            @endif

          @endif

          

          <th scope="col" class="relative px-6 py-3 col-md-2 text-white">ACTION</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-sky-500">
          
          @foreach ($otrecords as $key =>$item)
            @if ($item->mark==1)
              <tr class="bg-red-300">
            @else
              <tr >
            @endif

              <td class="px-6 py-2 align-top whitespace-nowrap text-sky-800">{{$otrecords->firstItem()+$key}}</td>
              <td class=" whitespace-nowrap text-sky-800"><textarea class="border-none resize-y bg-transparent"  name="" id="" cols="15" rows="3">{{$item->name}}</textarea></td>
              <td class="  whitespace-nowrap text-sky-800"><textarea class="border-none resize-y bg-transparent"  name="" id="" cols="10" rows="3">{{$item->desig}}</textarea></td>
              <td class=" whitespace-nowrap text-sky-800"><textarea class="border-none resize-y bg-transparent"  name="" id="" cols="30" rows="3">{{$item->Nature_of_duties}}</textarea></td>

              @if ((Auth::user()->user_level == 8) || (Auth::user()->user_level == 7)|| (Auth::user()->user_level == 11))
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->suggest_ot_hour}}</td> 
              @endif

              @if ((Auth::user()->user_level == 6) )
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->suggest_ot_hour}}</td> 
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->director_rec_ot_hour}}</td> 
              @endif

              @if ((Auth::user()->user_level == 2) ||(Auth::user()->user_level == 3) ||(Auth::user()->user_level == 4) || (Auth::user()->user_level == 5) )
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->suggest_ot_hour}}</td> 
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->director_rec_ot_hour}}</td> 
                <td class="py-2 align-top whitespace-nowrap text-center text-sky-800">{{$item->director_admin_rec_ot_hour}}</td> 
              @endif
  
              <td class="px-6  text-right text-sm">

                @if ($param1==1)                  
                  <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300"  wire:loading.attr="disabled">Edit</x-jet-button>
                  @if (Auth::user()->user_level == 8)
                    <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300"  wire:loading.attr="disabled">Delete</x-jet-button>
                  @endif 
                @else
                  @if (Auth::user()->user_level != 5 && Auth::user()->user_level != 4)
                    <!--<input type="checkbox"  wire:model="checkbox">{{var_export($checkbox1)}}-->
                    @if ($item->mark==1)
                      <x-jet-button  class="bg-sky-800 hover:bg-sky-600 border border-white w-25 text-center" wire:click="highlight({{$item->otid}})" wire:loading.attr="disabled">Uncheck</x-jet-button>
                    @else
                      @if ((Auth::user()->user_level==7) || (Auth::user()->user_level==8))
                        @if ((Auth::user()->institute!=$item->main_institute))
                          <x-jet-button  class="bg-sky-800 hover:bg-sky-600 border border-white w-25 text-center" wire:click="highlight({{$item->otid}})" wire:loading.attr="disabled">Check</x-jet-button>
                        @endif
                      @else
                      <x-jet-button  class="bg-sky-800 hover:bg-sky-600 border border-white w-25 text-center" wire:click="highlight({{$item->otid}})" wire:loading.attr="disabled">Check</x-jet-button>
                      @endif
                    @endif
                  @endif
                    <x-jet-button class="bg-sky-800 hover:bg-sky-600 border border-white w-20 text-center" wire:click="showEditOtRecordModel({{$item->otid}})" wire:loading.attr="disabled">Edit</x-jet-button>
                  @if (Auth::user()->user_level == 8 || Auth::user()->user_level == 11)
                    <x-jet-button class="bg-sky-800 hover:bg-red-700 border border-white w-20 text-center" wire:click="ShowDeleteModal({{ $item->otid }})" wire:loading.attr="disabled">Delete</x-jet-button> 
                  @endif
                @endif

                
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>

    
                  <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
                    {{ $otrecords->links() }}
                  </div>



                  <div class="m-2 p-2 border-2 border-gray-300 bg-gray-200 text-sky-700">
                    Minutes Sheet
                            <div class="hidden"> 
                              {{
                              $minute=DB::table("minutes")
                              ->select('name','designation','minutes.updated_at as updated_at','minute','minutes.type as type','submit_level')
                              ->join('users','users.id','=','minutes.user')
                              ->join('user_designation','user_designation.id','=','users.designation_id')
                              //->join('user_level','user_level.user_level','=','users.user_level')
                              ->where('ot_list_number', '=', $param3 )
                              
                              ->orderBy('minutes.id', 'ASC')
                              ->get()
                              }}
                            </div> 

                            <!--
                              F-forward
                              B-backward
                              A-Approve
                            -->
                            <div class=" text-justify   p-1 text-sm  ">                         
                              @foreach ($minute as $mn)
                                @if (($mn->type=="F") || ($mn->type=="A"))
                                  <div class="text-green-700">
                                      @if ($loop->first) 
                                        {{$mn->updated_at}} -Create and Submitted by {{$mn->name}}({{$mn->designation}}). @if ($mn->minute<>"") Remarks - {{$mn->minute}} @endif<br>
                                      @elseif (($loop->last) && (($mn->submit_level==7) || ($mn->submit_level==3)) && ($mn->type=="A"))
                                      {{$mn->updated_at}} - Approved by {{$mn->name}}({{$mn->designation}}). @if ($mn->minute<>"") Remarks - {{$mn->minute}} @endif<br>
                                      @else
                                        {{$mn->updated_at}} - Forwarded by {{$mn->name}}({{$mn->designation}}). @if ($mn->minute<>"") Remarks - {{$mn->minute}} @endif<br>
                                      @endif                                  
                                  </div>                        
                                @endif

                                <div class="text-orange-600">    
                                @if ($mn->type=="B")
                                    {{$mn->updated_at}} - Resubmitted by {{$mn->name}}({{$mn->designation}}). @if ($mn->minute<>"") Remarks - {{$mn->minute}} @endif<br>
                                @endif
                                </div>                                
                              @endforeach
                            </div>
                  </div>

  <br><br>
  </div>              





              <x-jet-dialog-modal wire:model="showingOtRecordModal">
                
                @if ($isEditMode)
                  <x-slot name="title">Update Record</x-slot>
                @else
                  <x-slot name="title">Create New Record</x-slot>
                @endif 
            
                <x-slot name="content">
                  <div>
                    <form enctype="multipart/form-data">

                      


                      <div class="sm:col-span-6">
                        <label for="Emp_id" class="block text-sm font-medium text-sky-800"> Employee / නිලධාරියාගේ නම </label>                        
                        
                        
                        
                        
                        @if ( $this->type==0) 
                                <div class="mt-1">                          
                                    @if ($isEditMode==1) 
                                        <div class="hidden"><input type="text" id="Emp_id"  wire:model.lazy="Emp_id" class="hidden"> </div> 
                                        @foreach (\App\Models\Employees::where('id','=',$this->Emp_id)->get() as $data)
                                          <input type="text" value="{{ $data->name }}" disabled   class="cursor-not-allowed shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm ">                
                                        @endforeach              
                                      
                                    @else
                                      <select name="Emp_id" wire:change="prehours"  wire:model.lazy="Emp_id" class="text-sky-800 block mt-1 w-full border-gray-300 focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option></option>
                                        @foreach (\App\Models\Employees::where('institute','=',Auth::user()->institute)->orderBy('name','ASC')->get() as $data)
                                          <option value="{{  $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                      </select>
                                    @endif                          
                                </div>
                                @error('Emp_id') <span class="text-red-400">{{ $message }}</span> @enderror
                                </div>
                      @else
                                <div class="mt-1">                          
                                  @if ($isEditMode==1) 
                                      <div class="hidden"><input type="text" id="Emp_id"  wire:model.lazy="Emp_id" class="hidden"> </div> 
                                      @foreach (\App\Models\Employees::where('id','=',$this->Emp_id)->get() as $data)
                                        <input type="text" value="{{ $data->name }}" disabled   class="cursor-not-allowed shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm ">                
                                      @endforeach              
                                    
                                  @else

                                  <div class="hidden">{{
                                    $preothours=DB::table("ot_list")
                                    ->select('year','month')
                                    ->where('ot_list.id','=',$this->param)
                                    ->get();
                                  }}
                                  </div> 

                                  @foreach ($preothours as $data)
                                  <div class="hidden">{{
                                    $preothours1=DB::table("ot_records")
                                    ->select('Emp_id','name')
                                    ->join('ot_list','ot_records.List_id','=','ot_list.id')

                                    ->Join("ot_list_status", function($join){
                                      $join->on("ot_list_status.list_id", "=", "ot_records.list_id")
                                      ->on('ot_list_status.ot_range', "=", "ot_records.ot_range");
                                    })
                                    //->join('ot_list_status','ot_list_status.List_id','=','ot_list.id')
                                    ->join('_employees','_employees.id','=','ot_records.Emp_id')
                                    ->where('ot_list.year','=',$data->year)
                                    ->where('ot_list.month','=', $data->month)
                                    ->where('ot_list.institute_id','=', Auth::user()->institute)
                                    ->where('ot_list.type','=', 0)
                                    ->where('ot_list_status.completed','=', 1)
                                    ->get();
                                  }}
                                  </div> 
                                  @endforeach



                                    <select name="Emp_id" wire:change="prehours"  wire:model.lazy="Emp_id" class="text-sky-800 block mt-1 w-full border-gray-300 focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                      <option></option>
                                      @foreach ($preothours1 as $data)
                                        <option value="{{  $data->Emp_id }}">{{  $data->name }}</option>
                                      @endforeach
                                    </select>
                                  @endif                          
                              </div>
                              @error('Emp_id') <span class="text-red-400">{{ $message }}</span> @enderror
                              </div>
                      @endif



                    @if ( $this->type==1)
                          <div class="sm:col-span-6">
                            <label for="previoushours" class="block text-sm font-medium text-sky-800"> Previous Approved OT hours for this Month </label>                        
                            <div class="mt-1">                          
                              <input type="text" id="previoushours"  wire:model.lazy="previoushours" readonly class=" cursor-not-allowed text-sky-800 shadow-sm focus:ring-sky-200 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-sky-500 block w-full sm:text-sm "> 
                            </div>
                            @error('previoushours') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
                      @endif
  
                      

                      @if ((Auth::user()->user_level == 8) || (Auth::user()->user_level == 7)|| (Auth::user()->user_level == 11))                      
                          <div class="sm:col-span-6 pt-5">
                            <label for="suggest_ot_hour" class="block text-sm font-medium text-sky-800">Suggested OT Hours - යෝජිත පැය ගනන</label>
                            <div class="mt-1">
                              <input type="number" id="suggest_ot_hour"  wire:model.lazy="suggest_ot_hour" wire:change="showmsg({{$this->type}})" class="text-sky-800 shadow-sm focus:ring-sky-200 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-sky-500 block w-full sm:text-sm ">
                            </div>
                            
                            
                            @error('suggest_ot_hour') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
                      @endif

                      @if ((Auth::user()->user_level == 6) )
                          <div class="sm:col-span-6 pt-5">
                            <label for="director_rec_ot_hour" class="block text-sm font-medium text-sky-800">OT Hours Recomend by Director - අධ්‍යක්ෂ නිර්දේෂ/අනුමත කරන පැය ගනන</label>
                            <div class="mt-1">
                              <input type="text" id="director_rec_ot_hour"  wire:model.lazy="director_rec_ot_hour" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm ">
                            </div>
                            @error('director_rec_ot_hour') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
                      @endif

                      @if ((Auth::user()->user_level == 2) ||(Auth::user()->user_level == 3) ||(Auth::user()->user_level == 4) || (Auth::user()->user_level == 5) )
                          <div class="sm:col-span-6 pt-5">
                            <label for="director_admin_rec_ot_hour" class="block text-sm font-medium text-sky-800">Approved OT Hours- අ.අ.ජ (පාලන) අනුමත කරන පැය ගනන</label>
                            <div class="mt-1">
                              <input type="text" id="director_admin_rec_ot_hour"  wire:model.lazy="director_admin_rec_ot_hour" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm ">
                            </div>
                            @error('director_admin_rec_ot_hour') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
                      @endif

                      <div class="sm:col-span-6 pt-5">
                        <label for="Nature_of_duties" class="block text-sm font-medium text-sky-800">Nature of Duties / රාජකාරී ස්වභාවය</label>
                        <div class="mt-1">
                          <textarea id="Nature_of_duties" rows="3" wire:model.lazy="Nature_of_duties" class="text-sky-800 shadow-sm focus:ring-sky-200 appearance-none bg-white border border-sky-800 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-sky-500 block w-full sm:text-sm "></textarea>
                        </div>
                        @error('Nature_of_duties') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                    
                     </form>
                  </div>
                  <input type="text" id="msg" wire:model.lazy="msg" disabled class="text-orange-700 text-2xl border-hidden  py-2 px-3  block w-full sm:text-sm shadow-none  focus:border-hidden">
                </x-slot>

                <x-slot name="footer">              
                  @if ($isEditMode)
                    <x-jet-button wire:click="editOtRec({{$param}},{{$this->type}})" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center" wire:loading.attr="disabled">Update</x-jet-button>
                  @else               
                    <x-jet-button wire:click="storeOtRecords({{$param}},{{$this->type}})"  class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center" wire:loading.attr="disabled">Create</x-jet-button>
                  @endif  
                  <x-jet-button wire:click="close" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center" wire:loading.attr="disabled">Close</x-jet-button> 
                </x-slot>

            </x-jet-dialog-modal>


            <div>
              <x-jet-dialog-modal wire:model="showingdeletemodal"  class=" z-50 bg-opacity-100">
                <x-slot name="title"></x-slot>
        
                <x-slot name="content" >
    
                <div class="text-center">
                  <label for="designation" class="block text-xl font-medium text-gray-700"> Are you sure you want to delete this record?</label>  
                </div>
    
                <input type="text" id="deleteID" wire:model.lazy="deleteID" name="deleteID" class="hidden block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
        
                <div class="text-center p-6 "> 
                  <x-jet-button wire:click="DeleteModal" class="bg-black-300 hover:bg-red-500"  wire:loading.attr="disabled">Yes</x-jet-button>        
                  <x-jet-button wire:click="HideDeleteModal"  wire:loading.attr="disabled">No</x-jet-button>
                </div>
    
                </x-slot>
          
                <x-slot name="footer"></x-slot>
              </x-jet-dialog-modal>
            </div>








            <div>
              <x-jet-dialog-modal wire:model="showingforwardmodal"  class=" z-50 bg-opacity-100">
                <x-slot name="title"></x-slot>
              
                <x-slot name="content" >
          

                  <div class=' py-5  h-36'>
                    <div class="">
                      <label for="minut" class="block text-xl font-medium text-sky-800"> Minute</label> 
                    </div>
                    <div class="w-full">
                      <textarea rows=4 cols="10" id="minute" wire:model.lazy="minute" name="minute" class=" w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" ></textarea>
                    @error('minute') <span class="text-red-400">{{ $message }} </span> @enderror
                    </div>
                  </div>
          
                  <div class="text-right py-5">
                    <!-- 8 -->
          
                     
                        <div class="hidden">{{$otrec=DB::table("ot_list_status")->select('id','List_id','ot_range')->where('List_id', '=', $this->param )->where('ot_range', '=', $this->param2 )->get()}}</div>   
                        <div class="hidden">{{$otrec1=DB::table("ot_records")->where('List_id', '=', $this->param )->where('ot_range', '=', $this->param2 )->get()}}</div>                                    
                        
                            @foreach($otrec as $item)  
                            
                                @if ($otrec1->count()==0)
                                  @if((Auth::user()->user_level==6)||(Auth::user()->user_level==3)||(Auth::user()->user_level==2)) 
                                    <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14"  wire:loading.attr="disabled">Approve</x-jet-button>
                                  @else
                                  <x-jet-button class="bg-gray-700 hover:bg-gray-700 text-gray-300 mr-14"  wire:loading.attr="disabled">Forward</x-jet-button>
                                  @endif
                                <x-jet-button wire:click="HideSubmitModal" class="bg-sky-800 hover:bg-sky-600" wire:loading.attr="disabled">Cancel</x-jet-button>
                                @else 


                               
                               
                                  
                                    @if((Auth::user()->user_level==11))
                                      <x-jet-button wire:click="Submit11('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled"> Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==10))
                                      <x-jet-button wire:click="Submit10('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==9))
                                      <x-jet-button wire:click="Submit9('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==8))
                                      <x-jet-button wire:click="Submit8('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==7)) 
                                      <x-jet-button wire:click="Submit7('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==6)) 
                                          @if ($this->param2=='r1') <!-- check OT Range -->
                                            <x-jet-button class="bg-sky-800 hover:bg-sky-600"  wire:click="approve_Director('{{ $item->id}}')" wire:loading.attr="disabled">Approve</x-jet-button> 
                                          @else
                                            <x-jet-button wire:click="Submit6('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                          @endif
                                    @elseif((Auth::user()->user_level==5)) 
                                      <x-jet-button wire:click="Submit5('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif((Auth::user()->user_level==4)) 
                                      <x-jet-button wire:click="Submit4('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                    @elseif(Auth::user()->user_level==3) 
                                          @if ($this->param2=='r2') <!-- check OT Range -->
                                            <x-jet-button class="bg-sky-800 hover:bg-sky-600"  wire:click="approve_Director_Admin('{{ $item->id}}')" wire:loading.attr="disabled">Approve</x-jet-button> 
                                          @else
                                            <x-jet-button wire:click="Submit3('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Forward</x-jet-button>
                                          @endif
                                    @elseif(Auth::user()->user_level==2)
                                      <x-jet-button wire:click="approve_ADG('{{ $item->id}}')" class="bg-sky-800 hover:bg-sky-600 mr-14" wire:loading.attr="disabled">Approve</x-jet-button>
                                    @endif 
                                <x-jet-button wire:click="HideForwardModal" class="bg-sky-800 hover:bg-sky-600" wire:loading.attr="disabled">Cancel</x-jet-button>
                                @endif 
                            @endforeach                                              
                     
                    
                  
                

                        
             
                  </div>

                </x-slot>
                
                <x-slot name="footer">
          
                </x-slot>
              </x-jet-dialog-modal>
            </div>






            <div>
              <x-jet-dialog-modal wire:model="showingResubmitmodal"  class=" z-50 bg-opacity-100">
                <x-slot name="title"></x-slot>
              
                <x-slot name="content" >
          

                  <div class=' py-5 h-36'>
                    <div class="">
                      <label for="designation" class="block text-xl font-medium text-sky-800"> Minute </label> 
                    </div>
                    <div class="w-full">
                      <textarea rows=4 cols="13" id="minute" wire:model.lazy="minute" name="minute" class=" w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" ></textarea>
                    @error('minute') <span class="text-red-400">{{ $message }} </span> @enderror
                    </div>
                  </div>
          
                  <div class="text-right">
                    <!-- 8 -->
          
                     
                        <div class="hidden">
                          {{$otrec=DB::table("ot_list_status")
                        ->select('ot_list_status.id as id','List_id','ot_range','institute.main_institute')
                        ->join('ot_list','ot_list.id','=','ot_list_status.list_id')
                        ->join('institute','institute.id','=','ot_list.institute_id')
                        ->where('List_id', '=', $this->param )
                        ->where('ot_range', '=', $this->param2 )
                        ->get()}}
                        </div>   
                        <div class="hidden">{{$otrec1=DB::table("ot_records")->where('List_id', '=', $this->param )->where('ot_range', '=', $this->param2 )->get()}}</div>                                    
                        
                            @foreach($otrec as $item)  
                                
                                    @if((Auth::user()->user_level==10)) 
                                      <x-jet-button wire:click="ReSubmit10('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif((Auth::user()->user_level==9)) 
                                      <x-jet-button wire:click="ReSubmit9('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif((Auth::user()->user_level==8)) 
                                      <x-jet-button wire:click="ReSubmit8('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif((Auth::user()->user_level==7)) 
                                      <x-jet-button wire:click="ReSubmit7('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif((Auth::user()->user_level==6)) 
                                      <x-jet-button wire:click="ReSubmit6('{{ $item->id}}','{{$item->main_institute}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>    
                                    @elseif((Auth::user()->user_level==5)) 
                                      <x-jet-button wire:click="ReSubmit5('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif((Auth::user()->user_level==4)) 
                                      <x-jet-button wire:click="ReSubmit4('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif(Auth::user()->user_level==3) 
                                      <x-jet-button wire:click="ReSubmit3('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @elseif(Auth::user()->user_level==2)
                                      <x-jet-button wire:click="ReSubmit2('{{ $item->id}}')" class="bg-orange-400 hover:bg-orange-600 mr-14">ReSubmit</x-jet-button>
                                    @endif 
                                <x-jet-button wire:click="HideResubmitModal" class="bg-sky-800 hover:bg-sky-600">Cancel</x-jet-button>
                                
                            @endforeach                                              
                     
                    
                  
                

                        
             
                  </div>

                </x-slot>
                
                <x-slot name="footer">
          
                </x-slot>
              </x-jet-dialog-modal>
            </div>
  
</div>





  