<div >
<div class='mb-3 flex flex-col items-center'>
        <button wire:loading disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
            </svg>
            Processing ...
        </button>
        </div>
<div style="max-width: 48rem;" class="max-w-lg mx-auto grid grid-cols-3 gap-3">     
    <label for="simple-search" class="sr-only">Search</label>
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M6 10c0-3.314 2.686-6 6-6s6 6 6 6-2.686 6-6 6-6-2.686-6-6z" />
                </svg>
            </div>
            <input autocomplete="off" wire:model="title" wire:keyup.debounce.200ms="updateTitle" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search publication name..." required>
            @if(!empty($searchResults))
                <div class="absolute z-10 mt-1 bg-white border border-gray-300 rounded-md shadow-lg w-full">
                    <ul>
                        @foreach($searchResults as $result)
                            <li wire:click="fetchAll('{{ $result->PubId }}', '{{$result->Title }}')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                {{ Str::limit($result->Title, 40) }} ({{$result->edition->Name??''}} )
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <input wire:model="date" type="date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" max="{{date('Y-m-d') }}" required>

        <button wire:click="getarticle" type="button" class="ml-2 flex-shrink-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <span>Search</span>
        </button>
</div>
<div class="p-5 mx-auto">
    @if($this->Results)
<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <th scope="col" class="px-6 py-3">
                    Sno
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Publication
                </th>
                <th scope="col" class="px-6 py-3">
                    Publication Edition
                </th>
                <th scope="col" class="px-6 py-3">
                    Publication Date
                </th>
              
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
              
            </tr>
        </thead>
        <tbody>
            @foreach($this->Results as $result)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">                          
            <td class="px-6 py-2 ">{{ $loop->iteration }}</td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <a wire:click="" href="javascript:void(0);">{{$result->headline}}</a> 
             
            <td class="px-6 py-2">{{$result->publication}}</td>  
             <td class="px-6 py-2 ">{{$result->city}}</td>  
             <td class="px-6 py-2 ">{{$result->pubdate}}</td>  
             <td class="px-6 py-2"><a class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href="{{route('viewarticle',[$result->articleid,$result->pubid])}}" class="">View</a></td>  
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif 
    </div>
</div>
