<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HTML</title>
    <link rel="icon" type="image/png" sizes="48x48" href="/assets/favicon.ico" />
    <link rel="stylesheet" href="/assets/main.css" />
</head>

<body>
    <main class="container">
        <form id="userForm" class="form-wrapper" method="POST">
            <div class="form-group">
                <label class="form-label" for="fullname">Name:</label>
                <input class="form-input" type="text" id="fullname" name="fullname" data-validate value="">
                <span id="fullname-error" class="form-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email:</label>
                <input class="form-input" type="email" id="email" name="email" data-validate value="">
                <span id="email-error" class="form-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="mobile">Mobile:</label>
                <input class="form-input" type="mobile" id="mobile" name="mobile" data-validate value="">
                <span id="mobile-error" class="form-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="dateofbirth">Select your date of birth:</label>
                <input class="form-input" type="date" id="dateofbirth" name="dateofbirth" data-validate value="">
                <span id="dateofbirth-error" class="form-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="mobile">Gender:</label>
                <select id="gender" name="gender" class='form-input' data-validate value="">
                    <option value='Male' selected>Male</option>
                    <option value='Female'>Female</option>
                </select>
                <span id="gender-error" class="form-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="age">Age:</label>
                <input class="form-input" type="text" id="age" name="age" value="" disabled>
            </div>

            <div class="form-group">
                <div class="form-button">
                    <input class="form-input" type="submit" value="Submit">
                </div>

            </div>
        </form>

    </main>
    <script type="module" src="/assets/main.js"></script>
</body>

</html>
