




<div>
  
  <div class="m-3 p-1">

        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                <div aligne="left" class="px-6 py-3 text-left text-gray-600 dark:text-gray-300 uppercase tracking-wider">User Management </div>


                <div class="flex justify-end m-2 p-2">
        
                  <x-jet-button wire:click="showUserModal" class="bg-sky-800 hover:bg-sky-700 m-2">Create New User </x-jet-button> &nbsp;
                  <input type="search" wire:model="search" wire:click="gotoPage(1)" placeholder="Search..." class="block  transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                </div>


                <table  class="w-full divide-y divide-sky-700">
                  <div class="bg-sky-800 text-sky-800 dark:bg-gray-600 dark:text-gray-200 rounded-tl-lg rounded-tr-lg h-2">.  </div>
                  <thead class="bg-sky-800 dark:bg-gray-600 dark:text-gray-200">
                    <tr>
                      <th scope="col" class="relative px-6 py-3 text-white">Index</th>
                      <th scope="col" class="relative px-6 py-3 text-white">Name /  නම</th>
                      <th scope="col" class="relative px-6 py-3 text-white">Designation / තනතුර</th>
                      <th scope="col" class="relative px-6 py-3 text-white">User Level</th>
                      <th scope="col" class="relative px-6 py-3 text-white">Institute / ආයතනය</th>
                      <th scope="col" class="relative px-6 py-3 text-white">Edit</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    
                    
                                                
                    @foreach ($users as $key=>$item)
                                                    
                    <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{$users->firstItem()+$key}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$item->name}}</td>
                      @foreach (\App\Models\user_designations::where('id', '=',$item->designation_id)->get() as $data)
                          <td class="px-6 py-4 whitespace-nowrap">{{$data->designation}}</td>
                      @endforeach              
                    <td class="px-6 py-4 whitespace-nowrap">Level - {{$item->user_level}}</td>

                      @foreach (\App\Models\institute::where('id', '=',$item->institute)->get() as $data)
                        <td class="px-6 py-4 whitespace-nowrap">{{$data->institute_code}} - {{$data->institute}}
                          @if ($data->main_institute<>0)
                            <p class="text-orange-700"> (Sub Institute of
                            @foreach (\App\Models\institute::where('id', '=',$data->main_institute)->get() as $data1)
                              {{$data1->institute_code}}
                            @endforeach
                            )
                            </p>
                          @endif
                        </td>
                      @endforeach 


                    

                        
                    <td class="px-6 py-4 text-right text-sm">
                     
                      <x-jet-button class="bg-sky-800 hover:bg-sky-700" wire:click="showEditUserModel({{$item->id}})">Edit</x-jet-button>
                      <x-jet-button class="bg-sky-800 hover:bg-red-700"  wire:click="ShowDeleteModal({{ $item->id }})">Delete</x-jet-button>
                    </td>
                    </tr>

                @endforeach

                    

                    <!-- More items... -->
                  </tbody>
                </table>
                <div class="px-3 py-3 bg-sky-800 text-2xl rounded-bl-lg rounded-br-lg">
                  {{ $users->links() }}
                </div>
                <div class="m-2 p-2"></div>
              </div>
            </div>
          </div>              
    </div>






    <div>
        <x-jet-dialog-modal wire:model="showingUserModal">
                
           
            @if ($isEditMode)
            <x-slot name="title">Update User</x-slot>
            @else
            <x-slot name="title">Create New User</x-slot>
            @endif  
                
                   
                

            
            <x-slot name="content">
                <div >
                    <form enctype="multipart/form-data">

                      <div class="sm:col-span-6">
                        <label for="title" class="block text-sm font-medium text-gray-700"> Name </label>
                        <div class="mt-1">
                          <input type="text" id="title" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                        @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="title" class="block text-sm font-medium text-gray-700"> Designation </label>
                        <div class="mt-1">
                          <select name="designation" wire:model.lazy="designation" class="block mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option></option>
                            @foreach (\App\Models\user_designations::orderBy('designation', 'ASC')->get() as $data)
                              <option value="{{  $data->id }}">{{ $data->designation }}</option>
                            @endforeach
                        </select>

                        </div>
                        @error('designation') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      

                      


                     
                          <div id='signaturediv' class="sm:col-span-6 ">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Upload Signature </label>
                            
                            @if ($newImage)
                            Preview:
                            <img src="{{ $newImage->temporaryUrl() }}">
                            @endif

                            <div class="mt-1 ">
                              <input type="file"  id="image" wire:model="newImage" name="image" class=" block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('newImage') <span class="text-red-400">{{ $message }}</span> @enderror
                          </div>
                     

                      

                      <div class="sm:col-span-6">
                        <label for="Email" class="block text-sm font-medium text-gray-700"> Email </label>
                        <div class="mt-1">
                          <input type="Email" id="Email" wire:model.lazy="Email" name="Email" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                        @error('Email') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="institute" class="block text-sm font-medium text-gray-700"> Institute </label>
                        <div class="mt-1">
                            <select name="institute" wire:model.lazy="institute" class="block mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option></option>
                            @foreach (\App\Models\institute::orderBy('institute_code', 'ASC')->get() as $data)
                            <option value="{{  $data->id }}"
                        
                            >{{ $data->institute_code." - ". $data->institute }}</option>
                            @endforeach
                            </select>
                        </div>
                        @error('institute') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>



                      

                    <div class="sm:col-span-6">
                        <label for="user_level" class="block text-sm font-medium text-gray-700"> User Level </label>
                        <div class="mt-1">
                            <select name="user_level"  wire:model.lazy="user_level"  class=" block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option></option>
                            @foreach (\App\Models\user_level::all() as $data)
                                <option value="{{  $data->user_level }}"
                                
                            >Level {{  $data->user_level }} - {{ $data->designation }}</option>
                            @endforeach
                            </select>
                        </div>
                        @error('user_level') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      
                     


                   


                      




                      <div class="sm:col-span-6">
                        <label for="title" class="block text-sm font-medium text-gray-700"> Password </label>
                        <div class="mt-1">
                          <input type="password" id="Password" wire:model.lazy="Password" name="Password" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('Password') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>

                      <div class="sm:col-span-6">
                        <label for="ConfirmPassword" class="block text-sm font-medium text-gray-700"> Confirm Password </label>
                        <div class="mt-1">
                          <input type="password" id="ConfirmPassword" wire:model.lazy="ConfirmPassword" name="ConfirmPassword" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('ConfirmPassword') <span class="text-red-400">{{ $message }}</span> @enderror
                      </div>
                     
                        
                      
                    </form>
                  </div>
                  


            </x-slot>
            <x-slot name="footer">
                
                @if ($isEditMode)
                <x-jet-button wire:click="editUser" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Update</x-jet-button>
                @else
                <x-jet-button wire:click="storeUser" class="bg-sky-800 hover:bg-sky-600 border border-white w-28 justify-center">Create</x-jet-button>
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


</div>

