@extends('layouts.default')

@section('content')
<div class="w-10/12 mx-auto p-8 border border-gray-300">

    <form id="clientForm" action="{{route('createclient')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" value="{{old('Name')}}" name="Name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('Name') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div>
            <div>
                <label for="broadcast" class="block text-sm font-medium text-gray-700">Broadcast</label>
                <div class="flex items-center">

                    <input type="checkbox"   id="broadcastCheckbox" class="mr-2">
                    <input id="broadcast" value="{{old('broadcastcid')}}" name="broadcastcid" disabled type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

            </div>
            <div>
                <label for="primary" class="block text-sm font-medium text-gray-700">Primary Client</label>
                <div class="flex items-center">
                    <input type="checkbox"  id="primaryCheckbox" class="mr-2">
                    <select name="PriClientID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        <option value="">Select Primary Client</option>
                        @foreach($clients as $client)
                        <option {{old('PriClientID') == $client->ClientID ?'selected':''}} value="{{$client->ClientID}}">{{$client->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div>
                <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                <select name="SectorPid" id="SectorPid" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Option</option>

                    @foreach($picklist['sector'] as $sector)
                    <option {{old('SectorPid') == $sector->ID ?'selected':''}} value="{{$sector->ID}}">{{$sector->Name}}</option>
                    @endforeach
                </select>
                @error('SectorPid') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
            </div>

            
            <div>
                <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                <input name="Mobile" value="{{old('Mobile')}}"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('Mobile') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div>


            <div>
                <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                <select name="Source" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Option</option>

                    @foreach($picklist['client source'] as $source)
                    <option {{old('Source') == $source->ID ?'selected':''}} value="{{$source->ID}}">{{$source->Name}}</option>
                    @endforeach
                </select>
                {{-- @error('Source') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
            </div>
{{--            
            <div>
                <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                <input name="BillDate" value="{{old('BillDate')}}" id="BillDate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('BillDate') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div> --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="Type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Option</option>
                    @foreach($picklist['client type'] as $type)
                    <option  {{old('Type') == $type->ID ?'selected':''}}  value="{{$type->ID}}">{{$type->Name}}</option>
                    @endforeach
                </select>
                {{-- @error('Type') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
            </div>
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                <input id="currency"  value="{{old('Currency')}}" type="text" name="Currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('Currency') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

            </div>
            <div>
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <select name="Region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Option</option>
                    @foreach($picklist['region'] as $region)
                    <option  {{old('Region') == $region->ID ?'selected':''}}  value="{{$region->ID}}">{{$region->Name}}</option>
                    @endforeach
                </select>
                {{-- @error('Region') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
            </div>

            <div>
                <label for="client" class="block text-sm font-medium text-gray-700">Client Logo</label>
                <input id="client" value="{{old('Logo')}}"  type="file" name="Logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>


        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                    <input type="checkbox" {{old('wm_enableforprint') == '1' ? 'checked':''}}  name="wm_enableforprint" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date"  value="{{old('StartDate')}}" name="StartDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" value="{{old('EndDate')}}" name="EndDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                        <select name="BillCycleID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['bill cycle'] as $billingcycle)
                            <option {{old('BillCycleID') == $billingcycle->ID ?'selected':''}}  value="{{$billingcycle->ID}}">{{$billingcycle->Name}}</option>
                            @endforeach
                        </select>
                        {{-- @error('BillCycleID') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
                    </div>
                    <div>
                        <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                        <input name="BillDate" value="{{old('BillDate')}}" id="billingcycle" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                        <input id="billingrate" value="{{old('BillRate')}}"  type="text" name="BillRate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                        <select name="Status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option {{old('Status') == $status->ID ?'selected':''}} value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                        {{-- @error('Status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
                    </div>

                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                    <input type="checkbox" {{old('wm_enableforweb') == '1' ? 'checked':''}} name="wm_enableforweb" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date"  value="{{old('wm_contractstartdate')}}"  name="wm_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" value="{{old('wm_contractenddate')}}"  name="wm_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                        <select name="wm_billingcycle" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['bill cycle'] as $billingcycle)
                            <option {{old('wm_billingcycle') == $billingcycle->ID ?'selected':''}} value="{{$billingcycle->ID}}">{{$billingcycle->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                        <input name="wm_billingdate" value="{{old('wm_billingdate')}}"  type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                        <input id="" type="text" value="{{old('wm_billingrate')}}" name="wm_billingrate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                        <select name="wm_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option {{old('wm_status') == $status->ID ?'selected':''}}  value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                        {{-- @error('wm_status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror --}}
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Twitter Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Twitter</label>
                    <input type="checkbox" {{old('wm_enablefortwitter') == '1' ? 'checked':''}}  name="wm_enablefortwitter" value="1">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" value="{{old('wm_twitter_contractstartdate')}}"  name="wm_twitter_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" value="{{old('wm_twitter_contractenddate')}}"  name="wm_twitter_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Twitter Status</label>
                        <select name="wm_twitter_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['client status'] as $status)
                            <option {{old('wm_twitter_status') == $status->ID ?'selected':''}} value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-6 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Other Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for WhatsApp</label>
                    <input type="checkbox" {{old('enableforwhatsapp') == '1' ? 'checked':''}}  name="enableforwhatsapp" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for YouTube</label>
                    <input type="checkbox" {{old('enableforyoutube') == '1' ? 'checked':''}} name="enableforyoutube" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for DYNA</label>
                    <input type="checkbox" {{old('enablefordidyounotice') == '1' ? 'checked':''}}  name="enablefordidyounotice" value="1">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Full-Text</label>
                    <input type="checkbox" {{old('enableforfulltext') == '1' ? 'checked':''}} name="enableforfulltext" value="1">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('primaryCheckbox');
        const dropdown = document.querySelector('select[name="PriClientID"]');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                dropdown.disabled = false;
            } else {
                dropdown.disabled = true;
            }
        });
    });
</script>
@endsection