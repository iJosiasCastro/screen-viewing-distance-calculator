<!DOCTYPE html>
<html lang="en">
<?php include('./components/layout/head.php') ?>

<body class="bg-gray-100 py-8">
    <h1 class="text-2xl font-semibold mb-4 px-2 mx-auto max-w-4xl">Screen Viewing Distance Calculator</h1>
    <div class="container mx-auto max-w-4xl bg-white p-8 rounded shadow-lg">
        <div id="calculatorSection" style="display: non;">
            <?php include('./components/form.php') ?>
        </div>
        <div id="resultSection" style="display: none;">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded flex items-center" onclick="resetCalculator()">
                <i class="fas fa-chevron-left mr-2"></i>
                Back to Calculator
            </button>
            <div id="resultSpecs" class="mt-4 flex w-full">
                

            </div>
            
            <div class="grid grid-cols-3 gap-4 my-5 py-3 border-t border-b">
                <div class="border-r">
                    <h4 class="font-semibold mb-2">Minimum distance</h4>
                    <?php
                        $id = "minimumDistance";
                        include('./components/sitingDistanceGraph.php');
                    ?>
                </div>
                <div class="border-r">
                    <h4 class="font-semibold mb-2">Maximum distance</h4>
                    <?php
                        $id = "maximumDistance";
                        include('./components/sitingDistanceGraph.php');
                    ?>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Visual Acuity distance</h4>
                    <?php
                        $id = "visualAcuityDistance";
                        include('./components/sitingDistanceGraph.php');
                    ?>
                </div>
            </div>
            <small>
                The information is accurate to 99%. It is not recommended for commercial purposes.
            </small>
            
        </div>
    </div>

    <script>
        function calculate() {
            // Get input values
            let width = parseFloat(document.getElementById("width").value);
            let height = parseFloat(document.getElementById("height").value);
            let diagonal = parseFloat(document.getElementById("diagonal").value);
            const unit = document.getElementById("unit").value;

            // If the unit is cm, convert to inches and start with that
            if (unit === "cm") {
                diagonal /= 2.54;
            }
            // Calculate aspect ratio and round it to two decimal places
            const aspectRatio = width / height

            // Calculate screen width in inches
            const screenHeightInches = diagonal / Math.sqrt((aspectRatio ** 2) + 1);

            // Calculate screen height in inches
            const screenWidthInches = screenHeightInches * aspectRatio;

            // Convert screen width and height to centimeters
            const screenHeightCm = screenHeightInches * 2.54;
            const screenWidthCm = screenWidthInches * 2.54;

            // Calculate dot pitch in inches and millimeters
            let dotPitchInches = (diagonal / Math.sqrt(width ** 2 + height ** 2));
            let dotPitchMm = (dotPitchInches * 25.4);

            // Calculate PPI (Pixels Per Inch)
            const ppi = Math.sqrt((width ** 2) + (height ** 2)) / diagonal;

            // Minimum distance
            const minimumDistanceAngle = 70;

            // Maximum distance
            const maximumDistanceAngle = 26;

            // Visual Acuity distance
            const visualAcuityDistanceAngle = width / 60;

            // console.log(visualAcuityDistanceAngle)

            createGraph('minimumDistance', minimumDistanceAngle, [screenWidthInches, screenWidthCm]);
            createGraph('maximumDistance', maximumDistanceAngle, [screenWidthInches, screenWidthCm]);
            createGraph('visualAcuityDistance', visualAcuityDistanceAngle, [screenWidthInches, screenWidthCm]);

            // Display the results
            const result = `
                <div class="w-full">
                    <h3 class="text-2xl mb-2">Display details:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 md:gap-x-2">
                        <div>
                            <span class="font-semibold">Screen Diagonal:</span> ${diagonal.toFixed(1)} ${unit}<br>
                            <span class="font-semibold">Screen Resolution:</span> ${width} x ${height}<br>
                        </div>
                        <div class="row-start-2 md:row-start-1">
                            <span class="font-semibold">Screen Width:</span> ${screenWidthInches.toFixed(1)}" (${screenWidthCm.toFixed(1)}cm)<br>
                            <span class="font-semibold">Screen Height:</span> ${screenHeightInches.toFixed(1)}" (${screenHeightCm.toFixed(1)}cm)<br>
                        </div>
                        <div>
                            <span class="font-semibold">Dot Pitch:</span> ${dotPitchInches.toFixed(3)}" (${dotPitchMm.toFixed(3)}mm)<br>
                            <span class="font-semibold">PPI:</span> ${ppi.toFixed(2)}<br>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById("calculatorSection").style.display = 'none';
            document.getElementById("resultSection").style.display = '';
            document.getElementById("resultSpecs").innerHTML = result;
        }

        function resetCalculator() {
            document.getElementById("width").value = "1366";
            document.getElementById("height").value = "671";
            document.getElementById("diagonal").value = "24";
            document.getElementById("unit").value = "inches";
        
            document.getElementById("resultSection").style.display = 'none';
        
            document.getElementById("calculatorSection").style.display = '';
        }
    </script>

</body>

</html>
