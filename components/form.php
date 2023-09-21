<form id="calculatorSection" class="space-y-4" onsubmit="event.preventDefault(); calculate();">
    <div>
        <label for="width" class="block text-sm font-medium text-gray-700">Width</label>
        <input required type="number" id="width" name="width" value="1370" class="border rounded px-3 py-2 w-full" placeholder="Enter width in pixels" required>
    </div>
    <div>
        <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
        <input required type="number" id="height" name="height" value="676" class="border rounded px-3 py-2 w-full" placeholder="Enter height in pixels" required>
    </div>
    <div>
        <label for="diagonal" class="block text-sm font-medium text-gray-700">Diagonal</label>
        <div class="relative">
            <input value="24" type="number" step="0.1" id="diagonal" name="diagonal" class="border rounded px-3 py-2 w-full appearance-none" placeholder="Enter diagonal length">
            <select required id="unit" name="unit" class="w-24 absolute inset-y-0 right-0 pr-3 mx-2 py-2 bg-transparent text-gray-500">
                <option value="inches">inches</option>
                <option value="cm">cm</option>
            </select>
        </div>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Calculate</button>
</form>