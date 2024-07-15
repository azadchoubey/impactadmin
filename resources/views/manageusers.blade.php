@extends('layouts.default')

@section('content')

<div class="w-9/12 mx-auto p-8">
    @if(session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">{{ session()->get('success') }}</span>
    </div>
    @endif
    @if($errors->has('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">{{ $errors->first('error') }}</span>
    </div>
    @endif

    <table id="users" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User ID
                </th>
                <th scope="col" class="px-6 py-3">
                    User Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Profile
                </th>

                <th scope="col" class="px-6 py-3">
                    Remote Profile
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="user-table-body">
            @foreach($users as $user)

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->UserId}}
                </th>
                <td class="px-6 py-4">
                    {{$user->UserName}}
                </td>
                <td class="px-6 py-4">
                    {{$user->Profile}}
                </td>
                <td class="px-6 py-4">
                    {{$user->Remoteuser[0]->Name}}
                </td>
                <td class="px-6 py-4 flex">
                    {!! $user->status?'<div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Enable':'<div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Disable' !!}
                </td>
                <td class="px-6 py-4">
                    <button data-modal-target="edituser" data-modal-toggle="edituser" class="px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-white-600" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                <line x1="16" y1="5" x2="19" y2="8" />
                            </svg> Edit
                        </div>
                    </button>
                    @if($user->status)
                    <button onclick="enabledisable(`{{route('enabledisable',$user->Id)}}`)" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <div class="flex items-center">
                        <svg class="h-4 w-4 text-white-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd"/>
</svg>

                            Disable
                        </div>
                    </button >
                        @else
                        <button onclick="enabledisable(`{{route('enabledisable',$user->Id)}}`)" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <div class="flex items-center">
                        <svg class="h-4 w-4 text-white-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
</svg>
                             Enable
                        </div>
                        </button>
                        @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
      
    <!-- Edit Main modal -->
    <div id="edituser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit User
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edituser">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="manageuser" >
                        @csrf
                        <div class="grid grid-cols-2">
                            <div class="grid grid-cols-1 mt-4 mx-auto w-80 gap-3">
                                <div>
                                    <label for="userid" class="block text-sm font-medium text-gray-700">Users Id</label>
                                    <input autocomplete="off" id="userid" name="userid" value="{{old('userid')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                  
                                    <div id="userid-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                </div>
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">User Name</label>
                                    <input autocomplete="off" 
                                    
                                    id="username" name="username" value="{{old('username')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   
                                    <div id="username-error"  class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                   
                                </div>

                                <div>
                                    <label for="profile" class="block text-sm font-medium text-gray-700">Profile</label>
                                    <select id="profile" onchange="profileeditchange(this.value)" name="profile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        @foreach($profiles['profile'] as $profile)
                                        <option {{old('profile') == $profile->ID ? 'seleted':''}} value="{{$profile->ID}}">{{$profile->Name}}</option>
                                        @endforeach
                                    </select>
                               
                                    <div  id="profile-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                   
                                </div>

                                <div class="hidden editremoteprofile" >
                                    <label for="remoteprofile" class="block text-sm font-medium text-gray-700">Remote Profile</label>
                                    <select disabled id="remoteprofile" name="remoteprofile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($profiles['remote profile'] as $profile)
                                        <option {{old('remoteprofile') == $profile->ID ? 'seleted':''}} value="{{$profile->ID}}">{{$profile->Name}}</option>
                                        @endforeach
                                    </select>
                                    <div  id="remoteprofile-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                </div>
                               

                            </div>

                        </div>
                        <div class="text-right">
                            <button type="button" onclick="editsuer()" class="mt-4 px-4 py-3 text-xs font-medium text-right text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-white-600" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                        <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                    Edit User
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Main modal -->
    <div id="adduser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add User
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="adduser">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="adduserform" >
                        @csrf
                        <div class="grid grid-cols-2">
                            <div class="grid grid-cols-1 mt-4 mx-auto w-80 gap-3">
                                <div>
                                    <label for="userid" class="block text-sm font-medium text-gray-700">Users Id</label>
                                    <input autocomplete="off"  name="userid" value="{{old('userid')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                  
                                    <div id="userid-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                </div>
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">User Name</label>
                                    <input autocomplete="off" 
                                    
                                     name="username" value="{{old('username')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   
                                    <div id="username-error"  class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                   
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input autocomplete="off" 
                                    
                                     name="password" value="{{old('password')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   
                                    <div id="password-error"  class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                   
                                </div>
                                <div>
                                    <label for="profile" class="block text-sm font-medium text-gray-700">Profile</label>
                                    <select id="addprofile" name="profile" onchange="profileaddchange(this.value)"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($profiles['profile'] as $profile)
                                        <option {{old('profile') == $profile->profile ? 'seleted':''}} value="{{$profile->profile}}">{{$profile->profile}}</option>
                                        @endforeach
                                    </select>
                               
                                    <div  id="profile-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                   
                                </div>

                                <div  class="hidden addremoteprofile">
                                    <label for="remoteprofile" class="block text-sm font-medium text-gray-700">Remote Profile</label>
                                    <select id="addremoteprofile" disabled  name="remoteprofile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($profiles['remote profile'] as $profile)
                                        <option {{old('remoteprofile') == $profile->ID ? 'seleted':''}} value="{{$profile->ID}}">{{$profile->Name}}</option>
                                        @endforeach
                                    </select>
                                    <div  id="remoteprofile-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></div>
                                </div>
                               

                            </div>

                        </div>
                        <div class="text-right">
                            <button type="button" onclick="adduser()" class="mt-4 px-4 py-3 text-xs font-medium text-right text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <div class="flex items-center">
                                <svg class="h-4 w-4 text-white-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /> <circle cx="8.5" cy="7" r="4" /> <line x1="20" y1="8" x2="20" y2="14" /> <line x1="23" y1="11" x2="17" y2="11" /></svg>
                                    Add User
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>

@endsection

@section('style')
<style>
    div.dt-container.dt-empty-footer tbody>tr:last-child>* {
        border-bottom: none !important;
    }
</style>
@endsection
@section('scripts')

<script>
    $(document).ready(function() {
        $('#users').DataTable({
            pagingType: 'first_last_numbers',
            layout: {
                topStart: {
                    buttons: [{
                        text: '<div class="flex items-center" data-modal-target="adduser" data-modal-toggle="adduser" ><svg class="h-4 w-4 text-white-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /> <circle cx="8.5" cy="7" r="4" /> <line x1="20" y1="8" x2="20" y2="14" /> <line x1="23" y1="11" x2="17" y2="11" /></svg> Add User</div>',
                        className: 'px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                        
                    }]
                }
            }
        });
    });

    // Event listener for the edit user button
    $('#users tbody').on('click', 'button[data-modal-target="edituser"]', function() {
        var profileOptions = `{!! json_encode($profiles['profile']) !!}`;
        var remoteprofileOptions = `{!! json_encode($profiles['remote profile']) !!}`;
        var rowData = $(this).closest('tr').find('td, th').map(function() {
            return $(this).text().trim();
        }).get();
        var profileSelect = $('#profile');
        profileSelect.empty();
        profileSelect.append('<option></option>')
        $('#userid').val(rowData[0]);
        $('#username').val(rowData[1]);
        if(rowData[2] == 'Reader'){
            $('.editremoteprofile').removeClass('hidden');
            $('#remoteprofile').prop('disabled', false);
        }else{
            $('.editremoteprofile').addClass('hidden');
            $('#remoteprofile').prop('disabled', true); 
        }
        profileOptions.forEach(function(option) {
            var selected = option.profile == rowData[2] ? 'selected' : '';
            profileSelect.append('<option value="' + option.profile + '" ' + selected + '>' + option.profile + '</option>');
        });
        var remoteprofile = $('#remoteprofile');
        remoteprofile.empty();
        remoteprofile.append('<option></option>')
        remoteprofileOptions.forEach(function(option) {
            var selected = option.Name == rowData[3] ? 'selected' : '';
            remoteprofile.append('<option value="' + option.ID + '" ' + selected + '>' + option.Name + '</option>');
        });
        var status = rowData[4];
      
        if (status.toLowerCase() == 'active') {
            $('#status').prop('checked', true); 
        } else {
            $('#status').prop('checked', false); 
        }

    });
    function editsuer(){
        var formData =  $('#manageuser').serialize();
            $.ajax({
            type: 'POST',
            url: `{{route('edituser')}}`,
            data: formData, 
            success: function(response) {
                if (response.errors) {
                    console.log(response.errors);
                    $.each(response.errors, function(key, value) {
                     
                        $('#' + key + '-error').text(value);
                    });
                } else if(response.success) {
                    window.location.reload();
                }
                console.log(response);
            },
            error: function(xhr, status, error) {

                console.error(xhr.responseText);
            }
        });
  
    }
    function adduser(){
        var formData1 =  $('#adduserform').serialize();
        $.ajax({
            url: '{{ route("adduser") }}',
            method: 'POST',
            data: formData1,
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    // Handle validation errors or other errors
                    if (response.errors) {
                        $.each(response.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    } 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function profileaddchange(value){
        if(value == 'Reader'){
            $('.addremoteprofile').removeClass('hidden');
            $('#addremoteprofile').prop('disabled', false);
        }else{
            $('.addremoteprofile').addClass('hidden');
            $('#addremoteprofile').prop('disabled', true);

        }
    }
    function profileeditchange(value){
        if(value == 'Reader'){
            $('.editremoteprofile').removeClass('hidden');
            $('#remoteprofile').prop('disabled', false);
        }else{
            $('.editremoteprofile').addClass('hidden');
            $('#remoteprofile').prop('disabled', true);

        }
    }
    function enabledisable(url){
        $.ajax({
            url:url,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection