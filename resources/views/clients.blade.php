@extends('layouts.default')

@section('content')
<livewire:client-profile />
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
<div id="large-modal1" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">

        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Client Keyword Create
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal1">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5 space-y-4">


            </div>

            <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="large-modal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="large-modal2" wire:ignore tabindex="-1" class="fixed top-0 left-60 right-0 z-50 w-full p-4 hidden overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">

        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Client Keyword Edit
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal1">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5 space-y-4">
            <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Keyword Name</label>
            <input  type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Keyword Name</label>
            <input  type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-lg ps-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            </div>

            <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="large-modal1" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </div>
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
        const disabledElements = document.querySelectorAll('[disabled]');
        disabledElements.forEach(element => {
            element.removeAttribute('disabled');
        });
        document.getElementById('editbtn').style.display = "none";
    }
    window.onload = (event) => {
        document.getElementById('settings-tab').addEventListener('click', function() {
            setTimeout(() => {
                document.getElementById('createkeywords').style.display = "block";
            }, 1000)

        })
    };
</script>

@endsection