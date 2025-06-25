<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .footerbody {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        footer {
            background: #f8f8f8;
            padding: 24px 0;
            text-align: center;
            margin-top: 40px;
            border-top: 1px solid #e0e0e0;
            
        }

        .footer-categories {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 40px;
        }

        .footer-categories div {
            flex: 1;
            text-align: left;
        }

        footer h4 {
            margin-bottom: 16px;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer ul li {
            margin-bottom: 8px;
        }

        footer ul li a {
            text-decoration: none;
            color: #333;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }

        footer .subtext {
            margin-top: 20px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>

<body class="footerbody">

    <footer>
        <div class="footer-categories">
            <div>
                <h4>Help</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#">Support Center</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4>About Us</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#">Our Story</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4>Legal</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4>Icons Used</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                   <li> <a href="https://www.flaticon.com/uicons"> Uicons by Flaticon</a></li>
                </ul>
            </div>
            <div style="margin-top: 20px; color: #888; font-size: 14px;">
                &copy; 2024 GigIt. All rights reserved.
            </div>


    </footer>
</body>

</html>