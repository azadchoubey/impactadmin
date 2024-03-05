<div>
<div class='mt-3 flex flex-col items-center'>
        <button wire:loading disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
            </svg>
            Processing ...
        </button>
        </div>
@if(!$pubshow)
<div class="p-6 shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div>
        <label for="table-search" >Page </label>
            <select wire:model.live="page" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="100">100</option>

            </select>
        </div>
        <a href="{{route('createpub')}}" wire:navigate class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Publication</a>

        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="title" type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for Publication">

        </div>

    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Edition
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
              
            </tr>
        </thead>
        <tbody>
            @foreach($Results as $result)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">                          
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <a wire:click="fetchAll('{{ $result->PubId }}')" href="javascript:void(0);">{{$result->Title}}</a> 
          
                <td class="px-6 py-4">
                    <div class="flex items-center">
                       {{$result->edition->Name}}
                    </div>
                </td>        
                <td class="px-6 py-4">
                    <div class="flex items-center">
                    <a wire:navigate href="{{route('editpublication',$result->PubId )}}" class="mr-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                    <button type="button"  class="bg-red-800 text-white px-4 py-2 rounded hover:bg-blue-600">Delete</button>

                    </div>
                </td>        
            </tr>
            @endforeach
        </tbody>
    </table>

</div>



    @else
    <form wire:submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 p-4">
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-3">

                <div class="mb-2">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="title" type="text"  disabled id="name" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>
                <div class="mb-2" x-data="{isTyped: false}">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Publication</label>
                    <input wire:model="pubid" type="text"  disabled class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="address1" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 1</label>
                    <input wire:model="address1" type="text"  disabled class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="edition" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Edition</label>
                    <input wire:model="edition" type="text"  disabled id="edition" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="address2" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 2</label>
                    <input wire:model="address2" type="text"  disabled id="address2" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="category" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Category</label>
                    <input wire:model="category" type="text"  disabled id="category" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="address3" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 3</label>
                    <input wire:model="address3" type="text"  disabled id="address3" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="type" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Type</label>
                    <input wire:model="type" type="text"  disabled id="type" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="city" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">City</label>
                    <input wire:model="city" type="text"  disabled id="city" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="region" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Region</label>
                    <input wire:model="region" type="text"  disabled id="region" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="state" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">State</label>
                    <input wire:model="state" type="text"  disabled id="state" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="language" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Language</label>
                    <input wire:model="language" type="text"  disabled id="language" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="country" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Country</label>
                    <input wire:model="country" type="text"  disabled id="country" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Phone No.</label>
                    <input wire:model="phone" type="text"  disabled id="phone" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <input disabled wire:model="domestic" {{$domestic == 1 ?"checked":''}} class="text" value="{{$domestic}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Domestic</span>
                    <input disabled wire:model="international" {{$international == 0 ?"":'checked'}} class="text" value="{{$international}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">International</span>
                    <br>
                    <input disabled wire:model="primary" {{$primary == 1 ? "checked" : ''}} class="text" value="{{$primary}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Primary</span>
                    <input  wire:model="restrictedmu" {{$restrictedmu == 1 ?"checked":''}} class="text" value="{{$restrictedmu}}" type="checkbox"style="margin-left: 10px;">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Restricted MU</span>
                    <br>
                    <input  wire:model="mu" {{$mu == 1 ?"checked":''}} class="text" value="{{$mu}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">MU</span>
                </div>
                <div class="mb-4">
                    <label for="pagename" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Page Name</label>
                    @if(!empty($pagenames))
                    @foreach($pagenames as $pagename)
                    <div class="flex items-center space-x-2 mb-2">
                        <input disabled wire:model="pagenames.{{$pagename['PageNameID']}}" type="checkbox" class="text gap-4" {{$pagename['IsPre']?"checked":''}} value="{{$pagename['PageNameID']}}"> <span class="gap-2">{{$pagename['Name']}}</span>
                    </div>
                    @endforeach
                    @endif

                </div>

                <div class="mb-4">
                    <label for="Masthead" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Mast Head File</label>
                    <input disabled type="{{$masthead?'text':'file'}}" {{$masthead?'disabled':''}} wire:model="masthead" class="text" />
                </div>
                <div class="col-span-2 mt-4">
                <a wire:navigate href="{{route('editpublication',$this->pubid )}}" class="mr-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>

                </div>
            </div>
        </div>
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="circulation" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Circulation</label>
                    <input wire:model="circulation" type="text"  disabled id="circulation" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="issn" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">ISSN</label>
                    <input wire:model="issn" type="text"  disabled id="issn" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="frequency" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Frequency</label>
                    <input wire:model="frequency" type="text"  disabled id="frequency" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="website" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Website</label>
                    <input wire:model="website" type="text"  disabled id="website" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="size" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Size</label>
                    <input wire:model="size" type="text"  disabled id="size" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

            </div>
            <fieldset class="border border-gray-300 p-3 rounded-lg">
                <legend class="text-lg text-gray-700 mb-4">Rates</legend>

                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-sm font-medium text-gray-700 p-2">Premium</th>
                            <th class="text-sm font-medium text-gray-700 p-2">Non-Premium</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="flex items-center ">
                                <label class=" block text-sm font-medium text-gray-700 gap-2">Color </label>

                                <input type="text"  disabled wire:model="RatePC" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                            <td class="">
                                <input type="text"  disabled wire:model="RateNC" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-center">
                                <label class="block text-sm font-medium text-gray-700 mb-2 gap-3">B&W</label>
                                <input type="text"  disabled wire:model="RatePB" class="text border border-gray-300 p-2 rounded w-full">

                            </td>
                            <td class="">
                                <input type="text"  disabled wire:model="RateNB" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

        </div>

    </form>
    @endif
    

</div>