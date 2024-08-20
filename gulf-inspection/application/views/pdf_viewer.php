<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>PDF Viewer</title>-->
<!--    <style>-->
<!--        body {-->
<!--            font-family: Arial, sans-serif;-->
<!--            background-color: #f4f4f4;-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            height: 100vh;-->
<!--            margin: 0;-->
<!--        }-->
<!--        .viewer-container {-->
<!--            background-color: #fff;-->
<!--            padding: 20px;-->
<!--            border-radius: 8px;-->
<!--            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);-->
<!--            width: 80%;-->
<!--            max-width: 800px;-->
<!--            text-align: center;-->
<!--        }-->
<!--        .viewer-container iframe {-->
<!--            width: 100%;-->
<!--            height: 600px;-->
<!--            border: none;-->
<!--            border-radius: 4px;-->
<!--            margin-bottom: 20px;-->
<!--        }-->
<!--        .viewer-container .button-container {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            gap: 10px;-->
<!--        }-->
<!--        .viewer-container a,-->
<!--        .viewer-container button {-->
<!--            padding: 10px 20px;-->
<!--            border: none;-->
<!--            border-radius: 4px;-->
<!--            background-color: #007bff;-->
<!--            color: #fff;-->
<!--            font-size: 16px;-->
<!--            cursor: pointer;-->
<!--            text-decoration: none;-->
<!--        }-->
<!--        .viewer-container a:hover,-->
<!--        .viewer-container button:hover {-->
<!--            background-color: #0056b3;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--    <div class="viewer-container">-->
<!--        <iframe src="<//?php echo $pdf_url; ?>"></iframe>-->
<!--        <div class="button-container">-->
<!--            <//?php if ($downloadable): ?>-->
<!--                <a href="<//?php echo $pdf_url; ?>" download>Download</a>-->
<!--            <//?php endif; ?>-->
<!--            <//?php if ($printable): ?>-->
<!--                <button onclick="window.print()">Print</button>-->
<!--            <//?php endif; ?>-->
<!--        </div>-->
<!--    </div>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Viewer</title>
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
        .viewer-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
        }
        .viewer-container iframe {
            width: 100%;
            height: 600px;
            border: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .viewer-container .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .viewer-container a,
        .viewer-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .viewer-container a:hover,
        .viewer-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="viewer-container">
        <iframe id="pdf-iframe" src="<?php echo $pdf_url; ?>"></iframe>
        <div class="button-container">
            <?php if ($downloadable): ?>
                <a href="<?php echo $pdf_url; ?>" download>Download</a>
            <?php endif; ?>
            <?php if ($printable): ?>
                <button onclick="openAndPrintPDF()">Print</button>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function openAndPrintPDF() {
            const pdfUrl = "<?php echo $pdf_url; ?>";
            const printWindow = window.open(pdfUrl, '_blank');
            printWindow.onload = function() {
                printWindow.focus();
                printWindow.print();
            };
        }
    </script>
</body>
</html>
