<div class="flex items-center justify-center">
    <div class="grid grid-cols-2 gap-4 max-w-5xl">
        <div class="relative">
            <label for="select_1" class="block text-sm font-medium text-gray-700">Concepts</label>
            <select style="width: 200px;" multiple id="select_1" class="h-48 mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select_2">
                @if(count($getprintissueforclients) == 0)
                <option value="-1"> --No Concepts Defined-- </option>
                @endif
            </select>
            <button id="addOption_1Btn" style="right: 4.25rem;" class="absolute top-1 px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add
            </button>
            <button id="editOption_1Btn" class="absolute top-1 right-2 px-2 py-1 bg-gray-500 text-white text-xs rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

                Edit
            </button>
        </div>
        <div class="relative">
            <label for="select_2" class="block text-sm font-medium text-gray-700">Keywords</label>
            <select style="width: 200px;" multiple id="select_2" class="h-48 mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select_2"></select>
            <button id="addOption_2Btn" style="right: 4.25rem;" class="absolute top-1 px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add
            </button>
            <button id="editOption_2Btn" class="absolute top-1 right-2 px-2 py-1 bg-gray-500 text-white text-xs rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

                Edit
            </button>
        </div>
        <div class="col-span-2 flex justify-center mb-9">
            <button id="button_1" class=" bg-blue-500 px-2 py-1 text-white text-xs rounded-md">
                Define Complex Concepts
            </button>
        </div>
    </div>

    <!-- Add Option Modal -->
    <div id="addOptionModal_1" data-visible="false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="addOptionForm_1">
                <input type="hidden" name="datatype" id="data_1">
                <input type="hidden" name="clientid" value="{{$clientid}}">
                <div class="p-4 border-b">
                    <h5 id="header_1" class="text-lg font-medium"></h5>
                    <button type="button" class="addCancelBtn_1 text-gray-500 hover:text-gray-700 float-right">×</button>
                </div>
                <div class="p-4">
                    <label for="newOptionText" class="block text-sm font-medium text-gray-700">Text</label>
                    <input type="text" name="option" id="newOptionText" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="p-4 border-t text-right">
                    <button type="button" class="addCancelBtn_1 px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button type="button" id="saveNewOptionBtn_1" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Option Modal -->
    <div id="editOptionModal_1" data-visible="false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="editOptionForm_1">
                <div class="p-4 border-b">
                    <h5 class="text-lg font-medium">Edit Option</h5>
                    <button type="button" class="editCancelBtn_1 text-gray-500 hover:text-gray-700 float-right">×</button>
                </div>
                <div class="p-4">
                    <label for="editOptionText_1" class="block text-sm font-medium text-gray-700">Edit Option Text</label>
                    <input type="hidden" name="datatype" id="datatype_1">
                    <input type="text" id="editOptionText_1" name="name" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="p-4 border-t text-right">
                    <button type="button" class="editCancelBtn_1 px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button type="button" id="saveEditOptionBtn_1" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>