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
                <th scope="col" class="px-2 py-2">Name</th>
                <th scope="col" class="px-2 py-2">URL</th>
                <th scope="col" class="px-2 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be loaded here via DataTables -->
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#webuniverse').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('webuniverse.fetch') }}",
                type: 'GET',
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'url', name: 'url' },
                { 
                    data: null, 
                    render: function(data, type, row) {
                        return `
                            <a href="{{ route('webuniverse.view', '') }}/${btoa(row.id)}}" class="flex px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="h-4 w-4 text-white-600" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                    <line x1="16" y1="5" x2="19" y2="8" />
                                </svg> View
                            </a>
                        `;
                    }
                }
            ],
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                paginate: {
                    previous: '<',
                    next: '>',
                }
            }
        });
    });
</script>
@endsection
