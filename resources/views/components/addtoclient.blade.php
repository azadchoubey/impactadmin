<div>
    <div id="large-modal1" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add to client
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal1">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div >
                        <label for="keyword" class="block text-sm font-medium text-gray-700">Keyword:</label>
                        <div>
                            <input type="text" id="keyword" autocomplete="off" name="keyword" placeholder="Type to search..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           <div id="error-messages">
                           <div id="keyid-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                           <div id="clientids-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                           <div id="error-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                           </div>

                            <div id="autocomplete-list" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                                <!-- Autocomplete list -->
                                <ul id="results-list"></ul>
                                <input type="hidden" name="keywordid" id="keywordid">
                            </div>
                        </div>
                    </div>
                    <div class="p-4 md:p-5 space-y-4">

                        <table id="clientsTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Select</th>
                                    <th scope="col" class="px-6 py-3" >ClientID</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                </tr>
                            </thead>
                            <tbody >
                            </tbody>
                        </table>
                    </div>


                    <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button onclick="saveArticle()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>