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
                        <div id="autocomplete-list1" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg" style="display: none;">
                            <!-- Autocomplete list -->
                            <datalist id="filter">
                             
                            </datalist>
                        </div>
                      
                    </div>

                    <!-- Dropdown for filter string -->
                    <div>
                        <label for="filterString" class="block text-sm font-medium text-gray-700">Filter String:</label>
                        <input type="text" id="filterStringinput"  list="filterString" autocomplete="off" name="filterString" placeholder="" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                            <option value="{{ $keywordtype->ID }}">{{ $keywordtype->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <!-- Dropdown for category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
                        <select id="category" name="category" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @forelse($keywordcategories as $keywordcategory)
                            <option value="{{ $keywordcategory->ID }}">{{ $keywordcategory->Name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <!-- Text box for company string -->
                    <div>
                        <label for="companyString" class="block text-sm font-medium text-gray-700">Company String:</label>
                        <input type="text" id="companyString" autocomplete="off" name="companyString" placeholder="Enter company string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Text box for brand string -->
                    <div>
                        <label for="brandString" class="block text-sm font-medium text-gray-700">Brand String:</label>
                        <input type="text" id="brandString" autocomplete="off" name="brandString" placeholder="Enter brand string..." class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
@section('scripts')
<script>
    // Define the fetchResults function
    function fetchResults() {
        const keyword = $('#keyword').val().trim();
        const autocompleteList = $('#autocomplete-list');
        const resultsList = $('#results-list');

        if (keyword.length > 2) {
            // Make an AJAX request to fetch autocomplete results
            $.ajax({
                url: '/api/keywordlist',
                method: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    resultsList.empty(); // Clear previous results
                    if (response.length > 0) {
                        $.each(response, function(index, result) {
                            const li = $('<li>').text(result.KeyWord);

                            li.css('padding', '8px')
                            li.on('click', function() {
                                selectResult(result.KeyWord);
                            });
                            resultsList.append(li);
                        });
                        autocompleteList.show(); // Show autocomplete list
                    } else {
                        autocompleteList.hide(); // Hide autocomplete list if no results
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching results:', error);
                }
            });
        } else {
            autocompleteList.hide(); // Hide autocomplete list if keyword length is less than 3
        }
    }

    // Define the selectResult function
    function selectResult(keyword) {
        $('#keyword').val(keyword);
        $('#autocomplete-list').hide();
        $.ajax({
            url: '/api/filter-strings',
            method: 'GET',
            data: {
                keyword: keyword
            },
            success: function(response) {
                // Populate the filter string dropdown
                const filterStringDropdown = $('#filterString');
                const filter = $('#filter');
                filterStringDropdown.empty();
                filter.empty();
                if (response.length > 0) {
                    $.each(response, function(index, filterString) {
                        const option = $('<option>').val(filterString.Filter_String).text(filterString.Filter_String);
                        const option1 = $('<option>').val(filterString.filter).text(filterString.filter);
                        filterStringDropdown.append(option);
                        filter.append(option1);
                    });
                } else {
                    // If no filter strings found, disable the dropdown
                    filterStringDropdown.prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching filter strings:', error);
            }
        });
    }

    // Attach the fetchResults function to the input field's input event
    $('#keyword').on('input', fetchResults);

    $(document).ready(function() {
        // console.log('Save button clicked'); // Check if this message appears in the console

        // Handle "Save" button click
        $('#saveKeywordBtn').click(function() {
            // Gather form data
            const keyword = $('#keyword').val();
            const filter = $('#filterinput').val();
            const filterString = $('#filterStringinput').val();
            const type = $('#type').val();
            const category = $('#category').val();
            const companyString = $('#companyString').val();
            const brandString = $('#brandString').val();

            // Send AJAX request to save the keyword
            $.ajax({
                url: '/save-keyword',
                method: 'POST',
                data: {
                    keyword: keyword,
                    filter: filter,
                    filterString: filterString,
                    type: type,
                    category: category,
                    companyString: companyString,
                    brandString: brandString,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Optionally, you can show a success message or redirect the user
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error saving keyword:', error);
                    // Optionally, you can show an error message to the user
                }
            });
        });
    });
</script>
@endsection