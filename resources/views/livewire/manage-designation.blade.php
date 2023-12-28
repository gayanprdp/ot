

<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}
 

  <div class="grid grid-cols-2 p-4 bg-white" >
    <div>
      <h2 class="font-semibold text-xl text-sky-700 leading-tight">
      {{ __('Manage Designations') }}
    </h2>

        <div aligne="left" class=" py-3 text-left text-sky-700 dark:text-gray-300 uppercase tracking-wider"> 
                    @if (Auth::user()->user_level!=1)
                      @foreach ($ins as $item1)                        
                          <!--<td class="px-6 py-4 whitespace-nowrap">{{$item1->institute}}</td> -->                       
                      @endforeach
                    @endif
        </div>
    </div>
    <div>
      <div class="flex justify-end m-2 p-2">
          
         <input type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search..." class=" focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 block w-64 text-sky-700 transition duration-150 ease-in-out appearance-none bg-white border border-sky-700 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
                    
      </div>
      <div class="flex justify-end m-2 p-2"><x-jet-button wire:click="showDesModal"  class="bg-sky-800 hover:bg-sky-600 m-2">Create New Designation </x-jet-button> </div>
      

    </div>
  </div>

  <div class="max-w mx-auto px-3 ">

                  


                
  
  
                  <table  class="w-full divide-y divide-sky-700">
                    <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
                    <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
                      
                      <tr>
                        <th  scope="col" class="relative px-6 py-3 text-white">Index</th>
                        <th rowspan="2" scope="col" class="relative px-6 py-3   text-white">Designation</br> තනතුර</th>
                        @if (Auth::user()->user_level==0)
                          <th scope="col" class="relative px-6 py-3  w-1/2 text-white">Institute</br>ආයතනය </th>
                        @endif
                        <th colspan="3" scope="col" class="relative px-6 py-3 text-white">OT Hours can Approve / අනුමත කල හැකි පැය ගනන</th>
                        <th  rowspan="2" scope="col" class="relative px-6 py-3 text-white">Action</th>
                      </tr>
                      
                      <tr>
                        <th scope="col" class="relative px-6 py-3 text-white"></th>
                        @if (Auth::user()->user_level==0)
                          <th scope="col" class="relative px-6 py-3  w-1/2 text-white">Institute</br>ආයතනය </th>
                        @endif
                        <th scope="col" class="relative px-6 py-3 text-white">Director / අධ්‍යක්ෂ </th>
                        <th scope="col" class="relative px-6 py-3 text-white">Director -Admin / අධ්‍යක්ෂ පාලන </th>
                        <th scope="col" class="relative px-6 py-3 text-white">ADG / අතිරේක අධ්‍යක්ෂ ජනරාල් </th>
                        
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-500">
                      <tr></tr>
                      
                      
                                                  
                    @foreach ($des as $key =>$item)
                                            
                      <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$des->firstItem()+$key}}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-left">{{$item->designation1}}</td>
                      @if (Auth::user()->user_level==0)
                        <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-left">{{$item->institute_code}} - {{$item->institute}}</td>
                      @endif
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-center">{{$item->OT_range1}}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-center">{{$item->OT_range2}}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800 text-center">{{$item->OT_range3}}</td>
                      
  
  
                          
                      <td class="px-6 py-4 text-right text-sm text-sky-800">
                       
                        
                        
                        <!--
                        @if($confirming===$item->id)
                        
                        <x-jet-button class="bg-red-400 hover:bg-red-500" wire:click="kill({{ $item->id }})">Sure?</x-jet-button>
                        @else
                        
                        <x-jet-button class="bg-red-400 hover:bg-red-500" wire:click="confirmDelete({{ $item->id }})">Delete</x-jet-button> 
                        @endif
                        -->

                        @if ($item->empdes == null)  
                        <x-jet-button class="bg-sky-800 hover:bg-red-700 border border-white w-20 text-center" wire:click="ShowDeleteModal({{ $item->id }})">Delete</x-jet-button> 
                        @endif
                        <x-jet-button class="bg-sky-800 hover:bg-sky-600 border border-white w-20 text-center" wire:click="showEditDesModel({{$item->id}})">Edit</x-jet-button>

                      </td>
                      </tr>
                    
                    @endforeach
  
                      
  
                      <!-- More items... -->
                    </tbody>
                  </table>
                  <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
                    {{ $des->links() }}
                  </div>
                  <div class="m-2 p-2"></div>
                
  </div>              

  
<div>
  <x-jet-dialog-modal wire:model="showingDesModal" >
                
           
            @if ($isEditMode)
            <x-slot name="title">Update Designation</x-slot>
            @else
            <x-slot name="title">Create New Designation</x-slot>
            @endif  
                
                   
                

            
            <x-slot name="content">
                <div >
                    <form enctype="multipart/form-data">

                      <div class="sm:col-span-6">
                        <label for="designation" class="block text-sm font-medium text-sky-800"> Designation / තනතුර</label>
                        <div class="mt-1">
                          <input type="text" id="designation" wire:model.lazy="designation" name="designation" class="block text-sky-800  border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 w-full  appearance-none bg-white border  rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('designation') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="approved_OT_hours" class="block text-sm font-medium text-sky-800 py-4">OT Hours can Approve / අනුමත කල හැකි පැය ගනන</label>
                      </div>

                      <div class="sm:col-span-6">
                        <label for="approved_OT_hours" class="block text-sm font-medium text-sky-800"> Director / අධ්‍යක්ෂ </label>
                        <div class="mt-1">
                          <input type="text" id="approved_OT_hours1" wire:model.lazy="approved_OT_hours1" name="approved_OT_hours1" class="block text-sky-800  border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 w-full  appearance-none bg-white border  rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('approved_OT_hours1') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="approved_OT_hours" class="block text-sm font-medium text-sky-800"> Director -Admin / අධ්‍යක්ෂ පාලන </label>
                        <div class="mt-1">
                          <input type="text" id="approved_OT_hours2" wire:model.lazy="approved_OT_hours2" name="approved_OT_hours2" class="block text-sky-800  border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 w-full  appearance-none bg-white border  rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('approved_OT_hours2') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="approved_OT_hours" class="block text-sm font-medium text-sky-800"> ADG / අතිරේක අධ්‍යක්ෂ ජනරාල් </label>
                        <div class="mt-1">
                          <input type="text" id="approved_OT_hours3" wire:model.lazy="approved_OT_hours3" name="approved_OT_hours3" class="block text-sky-800  border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 w-full  appearance-none bg-white border  rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('approved_OT_hours3') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      
                    
                    </form>
                  </div>
                  


            </x-slot>
            <x-slot name="footer">
                
                @if ($isEditMode)
                <x-jet-button wire:click="editDes" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Update</x-jet-button>
                @else
                <x-jet-button wire:click="storeDes({{Auth::user()->institute}})" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Create</x-jet-button>
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
          <x-jet-button wire:click="HideDeleteModal" class="bg-sky-800 hover:bg-sky-500">No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer"></x-slot>
  </x-jet-dialog-modal>
</div>



</div>
