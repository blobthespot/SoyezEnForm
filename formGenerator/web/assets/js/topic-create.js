        $(document).ready(function() {
            var $questionsContainer = $('div#formgenerator_formbundle_topic_questions');
            var $addQuestion = $('<a href="#" id="add_question" class="btn btn-default">Ajouter une question</a>');

            $questionsContainer.append($addQuestion);

            $addQuestion.click(function(e) {
                addQuestion($questionsContainer);
                e.preventDefault();
                return false;
            });

            function addQuestion($container) {
                var index = $questionsContainer.find(':input').length;
                var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Question').replace(/__name__/g, index));
                addDeleteLink($prototype);
                $container.append($prototype);

                // design
                $prototype.addClass('row form-group');

                var $cont = $prototype.children('div');
                $cont.addClass('col-md-12');

                var $contents = $cont.contents().detach();
                $('<div class="row"><div class="col-md-6 cont1"></div><div class="col-md-6 cont2"></div></div>').appendTo($cont);
                $contents.appendTo($cont.find('.cont1'));


                $prototype.find('label').eq(0).remove();

                $prototype.find('.btn.btn-danger').appendTo($cont.find('.cont2'));

                $prototype.find('label').addClass('control-label');
                $prototype.find('input[type="text"]').addClass('form-control');

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

                $('#formgenerator_formbundle_topic_questions').append($('#add_question'));
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