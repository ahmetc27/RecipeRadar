    <div class="container">
        <div class="faq-card">
            <h1 class="text-center">FAQs</h1>
            <hr>
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
    </div>
    <script>
        function toggleAnswer(answerId) {
            var answer = document.getElementById(answerId);
            answer.style.display = (answer.style.display === 'none' || answer.style.display === '') ? 'block' : 'none';

            var question = answer.previousElementSibling;
            question.classList.toggle('active');
        }
    </script>
    
