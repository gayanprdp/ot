

<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}
  
  <div class="grid grid-cols-2 p-4 bg-white" >
    <div>
      <h2 class="font-semibold text-xl text-sky-700 leading-tight">
        {{ __('Manage Employees') }}
    </h2>
    
                  <div aligne="left" class=" py-3 text-left text-sky-700 dark:text-gray-300 uppercase tracking-wider">
                    @if (Auth::user()->user_level!=1)
                    @foreach ($ins as $item1)                        
                        <td class="px-6 py-4 whitespace-nowrap">{{$item1->institute}}</td>                        
                    @endforeach
                    @endif
                    
                  </div>
    </div>

        <div class="flex justify-end m-2 p-2">
          <x-jet-button wire:click="showEmployeeModal"  class="bg-sky-800 hover:bg-sky-600 m-2">Create New Employee </x-jet-button> &nbsp;
       
          <input type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search..." class="block  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
       
        </div>
      
                     

    
  </div>
  



  <div class="max-w mx-auto px-3 ">

                  


                 
  
  
                  <table  class="w-full divide-y divide-sky-700">
                    <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
                    <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
                      <tr>
                          <th scope="col" class="relative px-6 py-3 text-white">Index</th>
                          <th scope="col" class="relative px-6 py-3 w-10 text-white">Employee Number /  අංකය</th>
                          <th scope="col" class="relative px-6 py-3  text-white">Name / නිලධාරියාගේ නම</th>                          
                          <th scope="col" class="relative px-6 py-3 text-white">Designation / තනතුර</th>
                          @if (Auth::user()->user_level==1)
                            <th scope="col" class="relative px-6 py-3  w-1/2 text-white">Institute</br>ආයතනය </th>
                          @endif
                          <th scope="col" class="relative px-6 py-3 text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-sky-500">
                          <tr></tr>

                          <div class="hidden">
                            {{$c=1}}
                          </div>

                          @foreach ($emp as $key =>$item)
                            <tr>

                              
                              <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$emp->firstItem()+$key}}</td>
                              

                              
                              <div class="hidden">
                                {{$c++}}
                              </div>
                              <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$item->emp_no}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$item->name}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$item->empdesignation}}</td>
                              @if (Auth::user()->user_level==1)
                                <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-left">{{$item->institute_code}} - {{$item->institute}}</td>
                              @endif
                              <td class="px-6 py-4 text-right text-sm ">  
                                  @if ($item->empdes == null)  
                                    <x-jet-button class="bg-sky-800 hover:bg-red-500 px-2" wire:click="ShowDeleteModal({{ $item->id }})">Delete</x-jet-button> 
                                  @endif
                                  <x-jet-button class="bg-sky-800 hover:bg-sky-600 border-white" wire:click="showEditEmployeeModal({{ $item->id }})">Edit</x-jet-button>
                              </td>
                            </tr>
                          @endforeach
                        
                        </tbody>
                  </table>


                  <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
                    {{ $emp->links() }}
                  </div>
                  
                  
                  
                  <!--<div>
                    @if ($emp->hasPages())
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                            <span>
                                {{-- Previous Page Link --}}
                                @if ($emp->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        {!! __('pagination.previous') !!}
                                    </span>
                                @else
                                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        {!! __('pagination.previous') !!}
                                    </button>
                                @endif
                            </span>

                           
                 
                            <span>
                                {{-- Next Page Link --}}
                                @if ($emp->hasMorePages())
                                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        {!! __('pagination.next') !!}
                                    </button>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        {!! __('pagination.next') !!}
                                    </span>
                                @endif
                            </span>
                        </nav>
                    @endif
                </div>
              -->


                 
               

                  <div class="m-2 p-2"></div>
  </div>





<div>
    <x-jet-dialog-modal wire:model="showingEmployeeModal">
                    
    @if ($isEditMode)
      <x-slot name="title">Update Employee</x-slot>
    @else
      <x-slot name="title">Create New Employee</x-slot>
    @endif  
                    
                      
    <x-slot name="content">
      <div >
        <form enctype="multipart/form-data">

                        
                          <div class="sm:col-span-6">
                            <label for="emp_no" class="block text-sm font-medium text-gray-700"> Employee Number / නිලධාරියාගේ අංකය</label>
                            <div class="mt-1">
                              <input type="text" id="emp_no" wire:model.lazy="emp_no" name="emp_no" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('emp_no') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>


                          <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Name of Employee / නිලධාරියාගේ නම</label>
                            <div class="mt-1">
                              <input type="text" id="title" wire:model.lazy="name" name="name" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>

              
                          



                          

                        <div class="sm:col-span-6">
                            <label for="designation" class="block text-sm font-medium text-gray-700"> Designation / තනතුර</label>
                            <div class="mt-1">
                                <select name="designation"  wire:model.lazy="designation" class=" block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option></option>
                                    
                                    <div class="hidden">
                                      {{
                                        $inst=DB::table("emp_designation")
                                        //->where('institute_id','=',Auth::user()->institute)
                                        ->get()
                                      }}
                                    </div>

                                    @foreach ($inst as $data)
                                    <option  value="{{  $data->id }}">{{ $data->designation }}</option>
                                    @endforeach

                               
                                </select>
                            </div>
                            @error('designation') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
        </form>
      </div>
    </x-slot>


    <x-slot name="footer">              
      @if ($isEditMode)
        <x-jet-button wire:click="editEmpl"  class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Update</x-jet-button>
      @else
        <x-jet-button wire:click="storeEmployee({{Auth::user()->institute}})"  class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Create</x-jet-button>
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
          <label for="designation" class="block text-xl font-medium text-gray-700"> Are you sure you want to delete this record?</label>  
        </div>

        <input type="text" id="deleteID" wire:model.lazy="deleteID" name="deleteID" class="hidden block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
    
        <div class="text-center p-6 "> 
          <x-jet-button wire:click="DeleteModal" class="bg-black-300 hover:bg-red-500">Yes</x-jet-button>        
          <x-jet-button wire:click="HideDeleteModal" >No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer"></x-slot>
  </x-jet-dialog-modal>
</div>


<div>

  