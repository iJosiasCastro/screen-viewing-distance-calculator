<form id="calculatorSection" class="space-y-4" onsubmit="event.preventDefault(); calculate();">
    <div class="flex flex-wrap gap-2">
        <?php
            $resolutions = [
                [
                    'width' => 1366,
                    'height' => 768,
                    'name' => 'HD',
                ],
                [
                    'width' => 1699,
                    'height' => 900,
                    'name' => 'HD+',
                ],
                [
                    'width' => 1920,
                    'height' => 1080,
                    'name' => 'FHD',
                ],
                [
                    'width' => 2560,
                    'height' => 1440,
                    'name' => 'WQHD',
                ],
                [
                    'width' => 2560,
                    'height' => 1600,
                    'name' => 'WQXGA',
                ],
                [
                    'width' => 3200,
                    'height' => 1800,
                    'name' => 'QHD',
                ],
                [
                    'width' => 3840,
                    'height' => 2160,
                    'name' => 'UHD',
                ]
                
                
            ];
            foreach ($resolutions as $resolution) {
                include('./src/components/resolutionButton.php');
            }
        ?>
    </div>
    <div>
        <label for="width" class="block text-sm font-medium text-gray-700">Width</label>
        <input required type="number" id="width" name="width" value="1366" class="border border-gray-400 rounded px-3 py-2 w-full" placeholder="Enter width in pixels" required>
    </div>
    <div>
        <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
        <input required type="number" id="height" name="height" value="768" class="border border-gray-400 rounded px-3 py-2 w-full" placeholder="Enter height in pixels" required>
    </div>
    <div>
        <label for="diagonal" class="block text-sm font-medium text-gray-700">Diagonal</label>
        <div class="relative">
            <input value="24" type="number" step="0.1" id="diagonal" name="diagonal" class="border border-gray-400 rounded px-3 py-2 w-full appearance-none" placeholder="Enter diagonal length">
            <select required id="unit" name="unit" class="border border-gray-400 border-l-0 rounded-r w-24 absolute inset-y-0 right-0 px-2 py-2 bg-transparent text-gray-500">
                <option value="inches">inches</option>
                <option value="cm">cm</option>
            </select>
        </div>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Calculate</button>
</form>