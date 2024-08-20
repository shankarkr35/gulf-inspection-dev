<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        /* Reset styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Main container */
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
            font-size: 24px;
        }

        /* Content */
        .content {
            margin-bottom: 30px;
        }

        .content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        /* Footer */
        .footer {
            text-align: center;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Client Feedback</h1>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p><?php echo $feedback; ?></p>
        </div>
        <div class="footer">
            <!--<p>This email was sent by ASAP!.</p>-->
        </div>
    </div>
</body>
</html>
