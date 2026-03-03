<!DOCTYPE html>
<html>
<head>
    <title>Laravel Calculator</title>
</head>
<body>

    <h2>Simple Calculator</h2>

    <form id="calculatorForm" method="POST">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#calculatorForm').on('submit', function(e) {

                e.preventDefault(); // stop normal form submission

                $.ajax({
                    url: '/calculate',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#result').text(response.result);
                    },
                    error: function() {
                        alert("Something went wrong.");
                    }
                });

            });

        });
    </script>
</body>
</html>