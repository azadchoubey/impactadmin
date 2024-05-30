<div>
    <div id="large-modal1" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Client keyword
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal1">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4 md:p-5 space-y-4">
                    <div>
                        <label for="keyword" class="block text-sm font-medium text-gray-700">Keyword:</label>
                        <div>
                            <input type="text" id="keyword" autocomplete="off" name="keyword" placeholder="Type to search..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <div id="keyword-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            <div id="autocomplete-list" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                                <!-- Autocomplete list -->
                                <ul id="results-list"></ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown for filter -->
                    <div>
                        <label for="filter" class="block text-sm font-medium text-gray-700">Filter:</label>
                        <input type="text" id="filterinput" list="filter" autocomplete="off" name="filter" placeholder="" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="filter-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        <div id="autocomplete-list1" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                            <!-- Autocomplete list -->
                            <datalist id="filter">
                            <option value="Include">
                            <option value="Exclude">
                            </datalist>
                        </div>
                      
                    </div>

                    <!-- Dropdown for filter string -->
                    <div>
                        <label for="filterString" class="block text-sm font-medium text-gray-700">Filter String:</label>
                        <input type="text" id="filterStringinput"  list="filterString" autocomplete="off" name="filterString" placeholder="" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="filterString-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        <div id="autocomplete-list1" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                            <!-- Autocomplete list -->
                            <datalist id="filterString">
                             
                            </datalist>
                        </div>
                      
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type:</label>
                        <select id="type" name="type" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @forelse($keywordtypes as $keywordtype)
                            <option value="{{ $keywordtype->Name }}">{{ $keywordtype->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                        <div id="type-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Dropdown for category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
                        <select id="category" name="category" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @forelse($keywordcategories as $keywordcategory)
                            <option value="{{ $keywordcategory->Name }}">{{ $keywordcategory->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                        <div id="category-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Text box for company string -->
                    <div>
                        <label for="companyString" class="block text-sm font-medium text-gray-700">Company String:</label>
                        <input type="text" id="companyString" autocomplete="off" name="companyString" placeholder="Enter company string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="companyString-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Text box for brand string -->
                    <div>
                        <label for="brandString" class="block text-sm font-medium text-gray-700">Brand String:</label>
                        <input type="text" id="brandString" autocomplete="off" name="brandString" placeholder="Enter brand string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="brandString-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>
                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="saveKeywordBtn" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
