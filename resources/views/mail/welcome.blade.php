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

                <h1>BIENVENUE</h1>
                <p class="warning"></p>
                <p>
                    Nous sommes ravis de vous accueillir dans notre communauté de lecteurs de la newsletter. 
                    Vous venez de prendre une excellente décision en vous inscrivant, 
                     et nous sommes impatients de partager 
                     avec vous les dernières actualités, conseils et informations intéressantes.

                    Chaque semaine/mois, vous recevrez des contenus soigneusement 
                    sélectionnés pour vous tenir informé(e) et inspiré(e). Que vous soyez passionné(e) par la technologie, cuisine, etc., nous avons quelque chose pour vous.

                    N'hésitez pas à nous faire part de vos suggestions, questions ou idées pour 
                    améliorer votre expérience avec notre newsletter. Nous sommes là pour vous fournir des 
                    informations de qualité et pertinentes.

                    Merci encore pour votre inscription. Restez à l'affût pour notre prochaine édition !

                    Cordialement,
                </p>

                <h2>VOTRE MOT DE PASS: {{ $pass }}</h2>

                
                <h2>Tel: +237 6 97 98 25 45</h2>
                </p>
                <p>Merci</p>
            </div>
        </div>
    </body>
</html> 