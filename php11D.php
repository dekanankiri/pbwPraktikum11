<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            margin: auto;
            border-spacing: 10px;
        }
        input[type="text"], input[type="password"] {
            padding: 5px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Login</h2>
    <form action="php11D_action.php" method="post">
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>
