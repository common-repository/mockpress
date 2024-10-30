(function ($) {
	/**
	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	// var WidgetHelloWorldHandler = function( $scope, $ ) {
	// 	console.log( $scope );
	// };

	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/hello-world.default', WidgetHelloWorldHandler);
	});



	jQuery("document").ready(function (n) {
		alert("Shazam");
		var e = window.settingAutoplay;
		alert("fsafa");
		e ? (n("#mute-sound").show(), document.getElementById("song").play()) : n("#unmute-sound").show(), n("#audio-container").click(function (u) {
			e ? (n("#mute-sound").hide(), n("#unmute-sound").show(), document.getElementById("song").pause(), e = !1) : (n("#unmute-sound").hide(), n("#mute-sound").show(), document.getElementById("song").play(), e = !0)
		})
	});

})(jQuery);