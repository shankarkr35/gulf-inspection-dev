<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Validation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .message-container p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if (isset($report_url)): ?>
            <script>
                window.open('<?= $report_url ?>', '_blank');
                window.location.href = '<?= $report_url ?>';
            </script>
            <p>Redirecting...</p>
        <?php else: ?>
            <p><?= $message ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
