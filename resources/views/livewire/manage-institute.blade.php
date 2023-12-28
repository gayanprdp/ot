

<div>
  {{-- If your happiness depends on money, you will never be happy with yourself. --}}



    <div class="grid grid-cols-2 p-3 bg-white" >

      <div>
        <h2 class="font-semibold text-xl text-sky-800 leading-tight">
        {{ __('Manage Institutes') }}
        </h2>
      </div>

      <div>

        <div class="flex justify-end m-2 p-2">
         
          <input data-bs-toggle="tooltip" data-bs-placement="top" title="Search with Institute , Year or Month" type="search" wire:click="gotoPage(1)" wire:model="search" placeholder="Search...  " class="block w-64  transition duration-150 ease-in-out appearance-none bg-white border border-sky-700 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">

        </div>
        <div class="flex justify-end m-2 p-2">
         
          <x-jet-button wire:click="showInsModal"  class="bg-sky-800 hover:bg-sky-700 m-2">Create New Institute </x-jet-button> &nbsp;
          
        </div>
      </div>

    </div>
  <div class="max-w mx-auto px-3 ">

                 
 
 
 
                 <table  class="w-full divide-y divide-sky-700">
                  <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
                  <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
                    <tr>
                       <th scope="col" class="px-6 py-4 whitespace-nowrap text-white w-4">Index</th>
                       <th scope="col" class="px-6 py-4 whitespace-nowrap text-white">Institute Code </br>ආයතන  කේතය</th>
                       <th scope="col" class="px-6 py-4 whitespace-nowrap text-white">Institute </br>ආයතන</th>
                       <th scope="col" class="relative px-6 py-3 text-white">Action</th>
                     </tr>
                   </thead>
                   <tbody class="bg-white divide-y divide-sky-500">
                     <tr></tr>
                     
                     
                                                 
                     @foreach ($ins as $key =>$item)
                                                     
                     <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$ins->firstItem()+$key}}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$item->institute_code}}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sky-800">{{$item->institute}}</td>
                      
 
 
 
 
 
                         
                     <td class="px-6 py-4 text-right text-sm">
                      
                        
                        @if ($item->empdes == null) 
                        <x-jet-button class="bg-sky-800 hover:bg-red-700" wire:click="ShowDeleteModal({{ $item->id }})">Delete</x-jet-button>  
                        @endif
                        <x-jet-button class="bg-sky-800 hover:bg-sky-700" wire:click="subinstitute({{$item->id}})">Sub Institute</x-jet-button>
                        <x-jet-button class="bg-sky-800 hover:bg-sky-700" wire:click="showEditInsModel({{$item->id}})">Edit</x-jet-button>
                      </td>
                     </tr>
 
                 @endforeach
 
                     
 
                     <!-- More items... -->
                   </tbody>
                 </table>
                 <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
                  {{ $ins->links() }}
                 </div>
                 <div class="m-2 p-2"></div>
             
  </div>              







     

<div>
<x-jet-dialog-modal wire:model="showingInsModal">
              
         
          @if ($isEditMode)
          <x-slot name="title">Update Institute</x-slot>
          @else
          <x-slot name="title">Create New Institute</x-slot>
          @endif  
              
                 
              

          
          <x-slot name="content">
              <div >
                  <form enctype="multipart/form-data">

                    <div class="sm:col-span-6">
                      <label for="institute_code" class="block text-sm font-medium text-sky-800"> Institute Code / ආයතන  කේතය </label>
                      <div class="mt-1">
                        <input type="text" id="institute_code" wire:model.lazy="institute_code" name="name" class="block text-sky-800 w-full   appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                      </div>
                      @error('institute_code') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-6">
                      <label for="institute" class="block text-sm font-medium text-sky-800"> Institute / ආයතනය  </label>
                      <div class="mt-1">
                        <input type="text" id="institute" wire:model.lazy="institute" name="institute" class="block text-sky-800 w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 border-sky-700 focus:border-sky-400 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                      </div>
                      @error('institute') <span class="text-red-400">{{ $message }}</span> @enderror
                    </div>
         
                    
                  </form>
                </div>
                


          </x-slot>
          <x-slot name="footer">
              
              @if ($isEditMode)
              <x-jet-button wire:click="editIns" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Update</x-jet-button>
              @else
              <x-jet-button wire:click="storeIns" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Create</x-jet-button>
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

        
        <div class="text-center p-6 "> 
          <x-jet-button wire:click="DeleteModal" class="bg-sky-700 hover:bg-red-500">Yes</x-jet-button>        
          <x-jet-button wire:click="HideDeleteModal" class="bg-sky-700 hover:bg-sky-600">No</x-jet-button>
        </div>

      </x-slot>
      
      <x-slot name="footer"></x-slot>
  </x-jet-dialog-modal>
</div>

</div>