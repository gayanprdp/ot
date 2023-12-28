


<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}



    <div class="grid grid-cols-2 p-3 bg-white" >
      <div>
        <h2 class="font-semibold text-xl text-sky-800 leading-tight">
          {{ __('OT Sheets Status') }}
        </h2>
        <div aligne="left" class=" py-3 text-left text-sky-700 dark:text-gray-300 uppercase tracking-wider"> 
          @if (Auth::user()->user_level>6)
            @foreach ($ins as $item1)                        
                <td class="px-6 py-4 whitespace-nowrap">{{$item1->institute}}</td>                        
            @endforeach
          @endif
      </div>
      </div>
      <div>
        <div class="flex justify-end m-2 ">  
          <input data-bs-toggle="tooltip" data-bs-placement="top" title="Search with Institute , Year or Month" type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search...  " class="block  transition duration-150 ease-in-out appearance-none bg-white border border-sky-700 w-64 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        </div>
      </div>
    </div>

    <div class="max-w mx-auto px-2 bg-white">

      <div class="grid grid-cols-2  bg-white pb-2" > 
        
        <div class="p-1 text-sky-700 ">Year / අවුරුද්ද<br>
          <div class="hidden">
            {{$c=now()->year}}
          </div>        
          <select name="year"  wire:model.lazy="year" class="w-full  border-sky-700 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm">
            <option value="">All</option>
            @for($x=1;$x<10;$x++)
                <option value="{{$c}}">{{$c}}</option>
                <div class="hidden">
                  {{$c--}}
                </div>                
              @endfor
          </select>
        </div>
        
        <div class="p-1 text-sky-700 ">Status<br> 
          <select name="status"  wire:model.lazy="status" class="w-full  border-sky-700 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm">
            <option value="I">Incomplete</option>
            <option value="C">Completed</option>
            <option value="A">All</option>
          </select>
        </div>

        
      </div>
      

      @if (Auth::user()->user_level<=8)
      <div class="p-1 pb-5  text-sky-700">
      Institute / ආයතනය<br>
          <select name="institute"  wire:model.lazy="institute" class="w-full border-sky-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
              <option></option>
                @if (Auth::user()->user_level==8 || Auth::user()->user_level==7 || Auth::user()->user_level==6)
                    @foreach (\App\Models\institute::where('main_institute','=',Auth::user()->institute)->get() as $data)
                      <option value="{{  $data->id }}">{{ $data->institute }} - ({{  $data->institute_code }})</option>
                    @endforeach 
                @else
                    @foreach (\App\Models\institute::all() as $data)
                      <option value="{{  $data->id }}">{{ $data->institute }} - ({{  $data->institute_code }})</option>
                    @endforeach 
                @endif
          </select>
      </div>
      @endif
                  

                 

  
  
      <table  class="w-full divide-y divide-sky-700"  width="100%">
        <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
        <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg">
          <tr>
            <th scope="col"  class=" w-1  text-white p-1">Index</th>
            <th scope="col"  class=" w-24 text-white p-1">Year</br>අවුරුද්ද</th>
            <th scope="col"  class=" w-32 text-white p-1">Month</br>මාසය  </th>
            <th scope="col"  class=" w-36 text-white">Sheet Type  </th>
            <th scope="col"  class=" w-32 text-white p-1"></th>
            @if (Auth::user()->user_level<=8)
              <th scope="col"  class=" w-32 text-white p-1">Institute</br>ආයතනය </th>
            @endif
            
            <th scope="col"  class=" w-1/3 text-white p-1">Status</br> </th>
            <th scope="col"  class=" w-32"></th>
          </tr>
        </thead>
        
        <tbody class="bg-white divide-y divide-sky-500">
                               
        

                       

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
          <tr>
            <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$otlist->firstItem()+$key}}</td>
              
                                      
            <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$item->year}}</td>
            <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$item->month}}</td>
            
            @if ($item->type==0)
              <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">Pre</td>
            @else
              <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">Post</td>
            @endif

            @if ($item->ot_range=='r1')
              <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For Director Approval </td>
            @elseif ($item->ot_range=='r2')
              <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For Director- Admin Approval </td>
            @elseif ($item->ot_range=='r3')
              <td valign="top" class="px-6 py-5 whitespace-nowrap  text-sky-800">For ADG Approval </td>
            @endif
            @if (Auth::user()->user_level<=8)
              <td valign="top" class="px-6 py-3 whitespace-nowrap text-sky-800 " title="{{$item->institute}}">{{$item->institute_code}} - {{$item->institute}}</td>
            @endif

            

            <td valign="top" class="px-6 py-3 whitespace-nowrap text-sky-800">
                                        @if ($item->L2=='1')
                                            
                                              <p class="text-sky-800 text-sm p-1">Completed </p>
                                              <div class="w-full bg-gray-300 h-2 rounded-xl">
                                                <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:100%">                                                
                                                </div>
                                              </div> 
                                            
                                        @elseif ($item->L3=='1' && $item->completed=='0')
                                            
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending Additional Director General(Admin) Approval </p>

                                            <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:90%">
                                              </div>
                                            </div> 
                                        @elseif ($item->L3=='1' && $item->completed=='1')
                                            
                                            
                                            <p class="text-sky-800 text-sm p-1">Completed </p>
                                            <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:100%">                                                
                                              </div>
                                            </div>    
                                            
                                        @elseif ($item->L4=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending Director(Admin) Approval </p>

                                            
                                            <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:80%">
                                              </div>
                                            </div> 
                                            
                                            
                                            
                                        @elseif ($item->L5=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending AO/CC(Admin) Review</p>

                                            <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:70%">
                                              </div>
                                            </div> 
                                            
                                           

                                        @elseif ($item->L6=='1')
                                            @if ($item->completed=='1')
                                                <p class="text-sky-800 text-sm p-1">Completed</p>                                              
                                                <div class="w-full bg-gray-300 h-2 rounded-xl">
                                                  <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:100%">
                                                  </div>
                                                </div> 
                                            @else
                                              <p class="text-sky-800 text-sm p-1">Pending Subject Officer(Admin) Review </p>

                                              <div class="w-full bg-gray-300 h-2 rounded-xl">
                                                <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:60%">
                                                </div>
                                              </div> 
                                             @endif   
                                            
                                        @elseif ($item->L7=='1')
                                            
                                            
                                              <p class="text-sky-800 text-sm p-1">Pending Director/CE/CA Review/Approval </p>                                              
                                              <div class="w-full bg-gray-300 h-2 rounded-xl">
                                                <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:50%">
                                                </div>
                                              </div> 
                                            
                                            
                                            
                                        @elseif ($item->L8=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending AO/CC (Director Office) Review </p>

                                           <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:40%">
                                              </div>
                                            </div> 
                                            
                                            
                                        @elseif ($item->L9=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending Subject Officer (Director Office) Review </p>

                                           <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:30%">
                                              </div>
                                            </div> 
                                            
                                        @elseif ($item->L10=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending AD/DD  Review </p>

                                           <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:20%">
                                              </div>
                                            </div> 
                                            
                                        @elseif ($item->L11=='1')
                                            
                                            <p class="text-sky-800 text-sm p-1">Pending AO/CC Review </p>

                                           <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:10%">
                                              </div>
                                            </div> 
                                            
                                                

                                        @else
                                            <p class="text-sky-800 text-sm p-1">OT Sheet Created</p>
                                            <div class="w-full bg-gray-300 h-2 rounded-xl">
                                              <div class="bg-green-500 h-2 p-1 rounded-xl" style="width:3%">
                                                
                                              </div>
                                            </div> 
                                        @endif                                        
            </td>

            <td class="text-right text-sm">    
              <div class="py-1">
              @if ($item->completed=='1')
                <x-jet-button  class="bg-sky-800 hover:bg-sky-600" wire:click="printotrecords({{$item->id}},'{{$item->ot_range}}')">Print</x-jet-button>
                <!--<x-jet-button  class="bg-sky-800 hover:bg-sky-600" wire:click="printotrecords2({{$item->id}},'{{$item->ot_range}}')">Print2</x-jet-button>-->
              @endif
              
              <x-jet-button class="bg-sky-800 hover:bg-sky-600 mt-1" wire:click="viewotrecords({{$item->id}},1,'{{$item->ot_range}}','{{$item->otlistid}}','{{$item->type}}')">View</x-jet-button>
              </div>
            </td>
          </tr>
        @endif
        @endforeach
        </tbody>
      </table>

      <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
        {{ $otlist->links() }}
      </div>

      <div class="m-2 p-2"></div>
               
    </div>              

 

      

<div>
  <x-jet-dialog-modal wire:model="showingOtListModal">
              
         
          @if ($isEditMode)
          <x-slot name="title">Update Institute</x-slot>
          @else
          <x-slot name="title">Create New OT Sheet</x-slot>
          @endif  
              
                 
              

          
          <x-slot name="content">
              <div >
                  <form enctype="multipart/form-data">

                    <div class="sm:col-span-6">
                      <label for="year" class="block text-sm font-medium text-gray-700"> Year / අවුරුද්ද</label>
                      <div class="mt-1">
                      

                        <?php $c=now()->year?> 
                        

                        <select name="year"  wire:model.lazy="year" class=" block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                          <option></option>
                          @for($x=1;$x<6;$x++)
                            <option value="{{$c}}">{{$c}}</option>
                            <?php $c--?> 
                          @endfor
                                                       

                        </select>
                        
                      </div>
                      @error('year') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-6">
                      <label for="month" class="block text-sm font-medium text-gray-700"> Month / මාසය</label>
                      <div class="mt-1">
                     
                        <select name="month"  wire:model.lazy="month" class=" block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                          <option></option>
                          
                              <option value="January">January</option>
                              <option value="February">February</option>
                              <option value="March">March</option>  
                              <option value="April">April</option>
                              <option value="May">May</option>
                              <option value="June">June</option>    
                              <option value="July">July</option>   
                              <option value="August">August</option>   
                              <option value="September">September</option>   
                              <option value="October">October</option>   
                              <option value="November">November</option>   
                              <option value="Dicember">Dicember</option>                         

                        </select>
                        
                      </div>
                      @error('month') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
         
                    
                  </form>
                </div>
                


          </x-slot>
          <x-slot name="footer">
              
              @if ($isEditMode)
              <x-jet-button wire:click="editIns">Update</x-jet-button>
              @else
              <x-jet-button wire:click="storeOtList({{Auth::user()->institute}})">Create</x-jet-button>
              @endif   
             
            </x-slot>
  </x-jet-dialog-modal>
</div>



<div>
  <x-jet-dialog-modal wire:model="showingdeletemodal"  class=" z-50 bg-opacity-100">
      <x-slot name="title"></x-slot>
    
      <x-slot name="content" >

        <div class="text-center">
          <label for="designation" class="block text-xl font-medium text-gray-700"> Are you sure you want to delete this record?</label>  
        </div>

        <input type="text" id="deleteID" wire:model.lazy="deleteID" name="deleteID" class="hidden block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
    
        <div class="text-center p-6 "> 
          <x-jet-button wire:click="DeleteModal" class="bg-black-300 hover:bg-red-500">Yes</x-jet-button>        
          <x-jet-button wire:click="HideDeleteModal" >No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer"></x-slot>
  </x-jet-dialog-modal>
</div>



<div>
  <x-jet-dialog-modal wire:model="showingsubmitmodal"  class=" z-50 bg-opacity-100">
      <x-slot name="title"></x-slot>
    
      <x-slot name="content" >

        <div class="text-center">
          <label for="designation" class="block text-xl font-medium text-gray-700"> Are you sure you want to submit this record?</label>  
        </div>

        <input type="text" id="deleteID" wire:model.lazy="deleteID" name="deleteID" class="hidden block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
    
        <div class="text-center p-6 "> 
          <x-jet-button wire:click="SubmiModal" class="bg-black-300 hover:bg-red-500">Yes</x-jet-button>        
          <x-jet-button wire:click="HideSubmitModal" >No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer"></x-slot>
  </x-jet-dialog-modal>
</div>


</div>



