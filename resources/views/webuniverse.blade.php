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

    <table id="webuniverse" class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="width: 100% !important;">
        <thead>
            <tr>
                <th  scope="col" class="px-6 py-3">Name</th>
                <th  scope="col" class="px-6 py-3">URL</th>
                <th  scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($webuniverse as $w)
            <tr>
                
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $w->name }}</td>
                <td class="px-6 py-4">{{ $w->url }}</td>
                <td class="px-6 py-4">
                    <a href="{{route('webuniverse.view', base64_encode($w->id))}}" class="flex items-center mr-2 px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="h-4 w-4 text-white-600" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                            <line x1="16" y1="5" x2="19" y2="8" />
                        </svg> View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $webuniverse->links('vendor.pagination.tailwind') }}

</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#webuniverse').DataTable({
            paging: false,
            info: false,    
            layout: {
                topStart: {
                    buttons: [{
                        text: '<div class="flex items-center" data-modal-target="addwebuniverse" data-modal-toggle="addwebuniverse" ><svg class="h-4 w-4 text-white-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /> <circle cx="8.5" cy="7" r="4" /> <line x1="20" y1="8" x2="20" y2="14" /> <line x1="23" y1="11" x2="17" y2="11" /></svg> Add Webuniverse</div>',
                        className: ' px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',

                    }]
                }
            }
        });
    });
</script>
@endsection