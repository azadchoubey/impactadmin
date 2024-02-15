<div class="container mx-auto p-6 bg-white rounded-md shadow-md">
@php
        $keywords = $contacts?->keywords()->paginate(50,pageName: 'keywords');
        $contacts = $contacts?->contacts()->paginate(50,pageName: 'contacts');
        
        $cross = '<div>
            <svg class="w-3 h-3 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </div>';
        $check = '<div>
            <svg class="w-3 h-3 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
            </svg>
        </div>';
        @endphp
<div class='mt-3 flex flex-col items-center'>
        <button wire:loading disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
            </svg>
            Processing ...
        </button>
        </div>

    <div class="mt-4">
        <div id="tabs" class="mb-4 border-b border-gray-200 dark:border-gray-700" wire:ignore >
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" wire:click="switchTab('profile')" aria-selected="true">Client Details</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" wire:click="switchTab('dashboard-tab')" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Client Contacts</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" wire:click="switchTab('settings-tab')" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Client Keywords</button>
                </li>
            </ul>
        </div>

        <div id="default-tab-content">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if($activeTab == 'profile')
                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                            <input wire:model="clientID" id="client_id" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="broadcast" class="block text-sm font-medium text-gray-700">Broadcast</label>
                                <div class="flex items-center">
                                    <input type="checkbox" wire:model="broadcastCheckbox" id="broadcastCheckbox" class="mr-2">
                                    <input wire:model="broadcast" id="broadcast" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                            <div>
                                <label for="primary" class="block text-sm font-medium text-gray-700">Primary Client</label>
                                <div class="flex items-center">
                                    <input type="checkbox" wire:model="primaryCheckbox" id="primaryCheckbox" class="mr-2">
                                    <input wire:model="primary" id="primary" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                        

                        <div>
                            <label for="csrsince" class="block text-sm font-medium text-gray-700">Customer Since</label>
                            <input wire:model="csrsince" id="csrsince" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input wire:model="name" id="name" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone No</label>
                            <input wire:model="phone" id="phone" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                            <input wire:model="sector" id="csrsince" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="address1" class="block text-sm font-medium text-gray-700">Address 1</label>
                            <input wire:model="AddressLine1" id="address" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="fax" class="block text-sm font-medium text-gray-700">FAX</label>
                            <input wire:model="fax" id="address" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="subsector" class="block text-sm font-medium text-gray-700">Sub Sector</label>
                            <input wire:model="subsector" id="subsector" type="radio">
                        </div>
                        <div>
                            <label for="address2" class="block text-sm font-medium text-gray-700">Address 2</label>
                            <input wire:model="AddressLine2" id="address" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                            <input wire:model="mobile" id="csrsince" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <br>
                        <div>
                            <label for="address3" class="block text-sm font-medium text-gray-700">Address 3</label>
                            <input wire:model="AddressLine3" id="address" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                      

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input wire:model="email" id="csrsince" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                            <input wire:model="reference" id="subsector" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input wire:model="city" id="city" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                            <input wire:model="contractstart" id="contractstart" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input wire:model="type" id="type" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                 <div>
                                                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                                    <input wire:model="state" id="state" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                                                <div>
                                                    <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
                                                    <input wire:model="pincode" id="pincode" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="contractend" class="block text-sm font-medium text-gray-700">Contract End</label>
                            <input wire:model="contractend" id="contractend" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                       
                        <div>
                            <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                            <input wire:model="billingcycle" id="billingcycle" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="Country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input wire:model="country" id="country" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                            <input wire:model="printstatus" id="printstatus" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                            <input wire:model="billingdate" id="billingcycle" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <input wire:model="currency" id="currency" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                            <input wire:model="region" id="currency" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                            <input wire:model="billingrate" id="billingrate" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700">Client Logo</label>
                            <input wire:model="client" id="client" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                            <input wire:model="webstatus" id="webstatus" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                       
                        
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        <button type="button" id="editbtn"  class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Delete</button>
                        <button type="button" id="editbtn"  class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                        
                    </div>
                </form>
                @endif
          
            </div>
            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton" data-modal-target="large-modal" data-modal-toggle="large-modal" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    @if($activeTab == 'dashboard-tab')
                    <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th scope="col" class="px-6 py-3">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" class="form-checkbox">
                            </th>
                            <th scope="col" class="px-6">Contact Name</th>
                            <th scope="col" class="px-6">Print</th>
                            <th scope="col" class="px-6">Web</th>
                            <th scope="col" class="px-6">Qlikview</th>
                            <th scope="col" class="px-6">Qualify</th>
                            <th scope="col" class="px-6">Alert</th>
                            <th scope="col" class="px-6">Charts</th>
                            <th scope="col" class="px-6">Br</th>
                            <th scope="col" class="px-6">BB</th>
                            <th scope="col" class="px-6">Mobile</th>
                            <th scope="col" class="px-6">Whatsapp</th>
                            <th scope="col" class="px-6">Mediatouch</th>
                            <th scope="col" class="px-6">Dyna</th>
                            <th scope="col" class="px-6">Custom Digest</th>
                            <th scope="col" class="px-6">Regular Web</th>
                            <th scope="col" class="px-6">Regular Print</th>
                            <th scope="col" class="px-6">Action</th>
                        </thead>
                        <tbody>
                        
                            @foreach($contacts as $contact)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <input type="checkbox" onchange="updateEditButtonVisibility()" value="{{$contact->contactid}}" class="form-checkbox checkboxes">
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->ContactName}}</td>
                                @if($this->editing === $contact->contactid)
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforprint" {{ $contact->wm_enableforprint ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforweb"  {{ $contact->wm_enableforweb ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforqlikview"  {{ $contact->enableforqlikview ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enabletoqualify"  {{ $contact->enabletoqualify ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="getcriticalalert"  {{ $contact->getcriticalalert ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforcharts"  {{ $contact->enableforcharts ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbr"  {{ $contact->enableforbr ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbb"  {{ $contact->enableforbb ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformobile"  {{ $contact->enableformobile ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforwhatsapp"  {{ $contact->enableforwhatsapp ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformediatouch"  {{ $contact->enableformediatouch ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enablefordidyounotice"  {{ $contact->enablefordidyounotice ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="delivery"  {{ $contact->delivery->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestWeb"  {{ $contact->regularDigestWeb->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestPrint"  {{ $contact->regularDigestPrint->ID != 0 ? 'checked' : '' }} />
                                </td>
                                <td wire:click="updateClient({{ $contact->contactid }})" class="px-6 py-4"><a href="javascript:void(0);">Update</a></td>
                                @else
                                <td class="px-6 py-4">{!! $contact->wm_enableforprint?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->wm_enableforweb?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableforqlikview?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enabletoqualify?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->getcriticalalert?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableforcharts?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableforbr?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableforbb?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableformobile?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableforwhatsapp?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enableformediatouch?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->enablefordidyounotice?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->delivery->isNotEmpty()?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->regularDigestWeb->isNotEmpty() ?$check:$cross !!}</td>
                                <td class="px-6 py-4">{!! $contact->regularDigestPrint->ID != 0 ?$check:$cross !!}</td>
                                <td wire:click="startEditing({{ $contact->contactid }})" class="px-6 py-4"><a href="javascript:void(0);">Edit</a></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                    {{ $contacts->links(data: ['scrollTo' => false])  }}
                 
                </div>

            </div>

            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton1" data-modal-target="large-modal1" data-modal-toggle="large-modal1" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    <div dir="rtl" id="createkeywords" class="hidden">
                        <button id="createkeyword" data-modal-target="large-modal1" data-modal-toggle="large-modal1" class="right-0 px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Keyword</button>
                    </div>
                    @if ($activeTab == 'settings-tab')
                    <div >
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">
                                    <input type="checkbox" onchange="toggleSelectAll1(this)" class="form-checkbox">
                                </th>
                                <th scope="col" class="px-6 py-3">Keyword</th>
                                <th scope="col" class="px-6 py-3">Filter</th>
                                <th scope="col" class="px-6 py-3">Filter String</th>
                                <th scope="col" class="px-6 py-3">Type</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Company String</th>
                                <th scope="col" class="px-6 py-3">Brand String</th>
                            </thead>
                            <tbody>
                                @foreach($keywords as $keyword)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" onchange="updateEditButtonVisibility1()" value="{{$keyword->keyID}}" class="form-checkbox checkboxes1">
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $keyword->KeyWord}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Filter}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Filter_String}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Type}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Category}}</td>
                                    <td class="px-6 py-4">{{ $keyword->CompanyS}}</td>
                                    <td class="px-6 py-4">{{ $keyword->BrandS}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $keywords->links(data: ['scrollTo' => false])  }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>