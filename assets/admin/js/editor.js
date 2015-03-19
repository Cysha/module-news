function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+\_/g, '-')           // Replace hyphens followed by spaces to with -
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}
$(document).ready(function(){
	$('input[name=title]').on('keyup', function(){
	  var slugValue = slugify( $(this).val() );
	  $('#slug').val( slugValue );
	});
});