$(function() {

    var $questionsContainer = $('div#form_Question');
    var $addQuestion = $('#add_question');

    $questionsContainer.append($addQuestion);

    $addQuestion.click(function(e) {
        addQuestion($questionsContainer);
        e.preventDefault();
        return false;
    });

    var index = $questionsContainer.find(':input').length;

    if (index == 0) {
        addQuestion($container);
    }
    else {
        $container.children('div').each(function() {

            addDeleteLink($(this));

        });

    }

    function addQuestion($container) {
        var index = $questionsContainer.find(':input').length;
        var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Question').replace(/__name__/g, index));
        addDeleteLink($prototype);
        $container.append($prototype);

        //Ajout des réponses dans la question:
        var $answerContainer = $('#form_Question_'+ index +'_answers');
        var $addAnswer = $('<a href="#" id="add_answer" class="btn btn-default">Ajouter une réponse</a>');
        $answerContainer.append($addAnswer);

        $addAnswer.click(function(e) {
            addAnswer($answerContainer);
            e.preventDefault();
            return false;
        });

        var index = $answerContainer.find(':input').length;

        if (index == 0) {
            addAnswer($answerContainer);
        }
        else {
            $answerContainer.children('div').each(function() {
                addDeleteLink($(this));
            });
        }


    }
    function addDeleteLink($prototype) {
        $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);

        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();

            return false;

        });

    }

    function addAnswer($container) {
        var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Réponse')
            .replace(/__name__/g, index));
        addDeleteLink($prototype);
        $container.append($prototype);
    }

    function addDeleteLink($prototype) {
        $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);

        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();

            return false;

        });
    }

});