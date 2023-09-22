<svg id="<?php echo $id ?>" xmlns="http://www.w3.org/2000/svg" viewBox="7.35 0 22.5 50" onload="makeDraggable(evt, '<?php echo $id ?>Data')" width="100%">
    <g>
        <text x="15" y="1" text-anchor="middle" font-size="1" class="static select-none screenSizeText">7.0" (17.7cm)</text>
        <rect id="screen" class="shape screen" x="7.5" y="1.5" width="15" height="1" />
    </g>
    <g>
        <circle id="circle" cx="15.00001" cy="10" r="1.5" class="draggable shape circle"></circle>
        <text id="angle" x="15" y="13" text-anchor="middle" font-size="1" class="static select-none angle">
            30 degree viewing angle
        </text>
    </g>
    <g>
        <line id="cxn" class="connection cxn"></line>
        <line id="cxn2" class="connection cxn2"></line>
    </g>
    <g>
        <line id="ruleMainLine" class="ruleMainLine" x1="23" y1="2.5" x2="23" y2="10" stroke="black" stroke-width="0.1" />

        <line x1="22.5" y1="2.5" x2="23.5" y2="2.5" stroke="black" stroke-width="0.1" />

        <line id="ruleBottomLine" class="ruleBottomLine" x1="22.5" y1="20" x2="23.5" y2="20" stroke="black" stroke-width="0.1" />

        <text id="ruleText" x="23.5" y="6" font-size="1" class="static select-none ruleText">
            1.40m (4.6ft)
        </text>
    </g>

</svg>

<script>
    getElement = (className) => {
        return document.querySelector('#<?php echo $id ?>' + ' .' + className);
    };
    var <?php echo $id ?>Data = {
        circle: getElement('circle'),
        screen: getElement('screen'),
        cxn: getElement('cxn'),
        cxn2: getElement('cxn2'),
        angle: getElement('angle'),
        ruleMainLine: getElement('ruleMainLine'),
        ruleBottomLine: getElement('ruleBottomLine'),
        ruleText: getElement('ruleText')
    } 

    updateGraph('<?php echo $id ?>Data');
</script>