<?php $buttonId = bin2hex(random_bytes(16)); ?>

<button id="<?php echo $buttonId ?>Button" type="button"  class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-2 px-4 rounded btn-sm">
    <?php echo $resolution['name'] ?>
</button>

<script>
    document.getElementById('<?php echo $buttonId ?>Button').addEventListener('click', () => {
        document.getElementById("width").value = <?php echo $resolution['width'] ?>;
        document.getElementById("height").value = <?php echo $resolution['height'] ?>;
    });
</script>