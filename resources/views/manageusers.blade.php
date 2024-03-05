@extends('layouts.default')

@section('content')
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
<form id="manageuser" method="POST">
    @csrf
    <div class="grid grid-cols-2">
        <div class="grid grid-cols-1 mt-4 mx-auto w-80 gap-3">
            <div>
                <label for="userid" class="block text-sm font-medium text-gray-700">Users Id</label>
                <input id="userid" name="userid" value="{{old('userid')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($errors->has('userid'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('userid') }}</div>
                @endif
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">User Name</label>
                <input id="username" name="username" value="{{old('username')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($errors->has('username'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('username') }}</div>
                @endif
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" value="{{old('password')}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($errors->has('password'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div>
                <label for="confirmpassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="confirmpassword" value="{{old('confirmpassword')}}" name="confirmpassword" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($errors->has('confirmpassword'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('confirmpassword') }}</div>
                @endif
            </div>
            <div>
                <label for="profile" class="block text-sm font-medium text-gray-700">Profile</label>
                <select id="profile" name="profile" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if(!old('profile'))  
                <option value=""></option>
                @endif
                    @foreach($profiles['profile'] as $profile)
                    <option {{old('profile') == $profile->ID ? 'seleted':''}} value="{{$profile->ID}}">{{$profile->Name}}</option>
                    @endforeach
                </select>
                @if($errors->has('profile'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('profile') }}</div>
                @endif
            </div>
            <div>
                <label for="remoteprofile" class="block text-sm font-medium text-gray-700">Remote Profile</label>
                <select id="remoteprofile" name="remoteprofile" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if(!old('remoteprofile')) 
                <option value=""></option>
                @endif
                    @foreach($profiles['remote profile'] as $profile)
                    <option {{old('remoteprofile') == $profile->ID ? 'seleted':''}} value="{{$profile->ID}}">{{$profile->Name}}</option>
                    @endforeach
                </select>
                @if($errors->has('remoteprofile'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('remoteprofile') }}</div>
                @endif
            </div>
            <div class="grid grid-cols-3 mt-4 mx-auto w-80">
                <button type="button" id="edituser" class="hidden focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800">Edit</button>
                <button type="button" id="saveuser" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
                <button type="button" id="deleteuser" class="hidden focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                <button type="button" id="cancel" class="hidden focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel</button>
            </div>
        </div>
        <div class="grid grid-cols-1 mt-4 mx-auto w-80">
            <div>
                <label for="userlist" class="block text-sm font-medium text-gray-700">User List</label>
                <select name="id" onchange="selectuser(this.value)" id="userlist" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value=""></option>
                    @foreach($users as $user)
                    <option value="{{$user}}">{{$user->UserName}}</option>
                    @endforeach
                </select>
                @if($errors->has('id'))
                <div class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('id') }}</div>
                @endif
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
    function selectuser(value) {
        document.getElementById("edituser").classList.remove("hidden");
        document.getElementById("cancel").classList.remove("hidden");
        document.getElementById("deleteuser").classList.remove("hidden");
        document.getElementById('saveuser').classList.add("hidden");
        value = JSON.parse(value);
        document.getElementById('userid').value = value.UserId;
        document.getElementById('username').value = value.UserName;
        document.getElementById('password').value = value.Password;
        document.getElementById('confirmpassword').value = value.Password;
        let selectElement = document.getElementById('profile');
        for (var i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value == value.Profile) {
                selectElement.selectedIndex = i;
                break;
            }
        }
        let selectElement1 = document.getElementById('remoteprofile');

        for (var i = 0; i < selectElement1.options.length; i++) {

            if (selectElement1.options[i].value == value.RemoteProfileID) {
                selectElement1.selectedIndex = i;
                break;
            }
        }
    }
    document.getElementById('cancel').addEventListener('click', function() {
        document.getElementById('manageuser').reset();
        document.getElementById("saveuser").classList.remove("hidden");
        document.getElementById('edituser').classList.add("hidden");
        document.getElementById('cancel').classList.add("hidden");
        document.getElementById('deleteuser').classList.add("hidden");
    });

    document.getElementById('saveuser').addEventListener('click', function() {
        document.getElementById('manageuser').action = `{{route('adduser')}}`;
        document.getElementById('manageuser').submit();
    });
</script>
@endsection