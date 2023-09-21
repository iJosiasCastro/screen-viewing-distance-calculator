<!DOCTYPE html>
<html lang="en">
<?php include('./components/layout/head.php') ?>

<body class="bg-gray-100 py-8">
    <div class="container mx-auto max-w-xl bg-white p-8 rounded shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Screen Size, Distance, and Resolution Calculator</h1>
        <div id="calculatorSection">
            <?php include('./components/form.php') ?>
        </div>
        <div id="resultSection" style="display: none;">
            <div id="resultSpecs" class="mt-4"></div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded mt-4" onclick="resetCalculator()">Back to Calculator</button>
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
            const minimumAngle = 70;
            const minimumDistance = (diagonal / 12) / (2 * Math.tan((minimumAngle * Math.PI) / 180));

            // Maximum distance
            const maximumAngle = 26;
            const maximumDistance = (diagonal / 12) / (2 * Math.tan((maximumAngle * Math.PI) / 180));

            // Visual Acuity distance
            const visualAcuityAngle = width / 60;
            const visualAcuityDistance = (diagonal / 12) / (2 * Math.tan((visualAcuityAngle * Math.PI) / 180));

            console.log('Minimum Viewing Distance:', minimumDistance.toFixed(1), 'ft');
            console.log('Maximum Viewing Distance:', maximumDistance.toFixed(1), 'ft');
            console.log('Visual Acuity Distance:', visualAcuityDistance.toFixed(1), 'ft');

            // Display the results
            const result = `
                Screen Diagonal: ${diagonal.toFixed(1)} ${unit}<br>
                Screen Resolution: ${width} x ${height}<br>
                Screen Width: ${screenWidthInches.toFixed(1)}" (${screenWidthCm.toFixed(1)}cm)<br>
                Screen Height: ${screenHeightInches.toFixed(1)}" (${screenHeightCm.toFixed(1)}cm)<br>
                Aspect Ratio: ${aspectRatio.toFixed(2)}:1 (${width}:${height})<br>
                Dot Pitch: ${dotPitchInches.toFixed(3)}" (${dotPitchMm.toFixed(3)}mm)<br>
                PPI: ${ppi.toFixed(2)}<br>
            `;

            document.getElementById("calculatorSection").style.display = 'none';
            document.getElementById("resultSection").style.display = '';
            document.getElementById("resultSpecs").innerHTML = result;
        }
    </script>

    <script>
        function resetCalculator() {
            // Clear form inputs
            document.getElementById("width").value = "";
            document.getElementById("height").value = "";
            document.getElementById("diagonal").value = "";
            document.getElementById("unit").value = "inches";

            document.getElementById("resultSection").style.display = 'none';

            document.getElementById("calculatorSection").style.display = '';
        }
    </script>

</body>

</html>
