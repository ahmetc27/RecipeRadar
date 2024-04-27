<?php
include 'navbar.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title>FAQ MD Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="res/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/design.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: white;
        }

        h1 {
            color: teal;
            text-align: center;
            margin-bottom: 20px;

        }

        .faq-container {
            margin-top: 40px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .faq-card {
            margin-bottom: 20px;
        }

        .faq-question {
            background-color: #f0f0f0;
            padding: 15px;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .faq-answer {
            display: none;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .faq-question.active {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h1 class="text-center">FAQs</h1>
        <hr>

        <div class="faq-card">
            <div class="faq-question" onclick="toggleAnswer('answer1')">
                Wann wird die Seite fertig sein?
            </div>
            <div id="answer1" class="faq-answer">
                Die Webseite wird jede Woche laufend erweitert. Die vollständige Seite wird ungefähr Anfang Jänner 2024 fertig sein.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question" onclick="toggleAnswer('answer2')">
                Wo finde ich die Kontaktdaten des Hotels beziehungsweise ein Impressum des Hotels?
            </div>
            <div id="answer2" class="faq-answer">
                Das Impressum samt Kontaktdaten kann unter folgendem Link gefunden werden: <a href="impressum.php" class="text-link">Impressum</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question" onclick="toggleAnswer('answer3')">
                Wo und wie kann ich ein Zimmer reservieren?
            </div>
            <div id="answer3" class="faq-answer">
                Sie k&ouml;nnen ein Zimmer unter den oben stehenden Link reservieren, sobald Sie registriert und eingeloggt sind.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question" onclick="toggleAnswer('answer4')">
                Wo finde ich die neusten Informationen?
            </div>
            <div id="answer4" class="faq-answer">
                Unter <a href="nerws.php" class="text-link">Beiträge</a> finden Sie die neusten Beiträge von uns.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question" onclick="toggleAnswer('answer5')">
                Wohin kann ich mich wenden, falls meine Frage hier nicht aufscheint?
            </div>
            <div id="answer5" class="faq-answer">
                Falls Sie noch unbeantwortete Fragen haben, freuen wir uns &uuml;ber eine <a href="mailto:hotelname@domain.com" class="text-link">Mail</a> von Ihnen.
            </div>
        </div>

        <hr>
        <p>Zurück zur <a href="index.php" class="text-link">Startseite</a></p>
    </div>

    <!-- Bootstrap js -->
    <script src="res/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAnswer(answerId) {
            var answer = document.getElementById(answerId);
            answer.style.display = (answer.style.display === 'none' || answer.style.display === '') ? 'block' : 'none';

            var question = answer.previousElementSibling;
            question.classList.toggle('active');
        }
    </script>
</body>

</html>