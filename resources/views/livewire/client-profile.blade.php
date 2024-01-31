<div class="container mx-auto p-6 bg-white rounded-md shadow-md">
    <div>
    <form wire:submit.prevent="clientsubmit" class="flex items-center max-w-lg mx-auto">   
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative flex-grow">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M6 10c0-3.314 2.686-6 6-6s6 6 6 6-2.686 6-6 6-6-2.686-6-6z" />
            </svg>
        </div>
        <input autocomplete="off" wire:model="name" wire:keyup.debounce.200ms="updateTitle" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-4 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search client name..." required>
        
        @if(!empty($Results))
            <div class="absolute z-10 mt-1 bg-white border border-gray-300 rounded-md shadow-lg ">
                <ul>
                    @foreach($Results as $result)
                      <li wire:click="fetchAll('{{ $result->ClientID }}', '{{$result->Name }}')" class="px-4 py-2 hover:bg-gray-100">
                            {{ Str::limit($result->Name, 40) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <button type="submit" class="ml-2 flex-shrink-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <span>Search</span>
    </button>
</form>
    </div>


<div class="mt-4">
@php
            $keywords = $contacts?->keywords()->paginate(10,pageName: 'keywords');
            $contacts = $contacts?->contacts()->paginate(10,pageName: 'contacts');
            $cross = '<div>
                <svg class="w-3 h-3 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </div>';
            $check = ' <div>
                <svg class="w-3 h-3 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                </svg>
            </div>';
            @endphp

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Client Profile</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Client Contacts</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Client Keywords</button>
        </li>
       
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    @if($clientshow)
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                <input wire:model="clientID" id="client_id" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input wire:model="name" id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          
            <div>
                <label for="csrsince" class="block text-sm font-medium text-gray-700">Customer Since</label>
                <input wire:model="csrsince" id="csrsince" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone No</label>
                <input wire:model="phone" id="phone" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            
            <div>
                <label for="address1" class="block text-sm font-medium text-gray-700">Address 1</label>
                <input wire:model="AddressLine1" id="address" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="address2" class="block text-sm font-medium text-gray-700">Address 2</label>
                <input wire:model="AddressLine2" id="address" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="address3" class="block text-sm font-medium text-gray-700">Address 3</label>
                <input wire:model="AddressLine3" id="address" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          
            <div>
                <label for="fax" class="block text-sm font-medium text-gray-700">Address 3</label>
                <input wire:model="fax" id="address" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          
            <div>
                <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                <input wire:model="mobile" id="csrsince" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model="email" id="csrsince" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input wire:model="city" id="city" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                <input wire:model="contractstart" id="contractstart" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="contractend" class="block text-sm font-medium text-gray-700">Contract End</label>
                <input wire:model="contractend" id="contractend" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                <input wire:model="state" id="state" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="pincode" class="block text-sm font-medium text-gray-700">Pincode</label>
                <input wire:model="pincode" id="pincode" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="Country" class="block text-sm font-medium text-gray-700">Country</label>
                <input wire:model="country" id="country" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                <input wire:model="printstatus" id="printstatus" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <input wire:model="currency" id="currency" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <input wire:model="region" id="currency" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="client" class="block text-sm font-medium text-gray-700">Client</label>
                <input wire:model="client" id="client" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                <input wire:model="webstatus" id="webstatus" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          
            <div>
                <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                <input wire:model="reference" id="subsector" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input wire:model="type" id="type" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                <input wire:model="billingcycle" id="billingcycle" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                <input wire:model="billingdate" id="billingcycle" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                <input wire:model="billingrate" id="billingrate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                <input wire:model="sector" id="csrsince" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="subsector" class="block text-sm font-medium text-gray-700">Sub Sector</label>
                <input wire:model="subsector" id="subsector" type="radio" >
            </div>
        </div>
        <div class="flex justify-end space-x-2">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
            </button>
        </div>
    </form>
    @endif
</div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
            <thead  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th scope="col" class="px-6 py-3">Contact Name</th>
            <th scope="col" class="px-6 py-3">For Print</th>
            <th scope="col" class="px-6 py-3">For Web</th>
            <th scope="col" class="px-6 py-3">For Qlikview</th>
            <th scope="col" class="px-6 py-3">For Qualify</th>
            <th scope="col" class="px-6 py-3">For Alert</th>
            <th scope="col" class="px-6 py-3">For Charts</th>
            <th scope="col" class="px-6 py-3">For Br</th>
            <th scope="col" class="px-6 py-3">For BB</th>
            <th scope="col" class="px-6 py-3">For Mobile</th>
            <th scope="col" class="px-6 py-3">For Whatsapp</th>
            <th scope="col" class="px-6 py-3">Custom Digest</th>
            <th scope="col" class="px-6 py-3">Regular Digest</th>
            </thead>
            <tbody>
                @if($contacts)
                @foreach($contacts as $contact)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->ContactName}}</td>
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
                    <td class="px-6 py-4">{!! $contact->delivery->isNotEmpty()?$check:$cross !!}</td>
                    <td class="px-6 py-4">{!!  ($contact->regularDigestPrint->ID != 0 || $contact->regularDigestWeb->isNotEmpty()) ?$check:$cross !!}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ $contacts?->links(data: ['scrollTo' => false])  }}
    </div>
</div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
    <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
            <thead  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th scope="col" class="px-6 py-3">Keyword</th>
            <th scope="col" class="px-6 py-3">Filter</th>
            <th scope="col" class="px-6 py-3">Filter String</th>
            <th scope="col" class="px-6 py-3">Type</th>
            <th scope="col" class="px-6 py-3">Category</th>
            <th scope="col" class="px-6 py-3">Company String</th>
            <th scope="col" class="px-6 py-3">Brand String</th>
            </thead>
            <tbody>
            @if($contacts)
                @foreach($keywords as $keyword)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $keyword->KeyWord}}</td>
                    <td class="px-6 py-4">{{ $keyword->Filter}}</td>
                    <td class="px-6 py-4">{{ $keyword->Filter_String}}</td>
                    <td class="px-6 py-4">{{ $keyword->Type}}</td>
                    <td class="px-6 py-4">{{ $keyword->Category}}</td>
                    <td class="px-6 py-4">{{ $keyword->CompanyS}}</td>
                    <td class="px-6 py-4">{{ $keyword->BrandS}}</td>
                </tr>
                @endforeach
               @endif
            </tbody>
        </table>
        {{ $keywords?->links(data: ['scrollTo' => false])  }}
    </div>
</div>
</div>

   

    

 

    
    </div>
</div>

