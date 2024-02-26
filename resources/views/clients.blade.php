@extends('layouts.default')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-md shadow-md">
    @php

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
        <div id="tabs" class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="{{ !(request()->query('keywords') || request()->query('contacts')) ? 'true' : 'false' }}">Client Details</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="{{ request()->query('contacts') ? 'true' : 'false' }}">Client Contacts</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="{{ request()->query('keywords') ? 'true' : 'false' }}">Client Keywords</button>
                </li>
            </ul>
        </div>

        <div id="default-tab-content">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                            <input value="{{$data->ClientID}}" id="client_id" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="broadcast" class="block text-sm font-medium text-gray-700">Broadcast</label>
                                <div class="flex items-center">
                                    <input type="checkbox" {{$data->broadcastcid?'':'checked'}} id="broadcastCheckbox" class="mr-2">
                                    <input id="broadcast" value="{{$data->broadcastcid}}"  type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                            <div>
                                <label for="primary" class="block text-sm font-medium text-gray-700">Primary Client</label>
                                <div class="flex items-center">
                                    <input type="checkbox" {{$data->PriClientID?'':'checked'}} id="primaryCheckbox" class="mr-2">
                                    <input id="primary" value="{{$data->PriClientID}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>


                        <div>
                            <label for="csrsince" class="block text-sm font-medium text-gray-700">Customer Since</label>
                            <input value="{{$data->customersince}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" value="{{$data->Name}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone No</label>
                            <input id="phone" value="{{$data->Phone}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                            <input value="{{$data->sector->Name}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="address1" class="block text-sm font-medium text-gray-700">Address 1</label>
                            <input id="address" value="{{$data->AddressLine1}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="fax" class="block text-sm font-medium text-gray-700">FAX</label>
                            <input id="address" value="{{$data->Fax}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="subsector" class="block text-sm font-medium text-gray-700">Sub Sector</label>
                            <input id="subsector" type="radio">
                        </div>
                        <div>
                            <label for="address2" class="block text-sm font-medium text-gray-700">Address 2</label>
                            <input id="address" value="{{$data->AddressLine2}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                            <input id="csrsince" value="{{$data->Mobile}}"type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <br>
                        <div>
                            <label for="address3" class="block text-sm font-medium text-gray-700">Address 3</label>
                            <input id="address" value="{{$data->AddressLine3}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>



                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="csrsince" value="{{$data->Email}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                            <input id="subsector" value="{{$data->Reference}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input id="city" value="{{$data->City}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                            <input id="contractstart" value="{{$data->StartDate}}" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input id="type" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                    <input id="state" value="{{$data->State}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
                                    <input id="pincode" value="{{$data->Pin}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="contractend" class="block text-sm font-medium text-gray-700">Contract End</label>
                            <input id="contractend" value="{{$data->EndDate}}" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                            <input id="billingcycle" value="{{$data->Billingcycle->Name}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="Country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input id="country" value="{{$data->Country->Name}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                            <input id="printstatus" value="{{$data->wm_enableforprint}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                            <input id="billingcycle" value="{{$data->BillDate}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <input id="currency" value="{{$data->Currency}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                            <input id="currency" value="{{$data->region}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                            <input id="billingrate" value="{{$data->BillRate}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700">Client Logo</label>
                            <input id="client" value="{{$data->Logo}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                            <input id="webstatus" value="{{$data->wm_enableforweb}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>


                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        <button type="button" id="dltbtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Delete</button>
                        <button type="button" onclick="enableAllDisabledItems()" id="editbtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>

                    </div>
                </form>

            </div>
            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton" data-modal-target="large-modal" data-modal-toggle="large-modal" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    <div id="createcontacts">
                        <button data-modal-target="large-modal2" data-modal-toggle="large-modal2" class="right-0 px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Contact</button>
                    </div>
                    @php
                    $currentPage = request()->input('contacts', 1);
                    $perPage = 10;
                    $totalItems = $contacts->count();
                    $totalPages = ceil($totalItems / $perPage);
                    $startIndex = ($currentPage - 1) * $perPage;
                    $endIndex = min($startIndex + $perPage - 1, $totalItems);

                    $currentPageItems = $contacts->slice($startIndex, $endIndex - $startIndex + 1);
                    @endphp
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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

                            @foreach($currentPageItems as $contact)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <input type="checkbox" onchange="updateEditButtonVisibility()" value="{{$contact->contactid}}" class="form-checkbox checkboxes">
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->ContactName}}</td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforprint" {{ $contact->wm_enableforprint ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforweb" {{ $contact->wm_enableforweb ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden ">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforqlikview" {{ $contact->enableforqlikview ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enabletoqualify" {{ $contact->enabletoqualify ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="getcriticalalert" {{ $contact->getcriticalalert ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden ">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforcharts" {{ $contact->enableforcharts ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbr" {{ $contact->enableforbr ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbb" {{ $contact->enableforbb ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformobile" {{ $contact->enableformobile ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforwhatsapp" {{ $contact->enableforwhatsapp ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformediatouch" {{ $contact->enableformediatouch ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enablefordidyounotice" {{ $contact->enablefordidyounotice ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="delivery" {{ $contact->delivery->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestWeb" {{ $contact->regularDigestWeb->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestPrint" {{ $contact->regularDigestPrint->ID != 0 ? 'checked' : '' }} />
                                </td>
                                <td class="editSection{{$contact->contactid}} px-6 py-4 hidden"><a href="javascript:void(0);">Update</a></td>



                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->wm_enableforprint?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->wm_enableforweb?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforqlikview?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enabletoqualify?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->getcriticalalert?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforcharts?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforbr?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforbb?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableformobile?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforwhatsapp?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableformediatouch?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enablefordidyounotice?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->delivery->isNotEmpty()?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->regularDigestWeb->isNotEmpty() ?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->regularDigestPrint->ID != 0 ?$check:$cross !!}</td>
                                <td id="editButton" class="withoutEditSection{{$contact->contactid}} px-6 py-4"><a onclick="toggleEditMode({{$contact->contactid}})" href="javascript:void(0);">Edit</a></td>


                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $startIndex + 1 }}-{{ $endIndex + 1 }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $totalItems }}</span>
                        </span>
                        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                            <li>
                                <a href="{{ url()->current() }}?contacts={{ max($currentPage - 1, 1) }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $currentPage == 1 ? 'pointer-events-none' : '' }}">Previous</a>
                            </li>
                            @for ($page = 1; $page <= $totalPages; $page++) <li>
                                <a href="{{ url()->current() }}?contacts={{ $page }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $page == $currentPage ? 'text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '' }}">{{ $page }}</a>
                                </li>
                                @endfor
                                <li>
                                    <a href="{{ url()->current() }}?contacts={{ min($currentPage + 1, $totalPages) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $currentPage == $totalPages ? 'pointer-events-none' : '' }}">Next</a>
                                </li>
                        </ul>
                    </nav>
                </div>

            </div>

            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton1" data-modal-target="large-modal1" data-modal-toggle="large-modal1" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    {{-- <div dir="rtl" id="createkeywords" class="hidden">
                        <button id="createkeyword" data-modal-target="large-modal1" data-modal-toggle="large-modal1" class="right-0 px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Keyword</button>
                    </div>  --}}
                    <div>
                        @php
                        $currentPage = request()->input('keywords', 1);
                        $perPage = 10;
                        $totalItems = $keywords->count();
                        $totalPages = ceil($totalItems / $perPage);

                        $startIndex = ($currentPage - 1) * $perPage;
                        $endIndex = min($startIndex + $perPage - 1, $totalItems);

                        $currentPageItems = $keywords->slice($startIndex, $endIndex - $startIndex + 1);
                        @endphp
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
                                @foreach($currentPageItems as $keyword)
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

                        {{-- $keywords->links(data: ['scrollTo' => false])  --}}
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $startIndex + 1 }}-{{ $endIndex + 1 }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $totalItems }}</span>
                            </span>
                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <li>
                                    <a href="{{ url()->current() }}?keywords={{ max($currentPage - 1, 1) }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $currentPage == 1 ? 'pointer-events-none' : '' }}">Previous</a>
                                </li>
                                @for ($page = 1; $page <= $totalPages; $page++) <li>
                                    <a href="{{ url()->current() }}?keywords={{ $page }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $page == $currentPage ? 'text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '' }}">{{ $page }}</a>
                                    </li>
                                    @endfor
                                    <li>
                                        <a href="{{ url()->current() }}?keywords={{ min($currentPage + 1, $totalPages) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $currentPage == $totalPages ? 'pointer-events-none' : '' }}">Next</a>
                                    </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="large-modal" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Client Contacts Edit
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4 md:p-5 space-y-4">
                    <!-- Headers -->
                    <div class="flex flex-wrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Print
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Web
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Qlikview
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Qualify
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Alert
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Charts
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Br
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            BB
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Mobile
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Whatsapp
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Mediatouch
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Dyna
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Custom Digest
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Regular Web
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                        <label class="flex justify-between items-center w-full px-6 py-3">
                            Regular Print
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                        </label>
                    </div>


                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="large-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="large-modal1" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Client Keyword Create
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal1">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4 md:p-5 space-y-4">


                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="large-modal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="large-modal2" tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add Client Contact
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal2">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4 md:p-3">
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Personal Details</legend>
                        <div class="grid grid-cols-3 gap-4 p-5">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Mobile</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Type</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @if(isset($picklist['contacttype']))
                                    @foreach($picklist['contacttype'] as $contacttype)
                                    <option value="{{$contacttype->ID}}">{{$contacttype->Name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Designation</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Fax</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 1</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 2</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 3</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Country</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['Country'] as $country)
                                    <option value="{{$country->ID}}">{{$country->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">City</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['City'] as $City)
                                    <option value="{{$City->ID}}">{{$City->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Country Code</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Area Code</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                        <div class="grid grid-cols-3 gap-4 mt-4 p-5">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                                <input type="checkbox">
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Print</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($deliverymaster as $Delivery)
                                    <option value="{{$Delivery->id}}">{{$Delivery->deliverytime}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Sector delivery method</label>
                                <select multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['Delivery Method'] as $Delivery)
                                    <option value="{{$Delivery->ID}}">{{$Delivery->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
                        <div class="grid grid-cols-4 gap-4 mt-3 p-5">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Twitter</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Web</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($webdeliverymaster as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->deliverytime}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Sector Summary for Sectors</label>
                                <select multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['Sector Summary Delivery'] as $Delivery)
                                    <option value="{{$Delivery->ID}}">{{$Delivery->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">WhatsApp Monitoring Parameters</legend>
                        <div class="grid grid-cols-3 gap-4 mt-3 p-5">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Whatsapp</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Send welcome message</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Phone No</label>
                                <input type="text" placeholder="E.g. 919811223344" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        </div>
                        <fieldset class="border border-gray-300 p-6 rounded-lg">
                            <legend class="text-sm font-medium text-gray-900">Print</legend>
                            <div class="grid grid-cols-4 gap-4 mt-3 p-5">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="pcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="pcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="pcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="pcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="pcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="pcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="pindnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="pindnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="pindnews" type="radio">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-gray-300 p-6 rounded-lg">
                            <legend class="text-sm font-medium text-gray-900">Web</legend>
                            <div class="grid grid-cols-4 gap-4 mt-3 p-5">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="wcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="wcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="wcomanynews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="wcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="wcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="wcomnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="windnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="windnews" type="radio">
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="windnews" type="radio">
                                </div>
                            </div>
                        </fieldset>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Others Parameters</legend>
                        <div class="grid grid-cols-3 gap-4 mt-3 p-5">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Media Touch</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for DYNA</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for QLIKVIEW</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for QUALIFY</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for ALERT</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for CHARTS</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for BR</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for BB</label>
                                <input type="checkbox">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Mobile</label>
                                <input type="checkbox">
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="large-modal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleSelectAll(checked) {
            let checkboxes = document.getElementsByClassName('checkboxes');
            var editButton = document.getElementById('editbutton');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checked.checked;
            }
            if (checked.checked) {
                editButton.classList.remove('hidden');
            } else {
                editButton.classList.add('hidden');
            }
        }

    function toggleSelectAll1(checked) {
        let checkboxes = document.getElementsByClassName('checkboxes1');
        var editButton = document.getElementById('editbutton1');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checked.checked;
        }
        if (checked.checked) {
            editButton.classList.remove('hidden');
        } else {
            editButton.classList.add('hidden');
        }
    }

    function updateEditButtonVisibility() {

        var checkboxes = document.querySelectorAll('.checkboxes');
        var checkedCount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });
        var editButton = document.getElementById('editbutton');
        if (checkedCount >= 2) {
            editButton.classList.remove('hidden');
        } else {
            editButton.classList.add('hidden');
        }
    }
    function updateEditButton(e) {
        var data = `<td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforprint" {{ $contact->wm_enableforprint ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="wm_enableforweb"  {{ $contact->wm_enableforweb ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforqlikview"  {{ $contact->enableforqlikview ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enabletoqualify"  {{ $contact->enabletoqualify ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="getcriticalalert"  {{ $contact->getcriticalalert ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforcharts"  {{ $contact->enableforcharts ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbr"  {{ $contact->enableforbr ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforbb"  {{ $contact->enableforbb ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformobile"  {{ $contact->enableformobile ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableforwhatsapp"  {{ $contact->enableforwhatsapp ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enableformediatouch"  {{ $contact->enableformediatouch ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="enablefordidyounotice"  {{ $contact->enablefordidyounotice ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="delivery"  {{ $contact->delivery->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestWeb"  {{ $contact->regularDigestWeb->isNotEmpty() ? 'checked' : '' }} />
                                </td>
                                <td class="px-6 py-4 hidden editable-checkbox">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="regularDigestPrint"  {{ $contact->regularDigestPrint->ID != 0 ? 'checked' : '' }} />
                                </td>
                                <td  class="px-6 py-4"><a href="javascript:void(0);">Update</a></td>`;
        var targetTd = e.closest('tr').querySelector('.font-medium');
    if (targetTd) {
        var siblings = targetTd.nextElementSibling;
        
        // Remove all siblings
        while (siblings) {
            var nextSibling = siblings.nextElementSibling;
            siblings.remove();
            siblings = nextSibling;
        }
       // targetTd.insertAdjacentHTML('afterend', data);
    }
        
    }

    function updateEditButtonVisibility1() {
        var checkboxes = document.querySelectorAll('.checkboxes1');
        var checkedCount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        }

        function toggleSelectAll1(checked) {
            let checkboxes = document.getElementsByClassName('checkboxes1');
            var editButton = document.getElementById('editbutton1');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checked.checked;
            }
            if (checked.checked) {
                editButton.classList.remove('hidden');
            } else {
                editButton.classList.add('hidden');
            }
        }

        function updateEditButtonVisibility() {
            var checkboxes = document.querySelectorAll('.checkboxes');
            var checkedCount = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });
            var editButton = document.getElementById('editbutton');
            if (checkedCount >= 2) {
                editButton.classList.remove('hidden');
            } else {
                editButton.classList.add('hidden');
            }
        }

        function updateEditButtonVisibility1() {
            var checkboxes = document.querySelectorAll('.checkboxes1');
            var checkedCount = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });
            var editButton = document.getElementById('editbutton1');
            if (checkedCount >= 2) {
                editButton.classList.remove('hidden');
            } else {
                editButton.classList.add('hidden');
            }
        }

        function showtab() {
            var tabs = document.getElementById('tabs');
            setTimeout(() => {
                tabs.classList.remove('hidden');
            }, 1000)

        }

        function enableAllDisabledItems() {
            const disabledElements = document.querySelectorAll('[disabled]');
            disabledElements.forEach(element => {
                element.removeAttribute('disabled');
            });
            document.getElementById('editbtn').style.display = "none";
        }

        function toggleEditMode(contactId) {
            var editSections = document.getElementsByClassName('editSection' + contactId);
            var withoutEditSections = document.getElementsByClassName('withoutEditSection' + contactId);

            for (var i = 0; i < editSections.length; i++) {
                var editSection = editSections[i];
                var withoutEditSection = withoutEditSections[i];

                if (!editSection.classList.contains('hidden')) {
                    editSection.classList.add('hidden');
                    withoutEditSection.classList.remove('hidden');
                } else {
                    editSection.classList.remove('hidden');
                    withoutEditSection.classList.add('hidden');
                }
            }
        }
        window.onload = (event) => {
            document.getElementById('settings-tab').addEventListener('click', function() {
                setTimeout(() => {
                    document.getElementById('createkeywords').style.display = "block";
                }, 1000)

            })
            document.getElementById('dashboard-tab').addEventListener('click', function() {
                setTimeout(() => {
                    document.getElementById('createcontacts').style.display = "block";
                }, 1000)

            })
        };
    </script>

    @endsection