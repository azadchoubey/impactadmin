<div class="w-11/12 mx-auto">
<div class='mt-3 flex flex-col items-center'>
        <button wire:loading disabled type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
            </svg>
            Processing ...
        </button>
        </div>
        <x-sticky-header title="" name="Edit Publication Name : {{$this->title}}" subtitle="PubId : {{$this->pubid}}" />
    <form wire:submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 p-4">
        <div class="mr-3 bg-white-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-2" x-data="{isTyped: false}">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Publication</label>
                    <input wire:model="pubid" type="text" disabled class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>                
     
                <div class="mb-4">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Primary</span>
                    <div class="mt-1 flex items-center">
                        <input  wire:model="togglePrimary" wire:click="togglePrimary" {{$primary != 0 ? "checked" : ''}} class="text" type="checkbox">
                        <select wire:model="primary" {{ !$primaryname  ? 'disabled' : ''}} class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option></option>
                        @foreach($data['pubmaster'] as $pubmaster)
                        <option value="{{$pubmaster->PubId}}">{{$pubmaster->Title}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>



            </div>
            <div class="grid grid-cols-1">
                <div class="mb-2">
                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="title" type="text" id="name" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('title')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">

                    <label for="edition" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Edition</label>
                    <select wire:model="edition" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @foreach($picklist['city'] as $edtion)
                        <option {{$edtion->ID == $edition ?'selected':'' }} value="{{$edtion->ID}}">{{$edtion->Name}}</option>
                        @endforeach
                    </select>
                    @error('edition')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                </div>
                <div class="mb-4">
                    <label for="category" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Category</label>
                    <select wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Pub Category'] as $key=>$cat)
                        <option {{$cat->ID == $category?'seleted':''}} value="{{$cat->ID}}">{{$cat->Name}}</option>
                        @endforeach
                    </select>
                    @error('category')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                </div>

                <div class="mb-4">

                    <label for="type" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Type</label>
                    <select wire:model="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Pubtype'] as $key => $pubtype)
                        <option {{ $pubtype->ID == $type ? 'selected' : '' }} value="{{ $pubtype->ID }}">{{ $pubtype->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="region" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Region</label>
                    <select wire:model="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Region'] as $key=>$region)
                        <option {{$region->ID ==($region?0:'')? 'selected': ''}} value="{{$region->ID}}">{{$region->Name}}</option>
                        @endforeach
                    </select>
                    @error('region')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                </div>

                <div class="mb-4">
                    <label for="language" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Language</label>
                    <select wire:model="language" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['Language'] as $key=>$lang)
                        <option {{$lang->ID == $language ?  'selected': ''}} value="{{$lang->ID}}">{{$lang->Name}}</option>
                        @endforeach
                    </select>
                    @error('language')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                </div>

                <div class="mb-4">
                    <label for="pagename" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Page Name</label>
                    <div>
                        <input wire:model="page" wire:keydown.enter.prevent="addCheckbox" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="pagename">
                    </div>
                    <div class="overflow-auto max-h-48 mt-3"> <!-- Set max height and enable overflow scrolling -->
                        @if(!empty($pagenames))
                        @foreach($pagenames as $key => $pagename)   
                        <div class="flex items-center justify-between space-x-2 mb-2">
                            <div class="flex items-center space-x-2">
                                <input wire:model="pagenames.{{$key}}.IsPre" {{$pagename['IsPre'] == "1" ? "checked":""}} type="checkbox" class="text gap-1"> 
                                @if(isset($pagename['editing']) && $pagename['editing'])
                                    <input wire:model="pagenames.{{$key}}.Name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @else
                                    <span class="gap-2">{{$pagename['Name']}}</span>
                                @endif
                            </div>
                            <div>
                                @if(isset($pagename['editing']) && $pagename['editing'])
                                <button wire:click="savePageName({{$key}})" type="button" class="px-2 py-1 text-sm font-semibold text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Save</button>
                                @else
                                <button wire:click="toggleEditPageName({{$key}})" type="button" class="px-2 py-1 text-sm font-semibold text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Edit</button>
                                <button wire:click="removePage({{$key}})" type="button" class="text-red-600 dark:text-red-500">❌</button>
                                @endif
                            </div>
                        </div>
                        @endforeach                    
                        @endif
                    </div>
                </div>
                
                
                

                <div class="mb-4">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Restricted MU</span> --}}
                    <input wire:model="mu" {{$mu == 1 ?"checked":''}} class="text" value="{{$mu}}" type="checkbox" style="margin-left: 20px;">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Media Universe</span>
                </div>

                <div class="mb-4">
                    <label for="Masthead" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Mast Head File</label>
                    <input type="file" accept="image/jpeg" wire:model="masthead" class="text" />
                </div>
                
                <div class="col-span-2 mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    <button type="button" id="cancel" onclick="desableAllDisabledItems()" class="hidden bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cancel</button>
                    <button type="button" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-blue-600">Set AVE</button>

                </div>
            </div>
        </div>
        <div class="bg-white-300 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 gap-3">
                <div class="mb-4">
                    <label for="circulation" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Circulation</label>
                    <input wire:model="circulation" type="text" id="circulation" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('circulation')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                </div>
                <div class="mb-4">
                    <label for="issn" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">ISSN</label>
                    <input wire:model="issn" type="text" id="issn" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('issn')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                </div>
                <div class="mb-4">
                    <label for="frequency" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Frequency</label>
                    <select wire:model="frequency" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($picklist['periodicity'] as $freq)
                        <option {{$freq->ID == $frequency ? 'seleted':''}}  value="{{$freq->ID}}">{{$freq->Name}}</option>
                        @endforeach
                    </select>
                    @error('frequency')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                </div>
                <div class="mb-4">
                    <label for="size" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Size</label>
                    <input wire:model="size" type="text" id="size" class="text bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('size')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

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
                        @error('RatePC')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        @error('RateNC')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        @error('RatePB')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        @error('RateNB')  <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
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
@script
<script>
    $wire.on('alert', (event) => {
  
        alert(event);
    });
</script>
@endscript
