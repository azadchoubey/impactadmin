@extends('layouts.default')

@section('content')
<livewire:publications />

@endsection
@section('scripts')
<script>
    function enableAllDisabledItems() {
        let disabledElements = document.querySelectorAll('[disabled]');
        disabledElements.forEach(element => {
            element.removeAttribute('disabled');
        });
        document.getElementById("cancel").classList.remove("hidden");
        document.getElementById('editbtn').classList.add("hidden")

    }

    function desableAllDisabledItems() {
        let disabledElements = document.getElementsByClassName('text');
        for (let i = 0; i < disabledElements.length; i++) {
            disabledElements[i].setAttribute("disabled", "");
        }
        document.getElementById("editbtn").classList.remove("hidden");
        document.getElementById('cancel').classList.add("hidden")


    }

    $(document).ready(function() {

        $('#publications').DataTable({
            paging: false,
    searching: false,
    info: false
        });
    });
</script>
@endsection