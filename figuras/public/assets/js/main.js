function showInputs() {
    const shape = document.getElementById('shape').value;
    const inputsDiv = document.getElementById('inputs');
    inputsDiv.innerHTML = '';

    if (shape === 'square') {
        inputsDiv.innerHTML = `
        <div class="form-group">
            <label for="side">Lado:</label>
            <input type="number" class="form-control" id="side" name="side" required>
            </div>
            `;
    } else if (shape === 'heptagono') {
        inputsDiv.innerHTML = `
        <label for="side">Lado:</label>
        <input type="number" class="form-control" id="side" name="side" required>
        `;
    } else if (shape === 'triangulo') {
        inputsDiv.innerHTML = `
            <label for="lado">Lado:</label>
            <input type="number" class="form-control" id="lado" name="lado" required>
        `;
    } else if (shape === 'hexagono') {
        inputsDiv.innerHTML = `
            <label for="ladoH">Lado:</label>
            <input type="number" class="form-control" id="ladoH" name="ladoH" required>
        `;
    } else if (shape === 'pentagono') {
        inputsDiv.innerHTML = `
            <label for="ladoP">Lado:</label>
            <input type="number" class="form-control" id="ladoP" name="ladoP" required>
             <label for="apotema">Apotema:</label>
            <input type="number" class="form-control" id="apotema" name="apotema" required>
        `;
    } 
}

function calculate() {
    const shape = document.getElementById('shape').value;
    let data = {};

    if (shape === 'square') {
        data.side = document.getElementById('side').value;
    } else if (shape === 'heptagono') {
        data.side = document.getElementById('side').value;
    } else if (shape === 'triangulo') {
        data.lado = document.getElementById('lado').value;
    } else if (shape === 'hexagono') {
        data.ladoH = document.getElementById('ladoH').value;
    } else if (shape === 'pentagono') {
        data.ladoP = document.getElementById('ladoP').value;
        data.apotema = document.getElementById('apotema').value;
    }

    fetch(`../service/${shape}Service.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {

        document.getElementById('areaResultado').textContent = result.area;
        document.getElementById('perimetroResultado').textContent = result.perimeter;

        drawPolygon(result.sides, 150, 250, 250);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function drawPolygon(sides, radius, centerX, centerY) {
    const canvas = document.getElementById('myCanvas');
    const ctx = canvas.getContext('2d');
    const angleStep = (2 * Math.PI) / sides;
    const circleStep = (2 * Math.PI) / 50; 
    let currentSide = 0;
    let currentArc = 0;

    ctx.clearRect(0, 0, canvas.width, canvas.height); 

    ctx.strokeStyle = "#0000ff"; 
    ctx.lineWidth = 3; 

    function drawCirclePart() {
        
        const startAngle = currentArc * circleStep; // Ángulo inicial del arco
        const endAngle = startAngle + circleStep; // Ángulo final del arco

        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.stroke();

        currentArc++;

        if (currentArc < 50) {
            setTimeout(drawCirclePart, 250);
        } else {
            drawFigure(); 
        }
    }

    function drawFigure() {
        ctx.strokeStyle = "#000000"; 
        ctx.lineWidth = 1;
        ctx.beginPath();

        function drawStep() {
            const angle1 = currentSide * angleStep - Math.PI / 2; 
            const angle2 = (currentSide + 1) * angleStep - Math.PI / 2; 

            const x1 = centerX + radius * Math.cos(angle1);
            const y1 = centerY + radius * Math.sin(angle1);
            const x2 = centerX + radius * Math.cos(angle2);
            const y2 = centerY + radius * Math.sin(angle2);

            if (currentSide === 0) {
                ctx.moveTo(x1, y1); 
            }

            ctx.lineTo(x2, y2); 
            ctx.stroke();

            currentSide++;

            if (currentSide < sides) {
                setTimeout(drawStep, 800); 
            } else {
                ctx.closePath();
                ctx.stroke();
            }
        }

        drawStep(); 
    }

    drawCirclePart(); 
}


