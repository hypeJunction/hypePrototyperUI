define(['elgg', 'jquery'], function(elgg, $) {

	$('.prototyper-ui-field').each(function() {
		var $field = $(this);
		$field.removeAttr('id').uniqueId();
		$field.find("[name*='__ID__']").each(function() {
			var $elem = $(this);
			$elem.attr('name', $elem.attr('name').replace('__ID__', $field.attr('id')));
		});
	});

	/**
	 * Add an available field type from left col to prototype
	 */
	$(document).on('click', '.prototyper-ui-add', function(e) {
		e.preventDefault();
		var dt = $(this).data('dt');
		var it = $(this).data('it');
		var $tmpl = $('.prototyper-ui-template[data-dt="' + dt + '"][data-it="' + it + '"]');
		var $clone = $tmpl.clone().removeAttr('id').uniqueId();
		$clone.find("[name*='__ID__']").each(function() {
			var $elem = $(this);
			$elem.attr('name', $elem.attr('name').replace('__ID__', $clone.attr('id')));
		});
		$('.prototyper-ui-dashboard-target').prepend($clone.removeClass('prototyper-ui-template').addClass('prototyper-ui-field'));
	});
	/**
	 * Clone an existing prototype field
	 */
	$(document).on('click', '.prototyper-ui-template-clone', function(e) {
		e.preventDefault();
		var $tmpl = $(this).closest('.prototyper-ui-field');
		var $clone = $tmpl.clone();
		var id = $clone.attr('id');
		$clone.removeAttr('id').uniqueId();
		$clone.find("[name*='ui-id-']").each(function() {
			var $elem = $(this);
			$elem.attr('name', $elem.attr('name').replace(id, $clone.attr('id')));
		});
		$tmpl.after($clone);

	});
	/**
	 * Remove an existing prototype field
	 */
	$(document).on('click', '.prototyper-ui-template-remove', function(e) {
		e.preventDefault();
		if (confirm(elgg.echo('question:areyousure'))) {
			$(this).closest('.prototyper-ui-field').fadeOut().remove();
		}
	});
	/**
	 * Expand field settings
	 */
	$(document).on('click', '.prototyper-ui-template-edit', function(e) {
		e.preventDefault();
		if ($(this).is('.elgg-state-expanded')) {
			$(this).closest('.prototyper-ui-template-head').next().hide();
			$(this).removeClass('elgg-state-expanded').addClass('elgg-state-collapsed');
		} else {
			$(this).closest('.prototyper-ui-template-head').next().show();
			$(this).addClass('elgg-state-expanded').removeClass('elgg-state-collapsed');
		}
	});
	/**
	 * Change input type
	 */
	$(document).on('change', '.prototyper-ui-dit-select', function(e) {
		var $elem = $(this);
		var $opt = $(this).find('option:selected');
		var dt = $opt.data('dt');
		var it = $opt.data('it');
		var $tmpl = $('.prototyper-ui-template .prototyper-ui-options[data-dt="' + dt + '"][data-it="' + it + '"]');
		var options = $tmpl.eq(0).data();
		$.each(options, function(key, val) {
			$elem.closest('.prototyper-ui-options').removeAttr("data-" + key).attr("data-" + key, val).data(val);
		});
	});
	/**
	 * Add a new option value
	 */
	$(document).on('click', '.prototyper-ui-options-add', function(e) {
		e.preventDefault();
		var $tmpl = $(this).closest('.prototyper-ui-options-item');
		var $clone = $tmpl.clone();
		$clone.find('input[type="text"]').val('');
		$tmpl.after($clone);
	});
	/**
	 * Remove an option value
	 */
	$(document).on('click', '.prototyper-ui-options-remove', function(e) {
		e.preventDefault();
		if (confirm(elgg.echo('question:areyousure'))) {
			$(this).closest('.prototyper-ui-options-item').fadeOut().remove();
		}
	});
	/**
	 * Remove templates from the form so they are not submitted
	 */
	$(document).on('submit', '.elgg-form-prototyper-edit', function(e) {
		$('.prototyper-ui-template', $(this)).remove();
		return true;
	});

	$(document).on('change', '#prototyper-filter', function(e) {
		$(this).closest('form').submit();
	});


	/**
	 * Make prototype fields sortable
	 */
	$('.prototyper-ui-dashboard-target').sortable({
		items: '.prototyper-ui-field',
		handle: '.elgg-icon-prototyper-ui-move'
	});
	/**
	 * Make options sortable
	 */
	$('.prototyper-ui-options-list').sortable({
		items: '.prototyper-ui-options-item',
		handle: '.elgg-icon-prototyper-ui-move'
	});
});