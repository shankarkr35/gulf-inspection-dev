<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>QR Code Validation</title>-->
<!--</head>-->
<!--<body>-->
<!--    <//?php if (isset($report_url)): ?>-->
<!--        <script>-->
<!--            window.open('<//?= $report_url ?>', '_blank');-->
<!--            window.location.href = '<//?= $report_url ?>';-->
<!--        </script>-->
<!--    <//?php else: ?>-->
<!--        <center><p style="color:red;font-size:25px;"><//?= $message ?></p></center>-->
<!--    <//?php endif; ?>-->
<!--</body>-->
<!--</html>-->


<!DOCTYPE html>
<html>
<head>
    <title>QR Code Validation</title>
</head>
<body>
    <?php if (isset($report_url)): ?>
        <script>
            window.location.href = '<?= $report_url ?>';
        </script>
    <?php else: ?>
        <p><?= $message ?></p>
    <?php endif; ?>
</body>
</html>

