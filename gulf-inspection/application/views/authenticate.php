<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authenticate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .auth-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .auth-container h2 {
            margin-bottom: 20px;
        }
        .auth-container form {
            display: flex;
            flex-direction: column;
        }
        .auth-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .auth-container input {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .auth-container button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .auth-container button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Authentication Required</h2>
        <?php if (isset($message)): ?>
            <div class="error-message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo base_url('Welcome/validate_password'); ?>" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="password">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
