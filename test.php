<?php include('./components/layout/head.php') ?>

<svg xmlns="http://www.w3.org/2000/svg" class="border border-black" viewBox="0 0 30 40" onload="makeDraggable(evt)" width="800" height="600">
    <g>
        <text x="15" y="1" text-anchor="middle" font-size="1" class="static select-none">27''</text>
        <rect id="screen" class="draggable" x="7.5" y="1.5" width="15" height="1" />
    </g>
    <g>
        <circle id="circle" cx="15.00001" cy="10" r="1.5" class="draggable"></circle>
        <text id="angle" x="15" y="13" text-anchor="middle" font-size="1" class="static select-none">
            30 degree viewing angle
        </text>
    </g>
    <g>
        <line id="cxn" class="cxn"></line>
        <line id="cxn2" class="cxn"></line>
    </g>
</svg>


<script>
    var circle = document.getElementById('circle');
    var screen = document.getElementById('screen');
    var cxn = document.getElementById('cxn');
    var cxn2 = document.getElementById('cxn2');
    var angle = document.getElementById('angle');

    var limitY = {
        top: '4.8',
        bottom: '36.5'
    };

    updateConnection(cxn, 'right');
    updateConnection(cxn2, 'left');
    calculateAngle();

    function updateConnection(cxnElem, direction) {
        var x1 = parseFloat(circle.getAttributeNS(null, 'cx'));
        var y1 = parseFloat(circle.getAttributeNS(null, 'cy'));
        var x2 = parseFloat(screen.getAttributeNS(null, 'x'));
        var y2 = parseFloat(screen.getAttributeNS(null, 'y'));

        var w1 = parseFloat(circle.getAttributeNS(null, 'r'));
        var h1 = w1;
        var w2 = parseFloat(screen.getAttributeNS(null, 'width'));
        var h2 = 0.4;

        var cx1 = x1;
        var cy1 = y1 - 0.1;

        if (direction == 'left') {
            var cx2 = x2;
            var cy2 = y2 + h2 + 0.3;
        }


        if (direction == 'right') {
            var cx2 = x2 + w2;
            var cy2 = y2 + h2 + 1.1;
        }

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

    function calculateAngle() {
        // Get the coordinates of the endpoints of the first line (cxn)
        var cxn_x1 = parseFloat(cxn.getAttributeNS(null, 'x1'));
        var cxn_y1 = parseFloat(cxn.getAttributeNS(null, 'y1'));
        var cxn_x2 = parseFloat(cxn.getAttributeNS(null, 'x2'));
        var cxn_y2 = parseFloat(cxn.getAttributeNS(null, 'y2'));

        // Get the coordinates of the endpoints of the second line (cxn2)
        var cxn2_x1 = parseFloat(cxn2.getAttributeNS(null, 'x1'));
        var cxn2_y1 = parseFloat(cxn2.getAttributeNS(null, 'y1'));
        var cxn2_x2 = parseFloat(cxn2.getAttributeNS(null, 'x2'));
        var cxn2_y2 = parseFloat(cxn2.getAttributeNS(null, 'y2'));

        // Calculate the vectors representing the two lines
        var vector1 = {
            x: cxn_x2 - cxn_x1,
            y: cxn_y2 - cxn_y1
        };
        var vector2 = {
            x: cxn2_x2 - cxn2_x1,
            y: cxn2_y2 - cxn2_y1
        };

        // Calculate the dot product of the two vectors
        var dotProduct = vector1.x * vector2.x + vector1.y * vector2.y;

        // Calculate the magnitudes of the vectors
        var magnitude1 = Math.sqrt(vector1.x * vector1.x + vector1.y * vector1.y);
        var magnitude2 = Math.sqrt(vector2.x * vector2.x + vector2.y * vector2.y);

        // Calculate the cosine of the angle between the two lines
        var cosineAngle = dotProduct / (magnitude1 * magnitude2);

        // Calculate the angle in radians
        var angleRadians = Math.acos(cosineAngle);

        // Convert the angle to degrees
        var angleDegrees = (angleRadians * 180) / Math.PI;

        angle.setAttributeNS(null, 'y', cxn_y1 + 4.5);
        angle.textContent = Math.round(angleDegrees) + ' degree viewing angle';
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
                if (limitY.top < y && limitY.bottom > y)
                    selectedElement.setAttributeNS(null, "cy", coord.y - offset.y);
                updateConnection(cxn, 'right');
                updateConnection(cxn2, 'left');
                calculateAngle();
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