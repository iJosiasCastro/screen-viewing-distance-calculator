var limitY = {
    top: '4.7',
    bottom: '46.5'
};
var circle = null;
var screen = null;
var cxn = null;
var cxn2 = null;
var angle = null;
var ruleMainLine = null;
var ruleBottomLine = null;
var ruleText = null;
var screenSize = null;

function createGraph(graphName, graphAngle, graphScreenSize){
    let screenSizeText = document.querySelector('#' + graphName + ' .screenSizeText');
    screenSizeText.textContent = `${graphScreenSize[0].toFixed(1)}" (${graphScreenSize[1].toFixed(1)}cm)`

    let data = eval(`${graphName}Data`);
    circle = data.circle;
    data.screenSize = graphScreenSize;

    // 1. Calculate the distance
    const angleInRadians = (Math.floor(graphAngle) * Math.PI) / 180;
    const distanceCm = graphScreenSize[1] / (2 * Math.tan(angleInRadians / 2));
    const distanceMeters = distanceCm / 100;
    
    // 2. Tranform the distance to a cy
    // Constants
    const x1 = 0.02393479416298604;
    const y1 = 4.766355140186917;

    const x2 = 1.5515263066352947;
    const y2 = 46.421895861148194;

    // Calculate the slope (m)
    const m = (y2 - y1) / (x2 - x1);

    // Calculate the y-intercept (b)
    const b = y1 - m * x1;

    const calculatedY = m * distanceMeters + b;

    // 3. Update the cy value

    circle.setAttributeNS(null, 'cy', calculatedY);

    updateGraph(`${graphName}Data`);
}

function updateGraph(dataVarName){
    let data = eval(dataVarName);
    circle = data.circle;
    screen = data.screen;
    cxn = data['cxn'];
    cxn2 = data.cxn2;
    angle = data.angle;
    ruleMainLine = data.ruleMainLine;
    ruleBottomLine = data.ruleBottomLine;
    ruleText = data.ruleText;
    screenSize = data.screenSize;
    updateConnection(cxn, 'right');
    updateConnection(cxn2, 'left');
    calculateAngle();
};

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
};

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
    if(angleDegrees > 170)
        angleDegrees = 170;

    if(angleDegrees < 10)
        angleDegrees = 10;

    angle.setAttributeNS(null, 'y', cxn_y1 + 4.5);
    angle.textContent = Math.floor(angleDegrees) + ' degree viewing angle';

    // Calculate distance
    if(screenSize){
        const angleInRadians = (Math.floor(angleDegrees) * Math.PI) / 180;
        const distanceCm = screenSize[1] / (2 * Math.tan(angleInRadians / 2));
        const distanceMeters = distanceCm / 100;
        const distanceFeet = distanceCm / 30.48;

        ruleText.textContent = `${distanceMeters.toFixed(2)}m (${distanceFeet.toFixed(1)}ft)`;
    }


    ruleMainLine.setAttributeNS(null, 'y2', cxn_y1);
    ruleBottomLine.setAttributeNS(null, 'y1', cxn_y1);
    ruleBottomLine.setAttributeNS(null, 'y2', cxn_y1);

    ruleText.setAttributeNS(null, 'y', (cxn_y1 / 2) + 1.6);
};

function getIntersection(x, dy, cy, h) {
    return [x, cy + (dy > 0 ? h : -h)];
};

function makeDraggable(evt, varName) {
    var svg = evt.target;
    var x1 = parseFloat(circle.getAttributeNS(null, 'cx'));
    var cx1 = x1;

    svg.addEventListener('mousedown', startDrag);
    svg.addEventListener('mousemove', drag);
    svg.addEventListener('mouseup', endDrag);

    function getMousePosition(evt) {
        var CTM = svg.getScreenCTM();
        return {
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
            updateGraph(varName);
        }
    }

    function endDrag(evt) {
        selectedElement = null;
    }
}