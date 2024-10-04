<div>
    <div class="w-11/12 mx-auto p-8">
        <table id="clientwebuniverse" class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="width: 100% !important;">
            <thead>
            <tr>
            <th scope="col" class="px-6 py-3">Website Name</th>
            <th scope="col" class="px-6 py-3">Rss Name</th>
            <th scope="col" class="px-6 py-3">Country</th>
            <th scope="col" class="px-6 py-3">Category</th>
            <th scope="col" class="px-6 py-3">Type</th>
            <th scope="col" class="px-6 py-3">Focus</th>
            <th scope="col" class="px-6 py-3">Industry Focus</th>
            <th scope="col" class="px-6 py-3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rssFeeds as $item)
                <tr>
                    <td  class="px-6 py-4">{{$item->websitename}}</td>
                    <td  class="px-6 py-4">{{$item->rssname}}</td>
                    <td  class="px-6 py-4">{{$item->country}}</td>
                    <td  class="px-6 py-4">{{$item->category}}</td>
                    <td  class="px-6 py-4">{{$item->type}}</td>
                    <td  class="px-6 py-4">{{$item->focus}}</td>
                    <td  class="px-6 py-4">{{$item->industryfocus}}</td>
                    
                    <td  class="px-6 py-4"><button class="bg-red-500 hover:bg-red-700 text-white text-xs py-1 px-2 rounded" >Delete</button>
                    </td>

                </tr>
            @endforeach
        </table>
        {{-- $rssFeeds->appends(request()->query())->links('vendor.pagination.tailwind') --}}

    </div>
    <div id="addclientwebuniverse" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 mx-auto z-50 justify-center items-center w-11/12">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-full h-full md:h-auto">
    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addclientwebuniverse">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        <h2 class="text-lg font-semibold mb-4">Add More Rssfeeds:</h2>
        <form id="address" method="POST" action="{{ route('rssnames') }}">
            @csrf 
            <div class="mb-4">
                <label for="rssname" class="block text-sm font-medium text-gray-700">Enter Search Criteria:</label>
               <div class="gap-2 flex">
               <input type="text" autocomplete="off" id="rssname" name="rssname" class="mt-1 block w-1/2 border border-gray-300 rounded-md" required>
               <button type="submit" class="mt-1 bg-indigo-700 hover:bg-indigo-500 text-white text-xs py-2 px-6 rounded">Search</button>
               </div>
               

            </div>
           
        </form>

        <!-- Results Table -->
        <div id="results" class="saverss mt-4 max-h-[300px] overflow-y-auto hidden">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                    <th class="border px-4 py-2">Select</th>
                    <th class="border px-4 py-2">Website/Rss Name</th>
                        <th class="border px-4 py-2">URL</th>
                    </tr>
                </thead>
                <tbody id="resultsBody">
                </tbody>
            </table>
        </div>
        <div class="saverss flex justify-center mt-4 hidden">
            <button type="button" id="saverssButton" class="bg-green-500 hover:bg-green-700 text-white text-xs py-2 px-6 rounded">Save</button>
        </div>
    </div>

</div>

</div>
