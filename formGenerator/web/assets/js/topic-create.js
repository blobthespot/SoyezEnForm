        $(document).ready(function() {
            var $questionsContainer = $('div#formgenerator_formbundle_topic_questions');
            var $addQuestion = $('<div class="col-md-12 button-add-question"><a href="#" id="add_question" class="btn btn-default">Ajouter une question</a></div>');

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

                var $addAnswer = $('<a href="#" id="add_answer" class="btn btn-default">Ajouter une réponse</a>');
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
                    .replace('formgenerator_formbundle_topic_questions_' + $index + '_answers_' + $index, 'formgenerator_formbundle_topic_questions_0_answers_' + $counter)
                    .replace('formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $index + '][answer]', 'formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $counter + '][answer]')
                    .replace('formgenerator_formbundle_topic[questions][' + $index  + '][answers][' + $index + '][isCorrect]', 'formgenerator_formbundle_topic[questions][' + $index + '][answers][' + $counter +'][isCorrect]'));

                /*var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Réponse')
                    .replace(/__name__/g, $counter));*/

                addDeleteLink($prototype);

                // design
                $prototype.find('label').eq(0).remove();

                $prototype.find('textarea,input[type="text"]').addClass('form-control');

                $prototype.find('input[type="checkbox"]').each(function() {
                  var $div = $(this).parent();
                  $div.addClass('checkbox');

                  var $label = $div.find('label');
                  var text = $label.text();
                  $label.html('');
                  $label.detach();

                  $div.contents().appendTo($label);
                  $label.appendTo($div);
                  $div.append(document.createTextNode(text));
                });

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