<button id="guideModalButton" data-modal-target="guideModal" data-modal-toggle="guideModal" hidden type="button"></button>

<div id="guideModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex border-b pb-2 items-start justify-between px-4 pt-4 rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Guide
                </h3>
                <button id="closeGuideModalButton" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="guideModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="px-4 pt-2 pb-6 space-y-6">
                <p>Drag the person circle within the graph to change the distance:</p>
                <img src="/public/img/image.png" width="300px" alt="Drag to change distance in the graph">
                
                <p>If you want to reset the graph to its default view, simply click the refresh button:</p>
                <img src="/public/img/image2.png" width="150px" alt="Refresh button">
            </div>
            <div class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <div>
                    <input id="guideModalNoShowAgain" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-500 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="guideModalNoShowAgain" class="ml-1 text-sm font-medium text-gray-900 dark:text-gray-300">Don't show this again</label>
                </div>
                <button id="closeGuideModalOkayButton" onclick="closeGuideModal()" type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Okay</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    function showGuideModal(){
        const guideModalNoShowAgain = document.getElementById('guideModalNoShowAgain');
        const guideModalButton = document.getElementById('guideModalButton');

        if (localStorage.getItem('hideGuideModal') !== 'true') {
            guideModalButton.click();
        }
    }

    function closeGuideModal(){
        const closeGuideModalButton = document.getElementById('closeGuideModalButton');
        const guideModalNoShowAgain = document.getElementById('guideModalNoShowAgain');
        
        if (guideModalNoShowAgain.checked) {
            localStorage.setItem('hideGuideModal', 'true');
        }
        
        closeGuideModalButton.click();
    }

</script>