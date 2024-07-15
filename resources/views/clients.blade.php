@extends('layouts.default')

@section('content')
@php
    $keywordtypes = \App\Models\Picklist::where('type','keyword Type')->orderBy('Name')->get();
    $keywordcategories = \App\Models\Picklist::where('type','keyword category')->orderBy('Name')->get();
    @endphp
<x-sticky-header title="Client Profile" subtitle="" name="Client Name : {{ $data->Name }} - {{$data->ClientID}}" />
<div id="deleteConfirmModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-10">
    <div class="bg-white p-4 rounded-lg">
        <p>Are you sure you want to delete this account?</p>
        <div class="flex justify-end mt-4">
            <button id="confirmDelete" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Yes</button>
            <button id="cancelDelete" class="bg-gray-300 text-black px-4 py-2 rounded">No</button>
        </div>
    </div>
</div>
<div class="container mx-auto px-3 bg-white rounded-md shadow-md">
@if(session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">{{ session()->get('success') }}</span>
    </div>
    @endif
    @if($errors->has('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">{{ session()->get('error') }}</span>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="media-universe" data-tabs-target="#mediauniverse" type="button" role="tab" aria-controls="mediauniverse" aria-selected="{{ request()->query('mediauniverse') ? 'true' : 'false' }}">Client Media Universe</button>
                </li>
            </ul>
        </div>

        <div id="default-tab-content">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form id="clientForm" action="{{ route('editclient',$data->ClientID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                            <input value="{{$data->ClientID}}" id="client_id" name="client_id" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div disabled>
                            <label for="broadcast" class="block text-sm font-medium text-gray-700">Broadcast</label>
                            <div class="flex items-center">
                                <input type="checkbox" {{$data->broadcastcid?'checked':''}} id="broadcastCheckbox" class="mr-2" disabled>
                                <input type="text" value="{{ $data->broadcastcid }}" id="broadcastText" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </div>
                        </div>

                        <div>
                            <label for="primary" class="block text-sm font-medium text-gray-700">Primary Client</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="primary" {{$data->PriClientID ? 'checked' : ''}} id="primaryCheckbox" class="mr-2" disabled>
                                <select name="primary_client_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    @foreach($clients as $client)
                                    <option {{$data->PriClientID == $client->ClientID}} value="{{$client->ClientID}}">{{$client->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                           
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="Name" value="{{$data->Name}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        
                        <div>
                            <label for="sector" class="block text-sm font-medium text-gray-700">Industory / Sector</label>
                            <select name="SectorPid" id="SectorPid" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                <option value="">Select Option</option>
                                @foreach($picklist['sector'] as $sector)
                                    <option {{$data->sector->ID == $sector->ID ? 'selected' : ''}} value="{{$sector->ID}}">{{$sector->Name}}</option>
                                @endforeach
                            </select>
                            @error('SectorPid') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        </div>
                        
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No</label>
                            <input name="Mobile"  value="{{$data->Mobile}}"type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('Mobile') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                        </div>
                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                            <select disabled name="Reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            @foreach($picklist['client source'] as $source)
                            <option {{$data->Reference == $source->ID ?'selected':''}} value="{{$source->ID}}">{{$source->Name}}</option>
                            @endforeach
                        </select>
                        @error('Reference') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        </div>
                     
                        <div>
                            <label for="contractstart" class="block text-sm font-medium text-gray-700">Contract Start</label>
                            <input name="contractstart" id="contractstart" value="{{$data->StartDate}}" disabled type="date"class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select disabled name="Type" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Option</option>
                            @foreach($picklist['client type'] as $type)
                            <option {{$type->ID ==$data->Type ? 'selected':''}} value="{{$type->ID}}">{{$type->Name}}</option>
                            @endforeach
                         </select>
                        @error('Type') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        </div>                    
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <input id="currency" name="Currency" value="{{$data->Currency}}" type="text" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('Currency') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror

                        </div>
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                            <select disabled name="Region" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($picklist['region'] as $region)
                            <option value="{{$region->ID}}">{{$region->Name}}</option>
                            @endforeach
                        </select>
                        @error('Region') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                        </div>
                       
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700">Client Logo</label>
                            <input id="client" type="file" name="Logo" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>                        
                        
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
                        <fieldset class="border border-gray-300 p-6 rounded-lg" disabled>
                            <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                                <input type="checkbox" name="wm_enableforprint" value="1" {{$data->wm_enableforprint == 1 ? 'checked' : ''}} disabled>
                            </div>                
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                                    <input type="date" name="StartDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->StartDate ?? '' }}" disabled>
                                </div>
                                
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                                    <input type="date" name="EndDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->EndDate ?? '' }}" disabled>
                                </div>
                                <div>
                                    <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                                    <select name="BillCycleID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                        <option value=""></option>
                                        @foreach($picklist['bill cycle'] as $billingcycle)
                                        <option value="{{$billingcycle->ID}}" {{$billingcycle->ID == $data->BillCycleID ? 'selected' : ''}}>{{$billingcycle->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('BillCycleID') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                                </div>
                                
                                <div>
                                    <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                                    <input name="BillDate" id="billingcycle" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->BillDate ?? '' }}" disabled>
                                </div>
                                <div>
                                    <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                                    <input id="billingrate" type="text" name="BillRate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"value="{{ $data->BillRate ?? '' }}" disabled>
                                </div>
                                <div>
                                    <label for="print" class="block text-sm font-medium text-gray-700">Print Status</label>
                                    <select name="Status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                        @foreach($picklist['client status'] as $status)
                                        <option {{$data->Status == $status->ID ?'selected':''}} value="{{$status->ID}}">{{$status->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                                </div>
                            </div>
                        </fieldset>
                        
            <fieldset class="border border-gray-300 p-6 rounded-lg" disabled>
                <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                    <input type="checkbox" name="wm_enableforweb" value="1" {{$data->wm_enableforweb == 1 ? 'checked' : ''}}>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" name="wm_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_contractstartdate ?? ''}}">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" name="wm_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_contractenddate ?? ''}}">
                    </div>
                    <div>
                        <label for="billingcycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                        <select name="wm_billingcycle" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($picklist['bill cycle'] as $billingcycle)
                            <option value="{{$billingcycle->ID}}" {{$billingcycle->ID == $data->wm_billingcycle ? 'selected' : ''}}>{{$billingcycle->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="billingdate" class="block text-sm font-medium text-gray-700">Billing Date</label>
                        <input name="wm_billingdate" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_billingdate ?? ''}}">
                    </div>
                    <div>
                        <label for="billingrate" class="block text-sm font-medium text-gray-700">Billing Rate</label>
                        <input id="" type="text" name="wm_billingrate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_billingrate}}">
                    </div>
                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Web Status</label>
                        <select name="wm_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($picklist['client status'] as $status)
                            <option value="{{$status->ID}}" {{$data->wm_status == $status->ID ? 'selected' : ''}}>{{$status->Name}}</option>
                            @endforeach
                        </select>
                        @error('wm_status') <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span> </p> @enderror
                    </div>
                </div>
            </fieldset>
            
            <fieldset class="border border-gray-300 p-6 rounded-lg" disabled>
                <legend class="text-sm font-medium text-gray-900">Twitter Monitoring Parameters</legend>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Twitter</label>
                    <input type="checkbox" name="enablefortwitter" value="1" {{$data->enablefortwitter == 1 ? 'checked' : ''}}>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract S-Date</label>
                        <input type="date" name="wm_twitter_contractstartdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_twitter_contractstartdate ?? ''}}">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Contract E-Date</label>
                        <input type="date" name="wm_twitter_contractenddate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$data->wm_twitter_contractenddate ?? ''}}">
                    </div>
                    <div>
                        <label for="webstatus" class="block text-sm font-medium text-gray-700">Twitter Status</label>
                        <select name="wm_twitter_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option></option>
                            @foreach($picklist['client status'] as $status)
                            <option {{$data->wm_twitter_status == $status->ID ? 'selected' : ''}} value="{{$status->ID}}">{{$status->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
            
            <fieldset class="border border-gray-300 p-6 rounded-lg" disabled>
                <legend class="text-sm font-medium text-gray-900 ">Other Monitoring Parameters Enable For</legend>
                <div class="flex items-center gap-2">
                    <label for="type" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                    <input type="checkbox" name="enableforwhatsapp" value="1" {{$data->enableforwhatsapp == 1 ? 'checked' : ''}}>
                    <label for="type" class="block text-sm font-medium text-gray-700"> YouTube</label>
                    <input type="checkbox" name="enableforyoutube" value="1" {{$data->enableforyoutube == 1 ? 'checked' : ''}}>
                    <label for="type" class="block text-sm font-medium text-gray-700"> YouTube</label>
                    <input type="checkbox" name="enableforyoutube" value="1" {{$data->enableforyoutube == 1 ? 'checked' : ''}}>
                    <label for="type" class="block text-sm font-medium text-gray-700">DYNA</label>
                    <input type="checkbox" name="enablefordidyounotice" value="1" {{$data->enablefordidyounotice == 1 ? 'checked' : ''}}>
                    <label for="type" class="block text-sm font-medium text-gray-700">Fulltext</label>
                    <input type="checkbox" name="enableforfulltext" value="1" {{$data->enableforfulltext == 1 ? 'checked' : ''}}>
                </div>
              
            </fieldset>
            
        </div>
                    <div class="flex justify-end space-x-2">
                        <button id="save" type="submit" class="hidden inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        <button type="button" onclick="enableAllDisabledItems()" id="editbtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                        <button type="button" id="deleteButton"  class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-white-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg> Delete</button>
                    </div>
                </form>

            </div>
            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton" data-modal-target="large-modal" data-modal-toggle="large-modal" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                   
                  
                    <table id="contacts" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <!-- <th scope="col" class="px-6 py-3">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" class="form-checkbox">
                            </th> -->
                            <th scope="col" class="px-6">Contact Name</th>
                            <th scope="col" class="px-6">Print</th>
                            <th scope="col" class="px-6">Web</th>
                            <th scope="col" class="px-6">Br</th>
                            <th scope="col" class="px-6">Twitter</th>
                            <th scope="col" class="px-6">Youtube</th>
                            <th scope="col" class="px-6">Smartdash</th>
                            <th scope="col" class="px-6">Whatsapp</th>
                            <th scope="col" class="px-6">Mediatouch</th>
                            <th scope="col" class="px-6">Dyna</th>
                            <th scope="col" class="px-6">Custom Digest</th>
                            <th scope="col" class="px-6">Action</th>
                        </thead>
                        <tbody>

                            @foreach($contacts as $contact)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <!-- <td class="px-6 py-4">
                                    <input type="checkbox" onchange="updateEditButtonVisibility()" value="{{$contact->contactid}}" class="form-checkbox checkboxes">
                                </td> -->
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $contact->ContactName}}</td>
                                
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->wm_enableforprint?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->wm_enableforweb?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforbr?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enablefortwitter?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforyoutube?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->dashboard?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableforwhatsapp?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enableformediatouch?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->enablefordidyounotice?$check:$cross !!}</td>
                                <td class="withoutEditSection{{$contact->contactid}} px-6 py-4">{!! $contact->delivery->isNotEmpty()?$check:$cross !!}</td>
                              
                                <td id="editButton" class="withoutEditSection{{$contact->contactid}} px-6 py-4"><a onclick="openmodal('{{$contact->contactid}}')"  data-modal-target="large-modal{{$contact->contactid}}" data-modal-toggle="large-modal{{$contact->contactid}}" href="javascript:void(0);">Edit</a></td>
                                <x-edit-contact :contact="$contact" :picklist="$picklist" :deliverymaster="$deliverymaster" :webdeliverymaster="$webdeliverymaster" :client="$data" :formats="$formats" />
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                  
                </div>

            </div>

            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <button id="editbutton1" data-modal-target="large-modal1" data-modal-toggle="large-modal1" class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                  
                    <div>
                        
                  
                        <table id="keywords" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        
                                <th scope="col" class="px-6 py-3">Keyword</th>
                                <th scope="col" class="px-6 py-3">Filter</th>
                                <th scope="col" class="px-6 py-3">Filter String</th>
                                <th scope="col" class="px-6 py-3">Type</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Company String</th>
                                <th scope="col" class="px-6 py-3">Brand String</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </thead>
                            <tbody>
                                @foreach($keywords as $keyword)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                             
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $keyword->KeyWord}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Filter}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Filter_String}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Type}}</td>
                                    <td class="px-6 py-4">{{ $keyword->Category}}</td>
                                    <td class="px-6 py-4">{{ $keyword->CompanyS}}</td>
                                    <td class="px-6 py-4">{{ $keyword->BrandS}}</td>
                                    <td class="px-6 py-4">
                                        <a href="javascript:void(0)" class="editkeyword" data-id="{{ $keyword->id }}" data-modal-target="large-modal{{$keyword->keyID}}" data-modal-toggle="large-modal{{$keyword->keyID}}" >Edit</a>
                                    </td>  
                                </tr>
                                <x-edit-keyword :keyword="$keyword"  :keywordtypes="$keywordtypes" :keywordcategories="$keywordcategories"/>
                                @endforeach
                            </tbody>
                        </table>

                
                    </div>
                </div>
            </div>
            <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="mediauniverse" role="tabpanel" aria-labelledby="media-universe">
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
    <x-createkeyword :keywordtypes="$keywordtypes" :keywordcategories="$keywordcategories"/>                            
    
    <div id="large-modal2" tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-lg max-w-4xl max-h-full">

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
                <form id="addcontact">
                    @csrf
                    <input type="hidden" name="clientid" value="{{$data->ClientID}}">
                <div class="p-4 md:p-3">
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Personal Details</legend>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                <input name="ContactName" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="ContactName-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Mobile</label>
                                <input name="Mobile" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Mobile-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input name="Email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Email-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                            </div>
                            {{-- <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Type</label>
                                <select name="ContactType" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @if(isset($picklist['contacttype']))
                                    @foreach($picklist['contacttype'] as $contacttype)
                                    <option value="{{$contacttype->ID}}">{{$contacttype->Name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Designation</label>
                                <input name="Designation" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Designation-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input name="Phone" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Phone-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Company</label>
                                <input name="Company" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Company-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Fax</label>
                                <input name="Fax" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Fax-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 1</label>
                                <input name="Address1" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Address1-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 2</label>
                                <input name="Address2" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Address2-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Address 3</label>
                                <input name="Address3" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Address3-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Country</label>
                                <select name="CountryID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['country'] as $country)
                                    <option value="{{$country->ID}}">{{$country->Name}}</option>
                                    @endforeach
                                </select>
                                <div id="CountryID-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">City</label>
                                <select name="CityID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($picklist['city'] as $City)
                                    <option value="{{$City->ID}}">{{$City->Name}}</option>
                                    @endforeach
                                </select>
                                <div id="CityID-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Country Code</label>
                                <input name="CountryCode" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="CountryCode-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Area Code</label>
                                <input name="Pin" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Pin-error1" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Enable Others Parameters</legend>
                        <div class="grid grid-cols-3 gap-2 mt-3">
                           
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Broadcast</label>
                                <input name="enableforbr" type="checkbox" value="1">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Media Touch</label>
                                <input name="enableformediatouch" value="1" type="checkbox">
                            </div>
                        
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Smartdash</label>
                                <input name="dashboard" type="checkbox" value="1">
                            </div> 
                           
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">YouTube</label>
                                <input name="enableforyoutube" type="checkbox" value="1">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">DYNA</label>
                                <input name="enablefordidyounotice" type="checkbox" value="1">
                            </div>
                            <div class="{{$data->enablefortwitter == 1 ? '' : 'disabled'}}">
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Twitter</label>
                                <input name="enablefortwitter" type="checkbox" value="1" {{$data->enablefortwitter == 1 ? 'checked' : ''}} {{$data->enablefortwitter == 1 ? '' : 'disabled'}}>
                            </div>
                           
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-6 rounded-lg"{{$data->wm_enableforprint == 1 ? '' : 'disabled'}}>
                        <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                                <input name="wm_enableforprint" value="1" type="checkbox" {{$data->wm_enableforprint == 1 ? 'checked' : ''}} {{$data->wm_enableforprint == 1 ? '' : 'disabled'}}>
                            </div>
                    
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Print</label>
                                <select name="deliverymethod" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{$data->wm_enableforprint == 1 ? '' : 'disabled'}}>
                                    <option value="">Select option</option>
                                    @foreach($picklist['delivery method'] as $Delivery)
                                    <option value="{{$Delivery->ID}}">{{$Delivery->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-gray-300 p-3 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Custom Digest</legend>
                        <div class="grid grid-cols-3 gap-2 mt-4">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for custom digest</label>
                                <input name="wm_enableforweb" value="1" type="checkbox" {{$data->wm_enableforweb == 1 ? '' : 'disabled'}}>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Formats </label>
                                <select name="format" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($formats as $format)
                                    <option value="{{$format->id}}">{{$format->format_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method</label>
                                <select name="deliveryid[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                    <option value="">Select option</option>
                                    @foreach($deliverymaster as $Delivery)
                                    <option value="{{$Delivery->id}}">{{$Delivery->deliverytime}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </fieldset>
             
                    <fieldset class="border border-gray-300 p-3 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
                        <div class="grid grid-cols-4 gap-4 mt-3">
                            <div class="{{$data->wm_enableforweb == 1 ? '' : 'disabled'}}">
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                                <input name="wm_enableforweb" type="checkbox" value="1" {{$data->wm_enableforweb == 1 ? 'checked' : ''}} {{$data->wm_enableforweb == 1 ? '' : 'disabled'}}>
                            </div>
                           
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Web</label>
                                <select name="wm_deliveryids[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @foreach($webdeliverymaster as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->deliverytime}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border border-gray-300 p-3  rounded-lg"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                        <legend class="text-sm font-medium text-gray-900">WhatsApp Monitoring Parameters</legend>
                        <div class="grid grid-cols-3 gap-4 mt-3">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for Whatsapp</label>
                                <input name="enableforwhatsapp" value="1" type="checkbox" value="1" {{$data->enableforwhatsapp == 1 ? 'checked' : ''}} {{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Send welcome message</label>
                                <input name="whatsappwelcomemsg" value="1" type="checkbox"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Phone No</label>
                                <input name="whatsappnumber" type="text" placeholder="E.g. 919811223344" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                            </div>

                        </div>
                        <fieldset class="border border-gray-300 p-3 rounded-lg">
                            <legend class="text-sm font-medium text-gray-900">Print</legend>
                            <div class="grid grid-cols-4 gap-4 mt-3">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_print_company" value="2" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                              
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_print_company" value="1"  type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_print_company" value="0" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_print_competitor" value="2" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_print_competitor" value="1" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_print_competitor" value="0" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_print_industry" value="2" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_print_industry" value="1" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                         
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_print_industry" value="0" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-gray-300 p-6 rounded-lg">
                            <legend class="text-sm font-medium text-gray-900">Web</legend>
                            <div class="grid grid-cols-4 gap-4 mt-3">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_web_company" value="0"  type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_web_company" value="1"  type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_web_company" value="2"  type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_web_competitor" value="0" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_web_competitor" value="1" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_web_competitor" value="2" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">None</label>
                                    <input name="whatsapp_web_industry" value="0" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                                    <input name="whatsapp_web_industry" value="1" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                                    <input name="whatsapp_web_industry" value="2" type="radio"{{$data->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                                </div>
                            </div>
                        </fieldset>
                    </fieldset>
                
             
                </div>

                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button  type="button" onclick="addcontact()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
                </form>
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
 

    function updateEditButtonVisibility1() {
        var checkboxes = document.querySelectorAll('.checkboxes1');
        var checkedCount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        })
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
    const checkbox = document.getElementById('primaryCheckbox');
    const select = document.querySelector('select[name="primary_client_id"]');
    
    if (checkbox.checked) {
        select.removeAttribute('disabled');
    } else {
        select.setAttribute('disabled', '');
    }

    const disabledElements = document.querySelectorAll('[disabled]');
    disabledElements.forEach(element => {
        // Check if the element is not the primary client dropdown
        if (element !== select) {
            element.removeAttribute('disabled');
        }
    });

    document.getElementById('editbtn').style.display = "none";
    document.getElementById('save').classList.remove('hidden');
    document.getElementById('client_id').setAttribute('disabled', '');
}

function openmodal(id){
        const $targetEl =  document.getElementById(`large-modal${id}`);
        const modal = new Modal($targetEl);
        modal.show();
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
        function addcontact(){
        var formData1 =  $('#addcontact').serialize();
        console.log(formData1);
        $.ajax({
            url: '{{ route("addcontact") }}',
            method: 'POST',
            data: formData1,
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                     $('#' + key + '-error1').text(value);
                 });
                    } 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
        function editcontact(id){
        var formData2 =  $(`#editcontact${id}`).serialize();
        formData2 += '&contactid=' + id;
        $.ajax({
            url: '{{ route("editcontact") }}',
            method: 'POST',
            data: formData2,
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    if (response.errors) {
                    $.each(response.errors, function(key, value) {
                        console.log($('#' + key + '-error'));

                    $(`#${key}-error${id}`).text(value);
                 });
                    } 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function saveKeywordBtn(id){
            // Gather form data
            const keyword = $(`#keyword${id}`).val();
            const filter = $(`#filterinput${id}`).val();
            const filterString = $(`#filterStringinput${id}`).val();
            const type = $(`#type${id}`).val();
            const category = $(`#category${id}`).val();
            const companyString = $(`#companyString${id}`).val();
            const brandString = $(`#brandString${id}`).val();

            // Send AJAX request to save the keyword
            $.ajax({
                url: `{{route('edit.keyword')}}`,
                method: 'POST',
                data: {
                    keyid:id,
                    keyword: keyword,
                    filter: filter,
                    filterString: filterString,
                    type: type,
                    category: category,
                    companyString: companyString,
                    brandString: brandString,
                    _token: '{{ csrf_token() }}',
                    clientid:`{{request()->route()->parameter('id')}}`
                },
                success: function(response) {
                    if(response.success){
                        window.location.reload();
                    }
                    else {
                       
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    } 
                }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    console.log(xhr.responseJSON);
                   
               
                    console.error('Error saving keyword:', error);
                }
            });
    }
    function fetchResults() {
        const keyword = $('#keyword').val().trim();
        const autocompleteList = $('#autocomplete-list');
        const resultsList = $('#results-list');
        console.log(resultsList)
        if (keyword.length > 2) {
            // Make an AJAX request to fetch autocomplete results
            $.ajax({
                url: '/api/keywordlist',
                method: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    resultsList.empty(); // Clear previous results
                    if (response.length > 0) {
                        $.each(response, function(index, result) {
                            const li = $('<li>').text(result.KeyWord);

                            li.css('padding', '8px')
                            li.on('click', function() {
                                selectResult(result.KeyWord);
                            });
                            resultsList.append(li);
                        });
                        autocompleteList.show(); // Show autocomplete list
                    } else {
                        autocompleteList.hide(); // Hide autocomplete list if no results
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching results:', error);
                }
            });
        } else {
            autocompleteList.hide(); // Hide autocomplete list if keyword length is less than 3
        }
    }

    // Define the selectResult function
    function selectResult(keyword) {
        $('#keyword').val(keyword);
        $('#autocomplete-list').hide();
        $.ajax({
            url: '/api/filter-strings',
            method: 'GET',
            data: {
                keyword: keyword
            },
            success: function(response) {
                // Populate the filter string dropdown
                const filterStringDropdown = $('#filterString');
                const filter = $('#filter');
                filterStringDropdown.empty();
                if (response.length > 0) {
                    $.each(response, function(index, filterString) {
                        const option = $('<option>').val(filterString.Filter_String).text(filterString.Filter_String);
                        const option1 = $('<option>').val(filterString.filter).text(filterString.filter);
                        filterStringDropdown.append(option);
                        filter.append(option1);
                    });
                } else {
                    // If no filter strings found, disable the dropdown
                    filterStringDropdown.prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching filter strings:', error);
            }
        });
    }

    </script>
    <script>
        // Function to enable/disable broadcast fields
        function enableBroadcastFields() {
            var checkbox = document.getElementById("broadcastCheckbox");
            var textBox = document.getElementById("broadcastText");
    
            // Enable/disable text box based on checkbox state
            textBox.disabled = !checkbox.checked;
        }
    
        // Function to handle edit button click
        function handleEditButtonClick() {
            enableBroadcastFields(); // Enable broadcast fields
        }
    
        // Function to handle checkbox change event
        function handleCheckboxChange() {
            enableBroadcastFields(); // Enable/disable text box
        }
    
        // Function to handle primary checkbox change event
        function handlePrimaryCheckboxChange() {
            var checkbox = document.getElementById('primaryCheckbox');
            var dropdown = document.querySelector('select[name="primary_client_id"]');
    
            dropdown.disabled = !checkbox.checked; // Enable/disable dropdown
        }
    
        window.onload = function() {
            // Add event listener to the "Edit" button
            document.getElementById("editbtn").addEventListener("click", function() {
                handleEditButtonClick();
            });
    
            // Add event listener to the broadcast checkbox
            document.getElementById("broadcastCheckbox").addEventListener("change", function() {
                handleCheckboxChange();
            });
    
            // Add event listener to the primary checkbox
            document.getElementById('primaryCheckbox').addEventListener('change', function() {
                handlePrimaryCheckboxChange();
            });
            $('#keyword').on('input', fetchResults);

                  // Handle "Save" button click
        $('#saveKeywordBtn').click(function() {
            // Gather form data
            const keyword = $('#keyword').val();
            const filter = $('#filterinput').val();
            const filterString = $('#filterStringinput').val();
            const type = $('#type').val();
            const category = $('#category').val();
            const companyString = $('#companyString').val();
            const brandString = $('#brandString').val();

            // Send AJAX request to save the keyword
            $.ajax({
                url: '/save-keyword',
                method: 'POST',
                data: {
                    keyword: keyword,
                    filter: filter,
                    filterString: filterString,
                    type: type,
                    category: category,
                    companyString: companyString,
                    brandString: brandString,
                    _token: '{{ csrf_token() }}',
                    clientid:`{{request()->route()->parameter('id')}}`
                },
                success: function(response) {
                    if(response.success){
                        window.location.reload();
                    }
                    else {
                       
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    } 
                }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    console.log(xhr.responseJSON);
                   
               
                    // Handle error response
                    console.error('Error saving keyword:', error);
                    // Optionally, you can show an error message to the user
                }
            });
        });
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#deleteButton').on('click', function() {
        $('#deleteConfirmModal').removeClass('hidden');
    });
    $('#keywords').DataTable({
        pagingType: 'first_last_numbers',
        layout: {
                topStart: {
                    buttons: [{
                        text: '<div class="flex items-center" id="createkeyword" data-modal-target="large-modal1" data-modal-toggle="large-modal1"  >Create Keyword</div>',
                        className: 'px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                        
                    }]
                }
            }
    });
    $('#contacts').DataTable({
        pagingType: 'first_last_numbers',
        layout: {
                topStart: {
                    buttons: [{
                        text: '<div class="flex items-center" data-modal-target="large-modal2" data-modal-toggle="large-modal2"  >Create Contact</div>',
                        className: 'px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                        
                    }]
                }
            }
    });
    $('#cancelDelete').on('click', function() {
        $('#deleteConfirmModal').addClass('hidden');
    });

    $('#confirmDelete').on('click', function() {
        var clientid = '{{ $data->ClientID }}';      
        $.ajax({
            url: `{{route('delete.client')}}`, 
            type: 'DELETE',
         
            data: {
                clientid: clientid,
                userid: '{{ auth()->user()->UserID }}'
            },
            success: function(result) {
                if(result.status) {
                    alert(result.message);
                    window.location.href = "{{ route('client') }}";
                }else{
                    alert(result.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting item:', error);
                $('#deleteConfirmModal').addClass('hidden');
            }
        });
       
    });
        $('#media-universe').on('click', function() {
        document.getElementById('processModal').classList.remove('hidden');

        $.ajax({
            url: `{{route('loadMediaUniverseContent')}}`,
            method: 'GET',
            data: {
                clientid: "{{ $data->ClientID }}",
                priority: "{{ $data->priority }}",
                restrictedmu: "{{ $data->restricted_mu }}"
            },
            success: function(data) {
                // Update the DOM with the fetched contenta
                $('#mediauniverse').html(data);

                document.getElementById('processModal').classList.add('hidden');
            },
            error: function(xhr, status, error) {
                console.error('Error loading content:', error);

                // Hide the loading spinner in case of error
                document.getElementById('processModal').classList.add('hidden');
            }
        });
    });
            const checkbox = document.getElementById('primaryCheckbox');
            const dropdown = document.querySelector('select[name="primary_client_id"]');
    
            // Initial state
            if (!checkbox.checked) {
                dropdown.disabled = true;
            }
    
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    dropdown.disabled = false;
                } else {
                    dropdown.disabled = true;
                }
            });
            $("#companyString").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('companyString') }}",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.CompanyS,
                            value: item.CompanyS
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            // Optional: handle the selection
            console.log("Selected: " + ui.item.value);
        }
        
    });
        $("#brandString").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('brandString') }}",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.BrandS,
                            value: item.BrandS
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            // Optional: handle the selection
            console.log("Selected: " + ui.item.value);
        }
        
    });
        });

    </script>

    @endsection
    @section('style')
    <style>
    fieldset[disabled] {
        opacity: 0.5; 
        pointer-events: none; 
    }
    .disabled{
        opacity: 0.5;
        pointer-events: none; 
    }

    fieldset[disabled] input,
    fieldset[disabled] label {
        cursor: not-allowed;
    }
</style>
@endsection
