define(['elgg', 'jquery', 'cropper'], function (elgg, $) {

	$(document).on('change', 'input[type="file"][data-crop-ratio-w][data-crop-ratio-h]', function (e) {
		var $elem = $(this);
		var file = $elem[0].files[0];

		if (file && file.type.match(/image.*/)) {
			var reader = new FileReader();
			reader.onload = function (e) {
				var $container = $('.prototyper-image-upload-cropper', $elem.closest('.prototyper-fieldset'));
				$container.find('img').remove();

				var img = new Image();
				img.src = reader.result;
				img.alt = file.name;

				$container.addClass('prototyper-has-preview').append($(img));

				if (typeof $.fn.cropper !== 'undefined') {
					$('img', $container).cropper({
						aspectRatio: $elem.data('cropRatioW') / $elem.data('cropRatioH'),
						autoCropArea: 0.90,
						done: function (data) {
							$('input[data-x1]', $container).val(data.x);
							$('input[data-x2]', $container).val((data.x + data.width));
							$('input[data-y1]', $container).val(data.y);
							$('input[data-y2]', $container).val((data.y + data.height));
						}
					});
				}
			};
			reader.readAsDataURL(file);
		}
	});

});