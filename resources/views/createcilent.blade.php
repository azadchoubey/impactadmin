@extends('layouts.default')

@section('content')
<div class="w-10/12 mx-auto p-8 border border-gray-300">

    <form id="clientForm" action="{{route('createclient')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="Name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('Name') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div>
            <div>
                <label for="broadcast" class="block text-sm font-medium text-gray-700">Broadcast</label>
                <div class="flex items-center">

                    <input type="checkbox" checked id="broadcastCheckbox" class="mr-2">
                    <input id="broadcast" name="broadcastcid" disabled type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

            </div>
            <div>
                <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                <select name="SectorPid" id="SectorPid" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Select Option</option>

                    @foreach($picklist['sector'] as $sector)
                    <option value="{{$sector->ID}}">{{$sector->Name}}</option>
                    @endforeach
                </select>
                @error('SectorPid') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
            </div>

            
            <div>
                <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                <input name="Mobile" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>


            <div>
                <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                <select name="Source" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Select Option</option>

                    @foreach($picklist['client source'] as $source)
                    <option value="{{$source->ID}}">{{$source->Name}}</option>
                    @endforeach
                </select>
                @error('Source') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
            </div>
           
            <div>
                <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                <input name="wm_contractstartdate" id="contractstart" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('wm_contractstartdate') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="Type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Select Option</option>
                    @foreach($picklist['client type'] as $type)
                    <option value="{{$type->ID}}">{{$type->Name}}</option>
                    @endforeach
                </select>
                @error('Type') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
            </div>
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <input id="currency" type="text" name="Currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <select name="Region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Select Option</option>
                    @foreach($picklist['region'] as $region)
                    <option value="{{$region->ID}}">{{$region->Name}}</option>
                    @endforeach
                </select>
                @error('Region') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
            </div>

            <div>
                <label for="client" class="block text-sm font-medium text-gray-700">Client Logo</label>
                <input id="client" type="file" name="Logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>


        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                    <input type="checkbox" name="wm_enableforprint" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" name="StartDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" name="EndDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                        <select name="BillCycleID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Option</option>
                            @foreach($picklist['bill cycle'] as $billingcycle)
                            <option value="{{$billingcycle->ID}}">{{$billingcycle->Name}}</option>
                            @endforeach
                        </select>
                        @error('BillCycleID') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                    </div>
                    <div>
                        <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                        <input name="BillDate" id="billingcycle" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                        <input id="billingrate" type="text" name="BillRate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                        <select name="Status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                        @error('Status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                    </div>

                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                    <input type="checkbox" name="wm_enableforweb" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" name="wm_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" name="wm_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                        <select name="wm_billingcycle" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Option</option>
                            @foreach($picklist['bill cycle'] as $billingcycle)
                            <option value="{{$billingcycle->ID}}">{{$billingcycle->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                        <input name="wm_billingdate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                        <input id="" type="text" name="wm_billingrate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                        <select name="wm_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                        @error('wm_status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Twitter Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Twitter</label>
                    <input type="checkbox" name="wm_enablefortwitter" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" name="wm_twitter_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" name="wm_twitter_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Twitter Status</label>
                        <select name="wm_twitter_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Other Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for WhatsApp</label>
                    <input type="checkbox" name="enableforwhatsapp" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for YouTube</label>
                    <input type="checkbox" name="enableforyoutube" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for DYNA</label>
                    <input type="checkbox" name="enablefordidyounotice" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Full-Text</label>
                    <input type="checkbox" name="enableforfulltext" value="1">
                </div>

            </fieldset>
        </div>
        <div>
            <button id="save" type="submit" class=" inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        document.getElementById('SectorPid').addEventListener('change', function() {
        var selectedIndustry = this.value;
        var subsectorSelect = document.getElementById('subsector');

        // Clear existing options
        subsectorSelect.innerHTML = '';

        if (selectedIndustry) {
            // Fetch subsectors based on selected industry
            fetch('/get-subsectors/' + selectedIndustry)
                .then(response => response.json())
                .then(data => {
                    // Populate subsector options
                    data.forEach(subsector => {
                        var option = document.createElement('option');
                        option.value = subsector.ID;
                        option.text = subsector.Name;
                        subsectorSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching subsectors:', error));
        }
    });
    })

</script>
@endsection