<!DOCTYPE html>
<html>
<head>
    <title>Laravel Calculator</title>
</head>
<body>

    <h2>Simple Calculator</h2>

    <form id="calculatorForm">
        @csrf
        
        <input type="number" name="first_number" placeholder="First Number" required>

        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>

        <input type="number" name="second_number" placeholder="Second Number" required>

        <button type="submit">Calculate</button>
    </form>

    <h3>Result: <span id="result"></span></h3>

</body>
</html>