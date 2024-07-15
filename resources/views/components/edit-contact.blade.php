<div id="large-modal{{$contact->contactid}}" tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-lg max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="sticky top-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-600 z-50">
                <div class="flex items-center justify-between py-2 md:p-3 rounded-t">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Edit Client Contact Name : {{ $contact->ContactName}}
                    </h3>
                    <button onclick="closeeditmodal({{$contact->contactid}})" type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal{{$contact->contactid}}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <form id="editcontact{{$contact->contactid}}">
                @csrf
                <input type="hidden" name="clientid" value="{{$client->ClientID}}">
                <div class="p-4 md:p-3">
                    <fieldset class="border border-gray-300 p-3 rounded-lg">
                        <legend class="text-sm font-medium text-gray-900">Personal Details</legend>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                <input name="ContactName" type="text" value="{{ $contact->ContactName}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="ContactName-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Mobile</label>
                                <input name="Mobile" type="text" value="{{ $contact->Mobile}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Mobile-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input name="Email" type="text" value="{{ $contact->Email}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div id="Email-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>

                            </div>
                            {{-- <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Contact Type</label>
                                <select name="ContactType" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select option</option>
                                    @if(isset($picklist['contactType']))
                                    @foreach($picklist['contactType'] as $contacttype)
                                    <option value="{{$contactType->ID}}">{{$contactType->Name}}</option>
                            @endforeach
                            @endif
                            </select>
                        </div> --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Designation</label>
                            <input name="Designation" type="text" value="{{ $contact->Designation}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Designation-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input name="Phone" type="text" value="{{ $contact->Phone}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Phone-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Company</label>
                            <input name="Company" type="text" value="{{ $contact->Company}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Company-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Fax</label>
                            <input name="Fax" type="text" value="{{ $contact->Fax}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Fax-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Address 1</label>
                            <input name="Address1" type="text" value="{{ $contact->Address1}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Address1-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Address 2</label>
                            <input name="Address2" type="text" value="{{ $contact->Address2}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Address2-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Address 3</label>
                            <input name="Address3" type="text" value="{{ $contact->Address3}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Address3-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Country</label>
                            <select name="CountryID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($picklist['country'] as $country)
                                <option {{$contact->CountryID == $country->ID?'selected':''}} value="{{$country->ID}}">{{$country->Name}}</option>
                                @endforeach
                            </select>
                            <div id="CountryID-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">City</label>
                            <select name="CityID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($picklist['city'] as $City)
                                <option {{$contact->CityID == $City->ID?'selected':''}} value="{{$City->ID}}">{{$City->Name}}</option>
                                @endforeach
                            </select>
                            <div id="CityID-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Country Code</label>
                            <input name="CountryCode" type="text" value="{{ $contact->CountryCode}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="CountryCode-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Area Code</label>
                            <input name="Pin" type="text" value="{{ $contact->Pin}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div id="Pin-error{{$contact->contactid}}" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                        </div>
                </div>
                </fieldset>
                <fieldset class="border border-gray-300 p-3 rounded-lg">
                    <legend class="text-sm font-medium text-gray-900">User Login Information</legend>
                    <div class="grid grid-cols-3 gap-4 mt-3">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Userid</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$contact->userid}}" disabled>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Change Password?</label>
                            <input name="password" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border border-gray-300 p-3 rounded-lg">
                    <legend class="text-sm font-medium text-gray-900">Enable Others Parameters</legend>
                    <div class="grid grid-cols-3 gap-4 mt-3">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Broadcast</label>
                            <input name="enableforbr" {{ $contact->enableforbr ? 'checked' : '' }} type="checkbox" value="1">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Media Touch</label>
                            <input name="enableformediatouch" {{ $contact->enableformediatouch ? 'checked' : '' }} value="1" type="checkbox">
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Smartdash</label>
                            <input name="dashboard" {{ $contact->dashboard ? 'checked' : '' }} type="checkbox" value="1">
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">YouTube</label>
                            <input name="enableforyoutube" {{ $contact->enableforyoutube ? 'checked' : '' }} type="checkbox" value="1">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">DYNA</label>
                            <input name="enablefordidyounotice" {{ $contact->enablefordidyounotice ? 'checked' : '' }} type="checkbox" value="1">
                        </div>
                        <div class="{{$client->enablefortwitter == 1 ? '' : 'disabled'}}">
                            <label for="type" class="block text-sm font-medium text-gray-700">Twitter</label>
                            <input name="enablefortwitter" type="checkbox" value="1" {{$client->enablefortwitter == 1 ? 'checked' : ''}} {{$client->enablefortwitter == 1 ? '' : 'disabled'}}>
                        </div>

                </fieldset>
                <fieldset class="border border-gray-300 p-2 rounded-lg" {{$client->wm_enableforprint == 1 ? '' : 'disabled'}}>
                    <legend class="text-sm font-medium text-gray-900">Print Monitoring Parameters</legend>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Enable for Print</label>
                            <input name="wm_enableforprint" value="1" type="checkbox" {{$client->wm_enableforprint == 1 ? 'checked' : ''}} {{$client->wm_enableforprint == 1 ? '' : 'disabled'}}>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Print</label>
                            <select name="wm_deliverymethod" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{$client->wm_enableforprint == 1 ? '' : 'disabled'}}>
                                @foreach($picklist['delivery method'] as $Delivery)
                                <option {{ $contact->DeliveryID == $Delivery->ID ? 'selected' : '' }} value="{{$Delivery->ID}}">{{$Delivery->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border border-gray-300 p-2 rounded-lg">
                    <legend class="text-sm font-medium text-gray-900">Custom Digest</legend>
                    <div class="flex flex-wrap justify-between items-center">
                        {{-- <div class="w-full sm:w-auto mb-4 sm:mb-0">
                                <label for="type" class="block text-sm font-medium text-gray-700">Enable for custom digest</label>
                                <input name="wm_enableforweb" value="1" type="checkbox" {{$contact->delivery->isNotEmpty() ? 'checked' : ''}}>
                    </div>
                    <div class="w-full sm:w-auto mb-4 sm:mb-0">
                        <label for="format" class="block text-sm font-medium text-gray-700">Format</label>
                        <select name="format" onchange="selectFormat(this.value,'{{$contact->contactid}}')" id="format" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select format</option>
                            @foreach($formats as $format)
                            <option value="{{$format->id}}" data-delivery="{{$format->deliverymethod}}">{{$format->format_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-auto mb-4 sm:mb-0">
                        <label for="delivery_method" class="block text-sm font-medium text-gray-700">Delivery Method</label>
                        <select name="deliveryid[]" id="delivery_method" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select delivery method(s)</option>
                            @foreach($deliverymaster as $delivery)
                            <option value="{{ $delivery->id }}">{{ $delivery->deliverytime }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-auto">
                        <button data-modal-target="static-modal{{$contact->contactid}}" data-modal-toggle="static-modal{{$contact->contactid}}" onclick="closeModal({{$contact->contactid}})" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            View Formats
                        </button>
                    </div> --}}
                    <div class="w-full  text-sm font-medium">
                        <div class="border border-gray-400">
                            <div class=" flex">
                                <div class="w-1/2 px-2 py-2 border border-gray-400">Formats</div>
                                <div class="w-1/2 px-2 py-2 border border-gray-400">Timings</div>
                                <div class="w-1/2 px-2 py-2 border border-gray-400">Action</div>
                            </div>
                            @php
                            if($contact->delivery->isNotEmpty()){
                            $formats = $contact->delivery->pluck('format')->implode(', ');
                            }else{
                            $formats = $contact->delivery;
                            }

                            @endphp

                            @php
                            $deliveryTimes =$contact->delivery->pluck('deliveryformats.deliverytime')->implode(', ');
                            @endphp
                            <div class="flex">
                                <div class="w-1/2 px-2 py-2 border border-gray-400">P{{$formats}}</div>
                                <div class="w-1/2 px-2 py-2 border border-gray-400">{{$deliveryTimes}}</div>
                                <div class="w-1/2 px-2 py-2 border border-gray-400">Edit</div>
                            </div>




                        </div>
                    </div>
        </div>
        </fieldset>
        <fieldset class="border border-gray-300 p-2 rounded-lg">
            <legend class="text-sm font-medium text-gray-900">Web Monitoring Parameters</legend>
            <div class="grid grid-cols-4 gap-4">
                <div class="{{$client->wm_enableforweb == 1 ? '' : 'disabled'}}">
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Web</label>
                    <input name="wm_enableforweb" type="checkbox" value="1" {{$client->wm_enableforweb == 1 ? 'checked' : ''}} {{$client->wm_enableforweb == 1 ? '' : 'disabled'}}>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Delivery Method Web</label>
                    <select name="wm_deliveryids[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($webdeliverymaster as $delivery)
                        <option {{ $contact->regularDigestWeb->pluck('deliveryid')->contains($delivery->id) ? 'selected' : '' }} value="{{$delivery->id}}">{{$delivery->deliverytime}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
        </fieldset>

        <fieldset class="border border-gray-300 p-2 rounded-lg" {{$client->enableforwhatsapp == 1 ? '' : 'disabled'}}>
            <legend class="text-sm font-medium text-gray-900">WhatsApp Monitoring Parameters</legend>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Enable for Whatsapp</label>
                    <input name="enableforwhatsapp" value="1" type="checkbox" value="1" {{$client->enableforwhatsapp == 1 ? 'checked' : ''}} {{$client->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Send welcome message</label>
                    <input name="whatsappwelcomemsg" value="1" type="checkbox" {{$client->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Phone No</label>
                    <input name="whatsappnumber" type="text" value="{{ $contact->whatsappnumber }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{$client->enableforwhatsapp == 1 ? '' : 'disabled'}}>
                </div>

            </div>
            <fieldset class="border border-gray-300 p-2 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Print</legend>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_print_company" value="2" type="radio" {{$contact->whatsapp_print_company ==2 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_print_company" value="1" type="radio" {{$contact->whatsapp_print_company ==1 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_print_company" value="0" type="radio" {{$contact->whatsapp_print_company ==0 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_print_competitor" value="2" type="radio" {{$contact->whatsapp_print_competitor == 2 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_print_competitor" value="1" type="radio" {{$contact->whatsapp_print_competitor == 1 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_print_competitor" value="0" type="radio" {{$contact->whatsapp_print_competitor == 0 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_print_industry" value="2" type="radio" {{$contact->whatsapp_print_industry == 2 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_print_industry" value="1" type="radio" {{$contact->whatsapp_print_industry == 1 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_print_industry" value="0" type="radio" {{$contact->whatsapp_print_industry == 0 ? 'checked' : ' '}}>
                    </div>

                </div>
            </fieldset>
            <fieldset class="border border-gray-300 p-2 rounded-lg">
                <legend class="text-sm font-medium text-gray-900">Web</legend>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Company News</label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_web_company" value="2" type="radio" {{$contact->whatsapp_web_company == 2 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_web_company" value="1" type="radio" {{$contact->whatsapp_web_company == 1 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_web_company" value="0" type="radio" {{$contact->whatsapp_web_company == 0 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Competitor News</label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_web_competitor" value="2" type="radio" {{$contact->whatsapp_web_competitor == 2 ? 'checked' : ' '}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_web_competitor" value="1" type="radio" {{$contact->whatsapp_web_competitor == 1 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_web_competitor" value="0" type="radio" {{$contact->whatsapp_web_competitor == 0 ? 'checked' : ' '}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Industry News </label>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">Prominent News</label>
                        <input name="whatsapp_web_industry" value="2" type="radio" {{$contact->whatsapp_web_industry == 2 ? 'checked' : ''}}>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">All News</label>
                        <input name="whatsapp_web_industry" value="1" type="radio" {{$contact->whatsapp_web_industry == 1 ? 'checked' : ''}}>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-small text-gray-700">None</label>
                        <input name="whatsapp_web_industry" value="0" type="radio" {{$contact->whatsapp_web_industry == 0 ? 'checked' : ''}}>
                    </div>
                </div>
            </fieldset>
        </fieldset>
    </div>

    <div class="flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
        <button type="button" onclick="editcontact({{$contact->contactid}})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
    </div>

    </form>
</div>
</div>
</div>
<x-digestpopup :digest="$contact" />
<script>
    var modalid = null;

    function closeModal(id) {
        modalid = id;
        const $targetEl = document.getElementById(`large-modal${id}`);
        const modal = new Modal($targetEl);
        modal.hide();

    }

    function clodestaticmodal() {
        const $targetEl = document.getElementById(`large-modal${modalid}`);
        const modal = new Modal($targetEl);
        modal.show();
    }

    function closeeditmodal(id) {
        const $targetEl = document.getElementById(`large-modal${id}`);
        const modal = new Modal($targetEl);
        modal.hide();
    }

    function selectFormat(id, contactid) {
        if (id !== '') {
            $.ajax({
                url: '{{ route("getdelivery") }}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    id: id,
                    _token: '{{ csrf_token() }}',
                    contactid: contactid
                }),
                success: function(resultData) {
                    $('#delivery_method option:selected').prop('selected', false);
                    resultData.forEach(function(data) {
                        $('#delivery_method option[value="' + data + '"]').prop('selected', true);
                    });
                },
                error: function(error) {
                    alert(error);
                }
            });
        }
    }
</script>