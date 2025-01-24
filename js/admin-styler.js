(function ($) {
	console.log("Admin menu styler script loaded");
	// Toggle function.
	$("[class*='-menu-section-header']").on("click", function () {
		let text = this.className;
		let stem = /\s([^\s]+)-section-header/.exec(text);

		if (stem[1]) {
			let target = $("li." + stem[1] + "-section-item");
			$(target).toggle();
		}
	});

	// "Open" section if item is active.
	let classes1 = $("li.wp-menu-open").attr("class");
	let classes2 = $("li.current").attr("class");

	let classes = classes1 + " " + classes2;

	let classList = classes.split(" ");
	classList = [...new Set(classList)]; // Remove duplicates.

	let len = classList.length;
	for (let i = 0; i < len; i++) {
		if (classList[i].includes("-menu-section-item")) {
			target = $("li." + classList[i]);
			$(target).toggle();
		}
	}
})(jQuery);