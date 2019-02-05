/*
 * UnderConstructionPage
 * Plugin deactivation survey
 * (c) WebFactory Ltd, 2015 - 2019
 */


jQuery(function($) {
  // ask users to confirm plugin deactivation
  $('#the-list tr span.deactivate a[data-under-construction-page="true"]').on('click', function(e) {
    $('#ucp-deactivate-survey').dialog('open');

    e.preventDefault();
    return false;
  }); // confirm plugin deactivation


  // turn questions into checkboxes
  $('#ucp-deactivate-survey').on('click', '.question-wrapper', function(e) {
    $('#ucp-deactivate-survey .question-wrapper').removeClass('selected');
    $(this).addClass('selected');

    if ($('input', this).length) {
      $('input', this).focus();
    }

    e.preventDefault();
    return false;
  });


  // cancel deactivation - close dialog
  $('.ucp-cancel-deactivate').on('click', function(e) {
    $('#ucp-deactivate-survey').dialog('close');

    return false;
  }); // close dialog


  // just deactivate - don't provide feedback
  $('.ucp-deactivate-direct').on('click', function(e) {
    deactivate_link = $('#the-list tr span.deactivate a[data-under-construction-page="true"]').attr('href');

    location.href = deactivate_link;
    $('#ucp-deactivate-survey').dialog('close');

    return false;
  }); // deactivate


  // deactivate + feedback
  $('.ucp-deactivate').on('click', function(e) {
    e.preventDefault();

    if ($('#ucp-deactivate-survey .question-wrapper.selected').length != 1) {
      alert('Please select a reason you\'re deactivating UCP.');
      return false;
    }

    answer = $('#ucp-deactivate-survey .question-wrapper.selected').data('value');
    answer += '-' + $('#ucp-deactivate-survey .question-wrapper').index($('#ucp-deactivate-survey .question-wrapper.selected'));
    custom_answer = $('#ucp-deactivate-survey .question-wrapper.selected .ucp-deactivation-details').val();

    $.post(ajaxurl, { survey: $(this).data('survey'),
                      answers: answer,
                      emailme: '',
                      custom_answer: custom_answer,
                      _ajax_nonce: ucp.nonce_submit_survey,
                      action: 'ucp_submit_survey'
    });


    alert('Thank you for your input! The plugin will now deactivate.');
    $('#ucp-deactivate-survey').dialog('close');

    deactivate_link = $('#the-list tr span.deactivate a[data-under-construction-page="true"]').attr('href');
    location.href = deactivate_link;

    return false;
  }); // deactivate + feedback


  // init deactivate survey dialog
  $('#ucp-deactivate-survey').dialog({'dialogClass': 'wp-dialog ucp-survey-dialog ucp-deactivate-dialog',
                               'modal': 1,
                               'resizable': false,
                               'zIndex': 9999,
                               'width': 550,
                               'height': 'auto',
                               'show': 'fade',
                               'hide': 'fade',
                               'open': function(event, ui) { },
                               'close': function(event, ui) { },
                               'autoOpen': false,
                               'closeOnEscape': true
                              });
}); // onload
