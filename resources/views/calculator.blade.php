<!DOCTYPE html>
<html>
<head>
    <title>Laravel Calculator</title>
    <style>
        :root {
            /* Dark Mode (Default) - Brutalist Neon/Pink */
            --bg: #ff52a3;
            --panel: #e0e0e0;
            --display-bg: #111111;
            --display-text: #00ffcc;
            --btn: #ffffff;
            --btn-equal: #00e676;
            --btn-clear: #ff1744;
            --text: #000000;
            --border: #000000;
        }

        body.light {
            /* Light Mode - Brutalist Yellow/Teal */
            --bg: #ffeaa7;
            --panel: #ffffff;
            --display-bg: #2d3436;
            --display-text: #55efc4;
            --btn: #dfe6e9;
            --btn-equal: #00b894;
            --btn-clear: #d63031;
            --text: #2d3436;
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: var(--bg);
            font-family: 'Arial Black', Impact, sans-serif;
            transition: background 0.3s;
            overflow: hidden;
        }

        /* Top Right Toggle */
        .toggle {
            position: absolute;
            top: 25px;
            right: 25px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 900;
            border-radius: 0;
            border: 4px solid var(--border);
            cursor: pointer;
            background: var(--btn);
            color: var(--text);
            box-shadow: 8px 8px 0px var(--border);
            transition: all 0.1s ease-in-out;
            text-transform: uppercase;
        }

        .toggle:active {
            transform: translate(8px, 8px);
            box-shadow: 0px 0px 0px var(--border);
        }

        /* Main Panel */
        .calculator {
            background: var(--panel);
            padding: 30px;
            border: 5px solid var(--border);
            border-radius: 0;
            box-shadow: 16px 16px 0px var(--border);
            width: 400px;
            transition: background 0.3s;
        }

        /* Huge Black Result Screen */
        .brutal-screen {
            background: var(--display-bg);
            border: 4px solid var(--border);
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: inset 4px 4px 0px rgba(0,0,0,0.8);
        }

        /* Embedded Equation Inputs */
        .inputs-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }

        .inputs-row input, .inputs-row select {
            background: transparent;
            border: none;
            border-bottom: 4px dashed #555;
            color: var(--display-text);
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            width: 35%;
            border-radius: 0;
            outline: none;
            font-family: 'Courier New', monospace;
            transition: border-bottom 0.2s;
        }

        /* Hide Number Spinners for cleaner look */
        .inputs-row input[type=number]::-webkit-inner-spin-button, 
        .inputs-row input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        .inputs-row input[type=number] {
            -moz-appearance: textfield;
        }

        .inputs-row input::placeholder {
            color: rgba(255, 255, 255, 0.2);
            font-size: 16px;
        }

        .inputs-row input:focus {
            border-bottom: 4px solid var(--display-text);
            background: rgba(255, 255, 255, 0.05);
        }

        .inputs-row select {
            width: 20%;
            appearance: none;
            cursor: pointer;
            font-size: 32px;
            border-bottom: none;
        }

        .inputs-row select option {
            background: var(--display-bg);
            color: var(--display-text);
        }

        /* Actual Result Display */
        .display {
            font-size: 56px;
            color: var(--display-text);
            text-align: right;
            font-family: 'Courier New', monospace;
            min-height: 65px;
            word-wrap: break-word;
            line-height: 1.1;
        }

        /* Button Grid layout */
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        button.calc-btn {
            padding: 20px 0;
            font-size: 28px;
            font-weight: 900;
            border: 4px solid var(--border);
            border-radius: 0;
            cursor: pointer;
            background: var(--btn);
            color: var(--text);
            box-shadow: 8px 8px 0px var(--border);
            transition: all 0.1s ease-in-out;
            font-family: 'Arial Black', Impact, sans-serif;
        }

        button.calc-btn:active {
            transform: translate(8px, 8px);
            box-shadow: 0px 0px 0px var(--border);
        }

        /* Specific Button Colors & Sizes */
        .clear-btn {
            background: var(--btn-clear) !important;
            color: white !important;
        }
        
        .equal {
            background: var(--btn-equal) !important;
            color: var(--text) !important;
            grid-column: 4;
            grid-row: 2 / span 3;
            font-size: 22px !important;
            text-transform: uppercase;
        }
        
        .wide-btn {
            grid-column: 1 / span 3;
        }
    </style>
</head>
<body>

<button class="toggle" id="modeToggle">Light / Dark</button>

<div class="calculator">
    <form id="calculatorForm">
        @csrf
        
        <div class="brutal-screen">
            <div class="inputs-row">
                <input type="number" name="first_number" id="first_number" placeholder="No. 1" required>
                
                <select name="operator" id="operator">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>
                
                <input type="number" name="second_number" id="second_number" placeholder="No. 2" required>
            </div>
            <div class="display" id="result">0</div>
        </div>

        <div class="buttons">
            <button type="button" class="calc-btn" onclick="appendNumber('7')">7</button>
            <button type="button" class="calc-btn" onclick="appendNumber('8')">8</button>
            <button type="button" class="calc-btn" onclick="appendNumber('9')">9</button>
            <button type="button" class="calc-btn clear-btn" onclick="clearInput()">C</button>

            <button type="button" class="calc-btn" onclick="appendNumber('4')">4</button>
            <button type="button" class="calc-btn" onclick="appendNumber('5')">5</button>
            <button type="button" class="calc-btn" onclick="appendNumber('6')">6</button>
            
            <button type="submit" class="calc-btn equal">CALC</button>

            <button type="button" class="calc-btn" onclick="appendNumber('1')">1</button>
            <button type="button" class="calc-btn" onclick="appendNumber('2')">2</button>
            <button type="button" class="calc-btn" onclick="appendNumber('3')">3</button>

            <button type="button" class="calc-btn wide-btn" onclick="appendNumber('0')">0</button>
        </div>
    </form>
</div>

<script>
let currentInput = null;

document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', () => currentInput = input);
});

function appendNumber(num) {
    if (!currentInput) currentInput = document.getElementById('first_number');
    currentInput.value += num;
}

function clearInput() {
    if (currentInput) currentInput.value = '';
}

document.getElementById("calculatorForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("/api/calculate", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("result").innerText = data.result;
    })
    .catch(error => {
        alert("Something went wrong");
        console.log(error);
    });
});

// Light/Dark Toggle
const toggle = document.getElementById('modeToggle');

toggle.addEventListener('click', () => {
    document.body.classList.toggle('light');
});
</script>

</body>
</html>