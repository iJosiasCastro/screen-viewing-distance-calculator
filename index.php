<!DOCTYPE html>
<html lang="en">
<?php include('./src/components/layout/head.php') ?>

<body class="bg-gray-100 py-8 max-w-4xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4 px-2">Screen Viewing Distance Calculator</h1>
    <div class="bg-white p-8 rounded shadow-lg">
        <div id="calculatorSection">
            <?php include('./src/components/form.php') ?>
        </div>
        <div id="resultSection" style="display: none;">
            <div class="flex flex-wrap gap-3">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded flex items-center" onclick="resetCalculator()">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Back to Calculator
                </button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded flex items-center" onclick="calculate()">
                    <i class="fas fa-refresh mr-2"></i>
                    Refresh results
                </button>
            </div>
            <div class="overflow-x-auto max-w-full">
                <div style="min-width: 700px;">
                    <div id="resultSpecs" class="mt-4 flex w-full"></div>
                    <div class="grid grid-cols-3 gap-4 my-5 py-3 border-t border-b">
                        <div class="border-r">
                            <div class="flex items-center">
                                <h4 class="font-semibold mb-2">Minimum distance</h4>
                                <?php
                                    $modalTitle = "Minimum distance";
                                    $modalContent = '<div id="note-107-1"><strong>The audience should sit&nbsp;at least this distance from the screen</strong>.<br> This is the <em>Shortest Recommended Viewing Distance</em> based on Field-of-View being too wide: This distance is calculated&nbsp;on the peripheral vision field&nbsp;of view of the human eye. The average FOV&nbsp;width for the human eye is 140 degrees. The rule is that if the viewer sits any closer than this distance to the screen and looks at one side of the screen, they will not be able to see the other side of the screen with their peripheral vision. This equates to a 70-degree field of view when the person is looking at the center of the screen.</div>';
                                    include('./src/components/infoModal.php');
                                ?>
                            </div>
                            <?php
                                $id = "minimumDistance";
                                include('./src/components/sitingDistanceGraph.php');
                            ?>
                        </div>
                        <div class="border-r">
                            <div class="flex items-center">
                                <h4 class="font-semibold mb-2">Maximum distance</h4>
                                <?php
                                    $modalTitle = "Maximum distance";
                                    $modalContent = '<div><strong>The audience should sit at most&nbsp;this far&nbsp;from&nbsp;the screen</strong>. <br> This is based on THX&nbsp;<em>Longest Recommended</em> and <em>Longest Allowable</em> viewing distances: THX publishes standards to which movie theaters must adhere to receive THX certification. &nbsp;THX recommends that the back row of seats in a theater have a 36 degree or greater viewing angle and requires a minimum of a 26 degree or greater viewing angle to receive certification. (Note: sitting closer to the screen results in a wider field-of-view.)</div>';
                                    include('./src/components/infoModal.php');
                                ?>
                            </div>
                            <?php
                                $id = "maximumDistance";
                                include('./src/components/sitingDistanceGraph.php');
                            ?>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <h4 class="font-semibold mb-2">Visual Acuity distance</h4>
                                <?php
                                    $modalTitle = "Visual Acuity distance";
                                    $modalContent = '<div><strong>The Visual Acuity Distance</strong> based on <em>Visual Acuity.&nbsp;</em><br> This distance is calculated based on the reference resolving power of the eyes. The human eye with 20/20 vision can detect or resolve details as small as 1/60th of a degree of arc. This distance represents the point beyond which some details in the picture are no longer able to be resolved, so pixels begin to blend together. Closer to the screen than this may result in the need for higher resolution display. This value should&nbsp;be lowered if visual acuity is worst then 20/20, raised if visual acuity is better.</div>';
                                    include('./src/components/infoModal.php');
                                ?>
                            </div>
                            <?php
                                $id = "visualAcuityDistance";
                                include('./src/components/sitingDistanceGraph.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <small>
                It is not recommended to use this information for commercial purposes.
            </small>
        </div>
    </div>
    <div class="text-center mt-12">
        <a href="https://github.com/iJosiasCastro/screen-viewing-distance-calculator">
            <img class="w-8 mx-auto" src="/public/img/github-mark.svg" alt="GitHub"/>
            <span>
                Star the project on GitHub
            </span>
        </a>
    </div>
    <?php include('./src/components/guideModal.php') ?>
    <?php
        $PPDModal = true;
        $modalTitle = "Pixel Per Degree (PPD)";
        $modalContent = '
            <div>
                <p>Pixel Per Degree (PPD) is a metric that represents the number of pixels a screen can display within one degree of your field of vision. The higher the PPD value, the more pixels are packed into each degree of your visual field, resulting in sharper and more detailed images. Conversely, a lower PPD indicates a lower level of detail and clarity in the displayed content.</p>
                <br>
                <p>Here are some examples of PPD values and their corresponding levels of visual acuity:</p>
                <div class="max-w-full overflow-x-auto">
                    <table style="min-width: 400px;"  class="w-full bg-white border mt-4">
                        <thead class="bg-blue-500 text-white text-left">
                            <tr>
                                <th class="py-2 px-4">PPD</th>
                                <th class="py-2 px-4">Vision</th>
                                <th class="py-2 px-4">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">30 PPD</td>
                                <td class="py-2 px-4">20/40</td>
                                <td class="py-2 px-4">Poor vision</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">57 PPD</td>
                                <td class="py-2 px-4">20/21</td>
                                <td class="py-2 px-4">Apple Retina</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">60 PPD</td>
                                <td class="py-2 px-4">20/20</td>
                                <td class="py-2 px-4">Normal vision</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">80 PPD</td>
                                <td class="py-2 px-4">20/15</td>
                                <td class="py-2 px-4">Average vision</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">120 PPD</td>
                                <td class="py-2 px-4">20/10</td>
                                <td class="py-2 px-4">Practical upper limit of visual acuity</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">150 PPD</td>
                                <td class="py-2 px-4">20/8</td>
                                <td class="py-2 px-4">Theoretical upper limit of visual acuity</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        ';

        include('./src/components/infoModal.php');
    ?>
    <script>
        const buttons = document.querySelectorAll('.PPDModalButton');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('PPDModalButton').click();
            });
        });
    </script>
    <script src="/src/script/calculate.js"></script>    
    <script src="/public/js/flowbite.min.js"></script>    
</body>

</html>
