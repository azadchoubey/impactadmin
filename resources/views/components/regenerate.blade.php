<div id="regenetare" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 mx-auto z-50 justify-center items-center w-11/12">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-full h-full md:h-auto">
   
    <button onclick="hidemodal('regenetare')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="regenetare">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        <h2 class="text-lg font-semibold mb-4">
        Select the Websites/Feeds you wnat to track:</h2>
     <form id="regenerateForm">
        <input type="hidden" name="clientid" value="{{ $clientid }}">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" onclick="getContries()" >By Country of orign </button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false" >By Category</button>
        </li>
     {{--   <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false" >By Industry</button>
        </li> 
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false" >By Focus</button>
        </li> --}} 
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="media-styled-tab" data-tabs-target="#styled-media" type="button" role="tab" aria-controls="media" aria-selected="false"  >By Media Type</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="audience-styled-tab" data-tabs-target="#styled-audience" type="button" role="tab" aria-controls="audience" aria-selected="false" >By Audience Type Focus</button>
        </li>
        {{--
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="audienceage-styled-tab" data-tabs-target="#styled-audienceage" type="button" role="tab" aria-controls="audienceage" aria-selected="false" >By Audience Age Focus</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="regional-styled-tab" data-tabs-target="#styled-regional" type="button" role="tab" aria-controls="regional" aria-selected="false" >By Regional Focus</button>
        </li> --}}
    </ul>
</div>
<div id="default-styled-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-all" class="h-4 w-4 text-blue-600 text-xs border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700">Select All</span>
        </label>
    </div>
    <div id="country-checkboxes" class="grid grid-cols-2 gap-4"></div>
</div>

</div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-catall" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700">Select All</span>
        </label>
    </div>
    <div id="category-checkboxes" class="grid grid-cols-2 gap-4"></div>
</div>

    </div>
    {{--     <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-indall" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="industry-checkboxes" class="grid grid-cols-2 gap-4"></div>
</div>

</div>

    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-focus-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="focus-checkboxes" class="grid grid-cols-2 gap-4"></div>
    </div>
</div>  --}}

    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-media" role="tabpanel" aria-labelledby="media-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-media-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="media-checkboxes" class="grid grid-cols-2 gap-4"></div>
    </div>
</div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-audience" role="tabpanel" aria-labelledby="audience-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-audience-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="audience-checkboxes" class="grid grid-cols-2 gap-4"></div>
    </div>
</div>
{{--  <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-audienceage" role="tabpanel" aria-labelledby="audienceage-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-audienceage-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="audienceage-checkboxes" class="grid grid-cols-2 gap-4"></div>
    </div>
</div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-regional" role="tabpanel" aria-labelledby="regional-tab">
    <div class="max-h-64 overflow-y-auto p-4 bg-white rounded-md shadow-md">
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" id="select-regional-all" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-gray-700 text-xs">Select All</span>
        </label>
    </div>
    <div id="regional-checkboxes" class="grid grid-cols-2 gap-4"></div>
    </div>
</div> --}}
</div>
<div class="saverss flex justify-center mt-4">
 
<input type="checkbox" checked="checked" value="1" name="default" id="default" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
<label for="default" class="ml-2 text-gray-700">Make the selected criteria default</label>  
</div>
<div class="saverss flex justify-center mt-4">
 
<button type="submit" id="saveFeedsButton" class="bg-green-500 hover:bg-green-700 text-white text-xs py-2 px-6 rounded">Save</button>
</div>
</form>
</div>

</div>