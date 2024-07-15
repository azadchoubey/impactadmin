<div id="static-modal{{$digest->contactid}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Format Timings
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="clodestaticmodal()" data-modal-hide="static-modal{{$digest->contactid}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

    <div class="p-4 md:p-5 space-y-4">
    <div class="max-w-screen-md mx-auto">
        <div class="border border-gray-400">
            <div class="bg-gray-200 flex">
                <div class="w-1/2 px-4 py-2 border border-gray-400">Format</div>
                <div class="w-1/2 px-4 py-2 border border-gray-400">Timings</div>
            </div>
            @php
            if($digest->delivery->isNotEmpty()){
                $formats  = $digest->delivery->pluck('format')->implode(', ');
            }else{
                $formats = $digest->delivery;
            }
           
            @endphp
           
            @php
                $deliveryTimes =$digest->delivery->pluck('deliveryformats.deliverytime')->implode(', ');
            @endphp
                <div class="flex">
                <div class="w-1/2 px-4 py-2 border border-gray-400">P{{$formats}}</div>
                <div class="w-1/2 px-4 py-2 border border-gray-400">{{$deliveryTimes}}</div>
            </div>
        
             
           
           
        </div>
    </div>
</div>

               



        </div>
    </div>
</div>