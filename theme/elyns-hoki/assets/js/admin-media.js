(function ($) {
  'use strict';

  function renderPreview(targetId, ids) {
    var $preview = $('[data-preview-for="' + targetId + '"]');
    if (!$preview.length) return;

    $preview.empty();
    if (!ids) return;

    ids.split(',').forEach(function (id) {
      id = parseInt(id, 10);
      if (!id) return;

      var attachment = wp.media.attachment(id);
      attachment.fetch().then(function () {
        var sizes = attachment.get('sizes') || {};
        var url = (sizes.thumbnail && sizes.thumbnail.url) || attachment.get('url');
        if (url) {
          $preview.append('<span class="elyns-admin-thumb"><img src="' + url + '" alt=""></span>');
        }
      });
    });
  }

  $(document).on('click', '.elyns-select-gallery', function (e) {
    e.preventDefault();

    var targetId = $(this).data('target');
    var $input = $('#' + targetId);
    var currentIds = ($input.val() || '').split(',').filter(Boolean).map(function (id) {
      return parseInt(id, 10);
    });

    var frame = wp.media({
      title: 'Select Gallery Images',
      button: { text: 'Use Selected Images' },
      multiple: true,
      library: { type: 'image' }
    });

    frame.on('open', function () {
      var selection = frame.state().get('selection');
      currentIds.forEach(function (id) {
        var attachment = wp.media.attachment(id);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      });
    });

    frame.on('select', function () {
      var ids = [];
      frame.state().get('selection').each(function (attachment) {
        ids.push(attachment.id);
      });
      var value = ids.join(',');
      $input.val(value);
      renderPreview(targetId, value);
    });

    frame.open();
  });

  $(document).on('click', '.elyns-clear-gallery', function (e) {
    e.preventDefault();
    var targetId = $(this).data('target');
    $('#' + targetId).val('');
    $('[data-preview-for="' + targetId + '"]').empty();
  });
})(jQuery);
