        $(document).ready(function() {
            var $questionsContainer = $('div#formgenerator_formbundle_topic_questions');
            var $addQuestion = $('<div class="col-md-12 button-add-question"><a href="#" id="add_question" class="btn btn-lg btn-warning">Ajouter une question</a></div>');

            $questionsContainer.append($addQuestion);

            $addQuestion.click(function(e) {
                addQuestion($questionsContainer);
                e.preventDefault();
                return false;
            });

            function addQuestion($container) {
                var index = $questionsContainer.find(':input').length;
                var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Question').replace(/__name__/g, index));

                $container.append($prototype);

                var $contants = $('#formgenerator_formbundle_topic_questions_' + index);
                //Remove first label
                $prototype.find('label').eq(0).remove();

                $contants.children('div').eq(0).addClass('col-md-7 form-question');
                $contants.children('div').eq(1).addClass('col-md-5 form-checkbox');
                $contants.children('div').eq(2).addClass('col-md-12');

                $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
                $('#formgenerator_formbundle_topic_questions_' + index).children('div').eq(1).append($deleteLink);
                $deleteLink.click(function(e) {
                    $prototype.remove();
                    e.preventDefault();
                    return false;
                });

                $questionsContainer.append($prototype);

                //Ajout des réponses dans la question:
                var $answerContainer = $('#formgenerator_formbundle_topic_questions_'+ index +'_answers');

                var $addAnswer = $('<a href="#" id="add_question" class="btn btn-warning">Ajouter une réponse</a>');
                $answerContainer.append($addAnswer);

                $addAnswer.click(function(e) {
                    addAnswer($answerContainer, index);
                    e.preventDefault();
                    return false;
                });

                $('#formgenerator_formbundle_topic_questions').append($('.button-add-question'));
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

            function addAnswer($container, $index) {
                var $counter = $('#formgenerator_formbundle_topic_questions_' + $index + '_answers>div').length;

                // Dans le contenu de l'attribut « data-prototype », on remplace :
                // - le texte "__name__label__" qu'il contient par le label du champ
                // - le texte "__name__" qu'il contient par le numéro du champ
                var $prototype = $($container.attr('data-prototype')
                    .replace('formgenerator_formbundle_topic_questions_' + $index + '_answers_' + $index, 'formgenerator_formbundle_topic_questions_'+ $index + '_answers_' + $counter)
                    .replace('formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $index + '][answer]', 'formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $counter + '][answer]')
                    .replace('formgenerator_formbundle_topic[questions][' + $index  + '][answers][' + $index + '][isCorrect]', 'formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $counter +'][isCorrect]'));

                $container.append($prototype);

                // design

                var $question = $('#formgenerator_formbundle_topic_questions_'+ $index + '_answers_' + $counter);
                console.log($question.html());
                $question.children('div').eq(0).addClass('col-md-7 form-question');
                $question.children('div').eq(1).addClass('col-md-5 form-checkbox');
                $question.children('div').eq(2).addClass('col-md-12');

                $prototype.find('label').eq(0).remove();

                $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
                $('#formgenerator_formbundle_topic_questions_'+ $index + '_answers_' + $counter).children('div').eq(1).append($deleteLink);
                $deleteLink.click(function(e) {
                    $prototype.remove();
                    e.preventDefault();

                    return false;

                });
            }
        });