<div>
    <form wire:submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 p-4">
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-3 gap-3">

                <div class="mb-2" x-data="{isTyped: false}">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Publication</label>
                    <input wire:model="pubid" type="text" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Web Universe</span>
                    <br>
                    <input disabled wire:model="webuniverse" {{$webuniverse == 1 ? "checked" : ''}} class="text" type="checkbox">
                </div>
                <div class="mb-4">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Primary</span>
                    <div class="mt-1 flex items-center">
                        <input disabled wire:model="primary" {{$primary == 1 ? "checked" : ''}} class="text" type="checkbox">
                        <input wire:model="primary" type="text" id="primary" class="text ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>



            </div>
            <div class="grid grid-cols-1">
                <div class="mb-2">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="title" type="text" id="name" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="address1" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 1</label>
                    <input wire:model="address1" type="text" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">

                    <label for="edition" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Edition</label>
                    <select wire:model="edition" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @foreach($picklist['city'] as $edtion)
                        <option {{$edtion->ID == $edition ?'selected':'' }} value="{{$edtion->ID}}">{{$edtion->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="address2" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 2</label>
                    <input wire:model="address2" type="text" id="address2" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="category" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Category</label>
                    <select wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Pub Category'] as $key=>$cat)
                        <option {{$cat->ID == $category?'seleted':''}} value="{{$cat->ID}}">{{$cat->Name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="address3" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 3</label>
                    <input wire:model="address3" type="text" id="address3" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">

                    <label for="type" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Type</label>
                    <select wire:model="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Pubtype'] as $key => $pubtype)
                        <option {{ $pubtype->ID == $type ? 'selected' : '' }} value="{{ $pubtype->ID }}">{{ $pubtype->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="city" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">City</label>
                    <select wire:model="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($picklist['city'] as $key=>$city)
                        <option {{$city->ID == ($city?0:'')? 'selected' : ''}} value="{{$city->ID}}">{{$city->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="region" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Region</label>
                    <select wire:model="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Region'] as $key=>$region)
                        <option {{$region->ID ==($region?0:'')? 'selected': ''}} value="{{$region->ID}}">{{$region->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="state" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">State</label>
                    <select wire:model="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['State'] as $key=>$states)
                        <option {{$states->ID == ($state?0:'') ? 'selected': ''}} value="{{$states->ID}}">{{$states->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="language" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Language</label>
                    <select wire:model="language" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Language'] as $key=>$lang)
                        <option {{$lang->ID == $language ?  'selected': ''}} value="{{$lang->ID}}">{{$lang->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="country" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Country</label>
                    <select wire:model="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Country'] as $key=>$cont)
                        <option {{$cont->ID == $country ?  'selected': ''}} value="{{$cont->ID}}">{{$cont->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="pagename" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Page Name</label>
                    @if(!empty($pagenames))
                    @foreach($pagenames as $pagename)
                    <div class="flex items-center space-x-2 mb-2">
                        <input wire:model="pagenames.{{$pagename['PageNameID']}}" type="checkbox" class="text gap-4" {{$pagename['IsPre']?"checked":''}} value="{{$pagename['PageNameID']}}"> <span class="gap-2">{{$pagename['Name']}}</span>
                    </div>


                    @endforeach
                    @endif

                </div>


                <div class="mb-4">
                    <input wire:model="domestic" {{$domestic == 1 ?"checked":''}} class="text" value="{{$domestic}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Domestic</span>
                    <input wire:model="international" {{$international == 0 ?"":'checked'}} class="text" value="{{$international}}" type="checkbox" style="margin-left: 50px;">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">International</span>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Phone No.</label>
                    <input wire:model="phone" type="text" id="phone" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <input wire:model="restrictedmu" {{$restrictedmu == 1 ?"checked":''}} class="text" value="{{$restrictedmu}}" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Restricted MU</span>
                    <input wire:model="mu" {{$mu == 1 ?"checked":''}} class="text" value="{{$mu}}" type="checkbox" style="margin-left: 20px;">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">MU</span>
                </div>

                <div class="mb-4">
                    <label for="Masthead" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Mast Head File</label>
                    <input type="{{$masthead?'text':'file'}}" {{$masthead?'':''}} wire:model="masthead" class="text" />
                </div>
                <div class="col-span-2 mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    <button type="button" id="cancel" onclick="desableAllDisabledItems()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cancel</button>
                    <button type="button" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-blue-600">Set AVE</button>

                </div>
            </div>
        </div>
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="circulation" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Circulation</label>
                    <input wire:model="circulation" type="text" id="circulation" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="issn" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">ISSN</label>
                    <input wire:model="issn" type="text" id="issn" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="frequency" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Frequency</label>
                    <input wire:model="frequency" type="text" id="frequency" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="website" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Website</label>
                    <input wire:model="website" type="text" id="website" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="size" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Size</label>
                    <input wire:model="size" type="text" id="size" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

            </div>
            <fieldset class="border border-gray-300 p-3 rounded-lg">
                <legend class="text-lg text-gray-700 mb-4">Rates</legend>

                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-sm font-medium text-gray-700 p-2">Premium</th>
                            <th class="text-sm font-medium text-gray-700 p-2">Non-Premium</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="flex items-center ">
                                <label class=" block text-sm font-medium text-gray-700 gap-2">Color </label>

                                <input type="text" wire:model="RatePC" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                            <td class="">
                                <input type="text" wire:model="RateNC" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-center">
                                <label class="block text-sm font-medium text-gray-700 mb-2 gap-3">B&W</label>
                                <input type="text" wire:model="RatePB" class="text border border-gray-300 p-2 rounded w-full">

                            </td>
                            <td class="">
                                <input type="text" wire:model="RateNB" class="text border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

        </div>

    </form>
</div>