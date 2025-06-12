(function ($) {
	function initBeforeAfter($scope) {
		$scope.find('.twentytwenty-container').each(function () {
			$(this).twentytwenty({
				default_offset_pct: 0.5,
				orientation: 'horizontal'
			});
		});
	}

	// For frontend
	$(document).ready(function () {
		initBeforeAfter($(document));
	});

	// For Elementor editor
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
			initBeforeAfter($scope);
		});
	});
})(jQuery);
