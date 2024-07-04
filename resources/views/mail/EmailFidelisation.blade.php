<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            html, body {
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
            }
            .centered-wrapper {
                position: relative;
                text-align: center;
            }
            .centered-wrapper:before {
                content: "";
                position: relative;
                display: inline-block;
                width: 0; height: 100%;
                vertical-align: middle;
            }
            .centered-content {
                display: inline-block;
                vertical-align: middle;
                background: white;
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            body {background-color: grey;}
            .warning {color: red;}
            h2 {
            display: inline-block;
            height: 50px; /*sets height of element*/
            line-height: 50px; /*for this, it sets vertical alignment*/
            }
            .container1 {
            background: grey; /*sets the background of this element (here a solid colour)*/
            margin-left: 10px;
            margin-right: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container1">
            <div class="centered-content">

                <h1>QUE DES BONNE CHOSES</h1>
                <h2>{{ $messa }}</h2>

                <p class="warning">Si ce message ne vous est pas destiner, Ignorer simplement s'il vous plais</p>
                <p>
                <h2>Tel: +237 6 97 98 25 45</h2>
                </p>
                <p>Thanks</p>
            </div>
        </div>
    </body>
</html> 