


<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}



    <div class="grid grid-cols-2 p-3 bg-white" >
      <div>
        <h2 class="font-semibold text-xl text-sky-800 leading-tight">
          {{ __('Completed OT Sheets') }}
      </h2>
      </div>
      <div>
        <div class="flex justify-end m-2 ">  
          <input data-bs-toggle="tooltip" data-bs-placement="top" title="Search with Institute , Year or Month" wire:click="gotoPage(1)" type="search" wire:model="search" placeholder="Search...  " class="block  transition duration-150 ease-in-out appearance-none bg-white border border-sky-700 w-64 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        </div>
      </div>
    </div>

    <div class="max-w mx-auto px-2 bg-white">



                  <div class="grid grid-cols-3 p-4" >
                    <div class="px-1 text-sky-700 ">Year<br>
                    <?php $c=now()->year?> 
                        

                        <select name="year"  wire:model.lazy="year" class="w-full  border-sky-700 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm">
                          
                          @for($x=1;$x<10;$x++)
                            <option value="{{$c}}">{{$c}}</option>
                            <?php $c--?> 
                          @endfor
                        </select>
                      </div>

                      <div class="px-1 text-sky-700">Month<br>
                    <select name="month"  wire:model.lazy="month" class="w-full border-sky-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
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

                      <div class="px-1 text-sky-700">
                    Institute<br>
                    <select name="institute"  wire:model.lazy="institute" class="w-full border-sky-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                      <option></option>
                      
                        @foreach (\App\Models\institute::all() as $data)
                        
                          <option value="{{  $data->id }}">{{ $data->institute }} - ({{  $data->institute_code }})</option>
                          
                        @endforeach                      

                    </select>
                      </div>
                  </div>

                 

  
  
                  <table  class="w-full divide-y divide-sky-700">
                    <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
                    <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
                      <tr>
                        <th scope="col"  class=" w-1/10  text-white p-1">ID</th>
                        <th scope="col"  class=" w-1/10 text-white p-1">Year</br>අවුරුද්ද</th>
                        <th scope="col"  class=" w-1/10 text-white p-1">Month</br>මාසය  </th>
                        <th scope="col"  class=" w-1/2 text-white p-1">Institute</br>ආයතනය </th>
                        
                        
                        <th scope="col"  class=" w-1/10 text-white p-1">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-500">
                      <tr></tr>
                      
                      
                      <?php $c=1 ?>    

                      @foreach ($otlist as $item)
                                                      
                      <tr>
                                      <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$c}}</td>
                                      <?php $c++ ?> 
                                      
                                      <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$item->year}}</td>
                                      <td valign="top" class="px-6 py-5 whitespace-nowrap text-sky-800">{{$item->month}}</td>
                                      <td valign="top" class="px-6 py-3 whitespace-nowrap text-sky-800"><textarea class="border-none  w-full" name="" id="" cols="30" >{{$item->institute}}-{{$item->institute_code}}</textarea></td>
                            
                                      <td class="text-right text-sm">    
                                        <div class="py-1"><x-jet-button  class="bg-sky-800 hover:bg-sky-600" wire:click="printotrecords({{$item->id}})">Print</x-jet-button></div>
                                      </td>

                                      

                                     

                      </tr>
  
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



