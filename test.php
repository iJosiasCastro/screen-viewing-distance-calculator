<?php include('./components/layout/head.php') ?>

<svg xmlns="http://www.w3.org/2000/svg" class="border border-black" viewBox="0 0 30 30" onload="makeDraggable(evt)" width="800" height="600">

    <circle id="circle" cx="15.00001" cy="10" r="1.5" class="draggable"></circle>
    <rect id="screen" class="draggable" x="7.5" y="1" width="15" height="1" />
    
    <line id="cxn" class="cxn"></line>
    <line id="cxn2" class="cxn"></line>
</svg>

<script>
    var circle = document.getElementById('circle');
    var screen = document.getElementById('screen');
    var cxn = document.getElementById('cxn');
    var cxn2 = document.getElementById('cxn2');

    var limitY = {
        top: '5',
        bottom: '25'
    };

    updateConnection(cxn, 'right');
    updateConnection(cxn2, 'left');

    function updateConnection(cxnElem, direction) {
        // Top left coordinates
        var x1 = parseFloat(circle.getAttributeNS(null, 'cx'));
        var y1 = parseFloat(circle.getAttributeNS(null, 'cy'));
        var x2 = parseFloat(screen.getAttributeNS(null, 'x'));
        var y2 = parseFloat(screen.getAttributeNS(null, 'y'));

        // Half widths and half heights
        var w1 = parseFloat(circle.getAttributeNS(null, 'r'));
        var h1 = w1;
        var w2 = parseFloat(screen.getAttributeNS(null, 'width'));
        var h2 = 0.4;

        // Center coordinates
        var cx1 = x1;
        var cy1 = y1 - 0.1;
        
        if(direction=='left'){
            var cx2 = x2;
            var cy2 = y2 + h2 + 0.3;
        }
           

        if(direction=='right'){
            var cx2 = x2 + w2;
            var cy2 = y2 + h2 + 1.1;
        }
            


        // Distance between centers
        var dx = cx2 - cx1;
        var dy = cy2 - cy1;

        var p1, p2;

        p1 = getIntersection(cx1, dy, cy1, h1);
        p2 = getIntersection(cx2, -dx, cy2, h2);

        cxnElem.setAttributeNS(null, 'x1', p1[0]);
        cxnElem.setAttributeNS(null, 'y1', p1[1]);
        cxnElem.setAttributeNS(null, 'x2', p2[0]);
        cxnElem.setAttributeNS(null, 'y2', p2[1]);
    }

    function getIntersection(x, dy, cy, h) {
        return [x, cy + (dy > 0 ? h : -h)];
    };

    function makeDraggable(evt) {
        var svg = evt.target;
        var x1 = parseFloat(circle.getAttributeNS(null, 'cx'));
        var cx1 = x1;

        svg.addEventListener('mousedown', startDrag);
        svg.addEventListener('mousemove', drag);
        svg.addEventListener('mouseup', endDrag);

        function getMousePosition(evt) {
            var CTM = svg.getScreenCTM();
            return {
                // x: (evt.clientX - CTM.e) / CTM.a,
                x: cx1,
                y: (evt.clientY - CTM.f) / CTM.d
            };
        }

        var selectedElement, offset;

        function startDrag(evt) {
            if (evt.target.classList.contains('draggable')) {
                selectedElement = evt.target;
                offset = getMousePosition(evt);
                offset.x -= parseFloat(selectedElement.getAttributeNS(null, "cx"));
                offset.y -= parseFloat(selectedElement.getAttributeNS(null, "cy"));
            }
        }

        function drag(evt) {
            if (selectedElement) {
                var coord = getMousePosition(evt);
                selectedElement.setAttributeNS(null, "cx", coord.x - offset.x);
                let y = coord.y - offset.y;
                if(limitY.top < y &&  limitY.bottom > y)
                    selectedElement.setAttributeNS(null, "cy", coord.y - offset.y);
                updateConnection(cxn, 'right');
                updateConnection(cxn2, 'left');
            }
        }

        function endDrag(evt) {
            selectedElement = null;
        }
    }
</script>

<style>
    .static {
        cursor: not-allowed;
    }

    .draggable {
        cursor: move;
        fill: #007bff;
        fill-opacity: 0.1;
        stroke: #007bff;
        stroke-width: 0.2;
    }

    .cxn {
        stroke-width: 0.1;
        stroke: black;
    }
</style>