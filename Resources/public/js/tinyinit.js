tinymce.init({
	editor_selector : "tinymce",
	plugins: " code fullscreen save preview textcolor",
	mode : "specific_textareas",
	extended_valid_elements:  "i[class=myclass]",
	toolbar: "undo redo | styleselect | bold italic | link image | fullscreen | code | save | preview newdocument bold italic underline strikethrough | alignleft aligncenter alignright alignjustify styleselect | formatselect fontselect fontsizeselect cut copy paste bullist numlist outdent indent blockquote | undo redo removeformat subscript superscript",
	language_url: "",
	menubar : false,
	height: 300,
	width: 700
});