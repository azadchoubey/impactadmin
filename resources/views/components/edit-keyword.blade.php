<div>
    
    <div id="large-modal{{$keyword->keyID}}" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-2/5 max-w-5xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                       Edit Client keyword
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal{{$keyword->keyID}}">
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
                            <input type="text" value="{{$keyword->KeyWord}}" id="keyword{{$keyword->keyID}}" autocomplete="off" name="keyword" placeholder="Type to search..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <div id="keyword{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            <div id="autocomplete-list{{$keyword->keyID}}" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                                <!-- Autocomplete list -->
                                <ul id="results-list{{$keyword->keyID}}"></ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown for filter -->
                    <div>
                        <label for="filter" class="block text-sm font-medium text-gray-700">Filter:</label>
                        <input type="text" id="filterinput{{$keyword->keyID}}" value="{{$keyword->Filter}}" list="filter" autocomplete="off" name="filter" placeholder="" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="filter{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        <div id="autocomplete-list{{$keyword->keyID}}" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
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
                        <input type="text" id="filterStringinput{{$keyword->keyID}}" value="{{$keyword->Filter_String}}"  list="filterString" autocomplete="off" name="filterString" placeholder="" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="filterString{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        <div id="autocomplete-list{{$keyword->keyID}}" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                            <!-- Autocomplete list -->
                            <datalist id="filterString{{$keyword->keyID}}">
                             
                            </datalist>
                        </div>
                      
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type:</label>
                        <select id="type{{$keyword->keyID}}" name="type" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @forelse($keywordtypes as $keywordtype)
                            <option {{$keyword->Type == $keywordtype->Name ? 'selected' : ''}} value="{{ $keywordtype->Name }}">{{ $keywordtype->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                        <div id="type{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Dropdown for category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
                        <select id="category{{$keyword->keyID}}" name="category" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @forelse($keywordcategories as $keywordcategory)
                            <option {{$keyword->Category == $keywordcategory->Name ? 'selected' : ''}} value="{{ $keywordcategory->Name }}">{{ $keywordcategory->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                        <div id="category{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Text box for company string -->
                    <div>
                        <label for="companyString" class="block text-sm font-medium text-gray-700">Company String:</label>
                        <input value="{{$keyword->CompanyS}}" type="text" id="companyString{{$keyword->keyID}}" autocomplete="off" name="companyString" placeholder="Enter company string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="companyString{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>

                    <!-- Text box for brand string -->
                    <div>
                        <label for="brandString" class="block text-sm font-medium text-gray-700">Brand String:</label>
                        <input value="{{$keyword->BrandS}}" type="text" id="brandString{{$keyword->keyID}}" autocomplete="off" name="brandString" placeholder="Enter brand string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div id="brandString{{$keyword->keyID}}-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                    </div>
                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="saveKeywordBtn({{$keyword->keyID}})" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
