function toggleAnswer(answerId) {
    var answer = document.getElementById(answerId);
    answer.style.display = (answer.style.display === 'none' || answer.style.display === '') ? 'block' : 'none';

    var question = answer.previousElementSibling;
    question.classList.toggle('active');
}