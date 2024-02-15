<div>
    <h5 class="text-center text-xl font-bold dark:text-white">Create Publication</h5>
    <form wire:submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 p-4">
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-1 gap-3">

                <div class="mb-2">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="title" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>

            </div>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <div class="mb-4">
                    <label for="address1" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 1</label>
                    <input wire:model="address1" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="edition" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Edition</label>

                    <select wire:model="edition" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['city'] as $key=>$edtion)
                        <option value="{{$edtion->ID}}">{{$edtion->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="address2" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 2</label>
                    <input wire:model="address2" type="text" id="address2" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="category" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Category</label>
                    <select wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['Pub Category'] as $key=>$category)
                        <option value="{{$category->ID}}">{{$category->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="address3" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Address 3</label>
                    <input wire:model="address3" type="text" id="address3" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                


                <div class="mb-4">
                    <label for="type" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Type</label>
                    <select wire:model="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['Pubtype'] as $key=>$pubtype)
                        <option value="{{$pubtype->ID}}">{{$pubtype->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="city" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">City</label>
                    <select wire:model="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['city'] as $key=>$city)
                        <option value="{{$city->ID}}">{{$city->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="region" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Region</label>
                    <select wire:model="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['Region'] as $key=>$region)
                        <option value="{{$region->ID}}">{{$region->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="state" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">State</label>
                    <select wire:model="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['State'] as $key=>$state)
                        <option value="{{$state->ID}}">{{$state->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="language" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Language</label>
                    <select wire:model="language" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['Language'] as $key=>$language)
                        <option value="{{$language->ID}}">{{$language->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="country" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Country</label>
                    <select wire:model="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse($data['Country'] as $key=>$country)
                        <option value="{{$country->ID}}">{{$country->Name}}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-4">
                    <label for="pagename" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Page Name</label>
                    <div class="flex items-center space-x-2 mb-2">
                        <input wire:model="pagenames" wire:keydown.enter.prevent="addCheckbox" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="pagename">
                    </div>
                    @foreach($checkboxes as $index => $label)
                    <div>
                        <input type="checkbox" id="checkbox-{{ $index }}">
                        <label for="checkbox-{{ $index }}">{{ $label }}</label>
                    </div>
                    @endforeach

                </div>
                <div class="mb-4">
                    <label for="phone" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Phone No.</label>
                    <input wire:model="phone" type="text" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <br>
                <div class="mb-4">
                    <input wire:model="domestic" value="" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Domestic</span>
                    <input wire:model="international" value="" type="checkbox">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">International</span>
                </div>
               

                <div class="mb-4">
                    <label for="Masthead" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Mast Head File</label>
                    <input type="file" wire:model="masthead" class="" />
                </div>
                <div class="col-span-2 mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>

                </div>
            </div>
        </div>
        <div class="bg-gray-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="circulation" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Circulation</label>
                    <input wire:model="circulation" type="text" id="circulation" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="issn" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">ISSN</label>
                    <input wire:model="issn" type="text" id="issn" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="frequency" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Frequency</label>
                    <input wire:model="frequency" type="text" id="frequency" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="website" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Website</label>
                    <input wire:model="website" type="text" id="website" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="size" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Size</label>
                    <input wire:model="size" type="text" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

                                <input type="text" wire:model="RatePC" class="border border-gray-300 p-2 rounded w-full">
                            </td>
                            <td class="">
                                <input type="text" wire:model="RateNC" class="border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-center">
                                <label class="block text-sm font-medium text-gray-700 mb-2 gap-3">B&W</label>
                                <input type="text" wire:model="RatePB" class="border border-gray-300 p-2 rounded w-full">

                            </td>
                            <td class="">
                                <input type="text" wire:model="RateNB" class="border border-gray-300 p-2 rounded w-full">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

        </div>

    </form>
</div>