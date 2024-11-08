<div id="deleterss" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 mx-auto z-50 justify-center items-center w-11/12">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-full h-full md:h-auto">

        <button onclick="hidemodal('deleterss')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="regenetare">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <h2 class="text-lg font-semibold mb-4">
            Delete Rss Feeds</h2>
            <form id="deleterssfrom" method="POST" action="{{ route('getSelectedRssFeeds') }}">
            <input type="hidden" name="clientid" value="{{ $clientid }}">
            @csrf 
            <div class="mb-4">
                <label for="rssname" class="block text-sm font-medium text-gray-700">Enter Search Criteria:</label>
               <div class="gap-2 flex">
               <input type="text" autocomplete="off" id="rssname" name="rssname" class="mt-1 block w-1/2 border border-gray-300 rounded-md" required>
               <button type="submit" class="mt-1 bg-indigo-700 hover:bg-indigo-500 text-white text-xs py-2 px-6 rounded">Search</button>
               </div>
            </div>
           
        </form>
        <div id="resultsrss" style="gap: 2rem;" class="mt-4 grid grid-cols-1">
        <fieldset class="feeds border border-gray-300 hidden">
        <legend class="text-lg font-semibold">RSS Feeds</legend>
        <div class="max-h-[300px] overflow-y-auto">
            <div class="flex border-b font-semibold bg-gray-200">
                <div class="w-1/7 px-2 py-2">Select</div>
                <div class="w-2/6 px-4 py-2">Website/RSS Name</div>
                <div class="w-3/6 px-4 py-2">URL</div>
            </div>
            <div id="resultsfeeds">
        
            </div>
        </div>
    </fieldset>
    <div class="saversss flex justify-center mt-4 hidden">
            <button type="button" id="deleterssSaveButton" class="bg-green-500 hover:bg-green-700 text-white text-xs py-2 px-6 rounded">Delete</button>
        </div>
        </div>
    </div>

</div>