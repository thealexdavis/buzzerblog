jQuery(document).ready(function($) {
	function formatDate(inputDate) {
	    var date = new Date(inputDate);
	    if (!isNaN(date.getTime())) {
	        // Months use 0 index.
	        return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();
	    }
	}
	$( ".updateshow" ).click(function(e) {
		e.preventDefault();
		$.ajax({
			url: "https://api.tvmaze.com/shows/"+$("#tvmazenum").val(),
			dataType: 'json',
			success: function(result) {
				//Insert content
				parent.tinyMCE.activeEditor.setContent(result['summary']);
				//Close window
				parent.jQuery("#TB_closeWindowButton").click();
				$("#api_summary").val(result['summary']);
				$("#network").val(result['network']['name']);
				networkName = result['network']['name'];
				$( "#networkchecklist li" ).each(function( index ) {
					elem = $(this);
					elem.find("input[type='checkbox']").prop( "checked", false );
					if(elem.find("label").text().replace(/ /g,'') == networkName.replace(/ /g,'')){
						elem.find("input[type='checkbox']").prop( "checked", true );
					}
				});
				$("#country").val(result['network']['country']['name']);
				$("#status").val(result['status']);
				$("#debut_date").val(formatDate(result['premiered']));
				$("#website").val(result['officialSite']);
				$("#img").val(result['image']['original']);
			},
			error: function (textStatus, errorThrown) {
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
	});
	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;
	var meta_image_frame_img;
	var meta_image_frame_pdf;
	var meta_image_frame_doc;
 
	// Runs when the image button is clicked.
	$('#alert-image-button').click(function(e){
 
		// Prevents the default action from occuring.
		e.preventDefault();
 
		// If the frame already exists, re-open it.
		if ( meta_image_frame ) {
			meta_image_frame.open();
			return;
		}
 
		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: { text:  meta_image.button },
			library: { type: 'image' }
		});
 
		// Runs when an image is selected.
		meta_image_frame.on('select', function(){
 
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
 
			// Sends the attachment URL to our custom image input field.
			$('#alert-image').val(media_attachment.url);
			$('#alertimg-img').show();
			$('#alertimg-img').attr("src",media_attachment.url);
		});
 
		// Opens the media library frame.
		meta_image_frame.open();
	});
	$('.picbtn').click(function(e){
 
		// Prevents the default action from occuring.
		e.preventDefault();
		
		idtoGoto = $(this).attr("id").replace("-button","");
 
		// If the frame already exists, re-open it.
		if ( meta_image_frame_img ) {
			meta_image_frame_img.open();
			return;
		}
 
		// Sets up the media library frame
		meta_image_frame_img = wp.media.frames.meta_image_frame_img = wp.media({
			title: meta_image.title,
			button: { text:  meta_image.button },
			library: { type: 'image' }
		});
 
		// Runs when an image is selected.
		meta_image_frame_img.on('select', function(){
 
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame_img.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			$('#'+idtoGoto).val(media_attachment.url);
			$('#'+idtoGoto+"-img").show();
//             $("a.picview").attr("href",media_attachment.url).text(media_attachment.url);
			$('#'+idtoGoto+"-img").attr("src",media_attachment.url);
		});
 
		// Opens the media library frame.
		meta_image_frame_img.open();
	});
	
	$('.filebtn').click(function(e){
 
		// Prevents the default action from occuring.
		e.preventDefault();
 
		// If the frame already exists, re-open it.
		if ( meta_image_frame_pdf ) {
			meta_image_frame_pdf.open();
			return;
		}
 
		// Sets up the media library frame
		meta_image_frame_pdf = wp.media.frames.meta_image_frame_pdf = wp.media({
			title: meta_image.title,
			button: { text:  meta_image.button },
			library: { type: 'application/pdf' }
		});
 
		// Runs when an image is selected.
		meta_image_frame_pdf.on('select', function(){
 
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame_pdf.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			$('#resource_file').val(media_attachment.url);
			$('.file_name').removeClass('hide');
			$('.file_name a').attr("href",media_attachment.url).text(media_attachment.url);
			$('#resource_file').val(media_attachment.url);
		});
 
		// Opens the media library frame.
		meta_image_frame_pdf.open();
	});
	
	$('.docbtn').click(function(e){
 
		// Prevents the default action from occuring.
		e.preventDefault();
 
		// If the frame already exists, re-open it.
		if ( meta_image_frame_doc ) {
			meta_image_frame_doc.open();
			return;
		}
 
		// Sets up the media library frame
		meta_image_frame_doc = wp.media.frames.meta_image_frame_doc = wp.media({
			title: meta_image.title,
			button: { text:  meta_image.button },
			library: { type: ["application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "application/pdf"] }
		});
 
		// Runs when an image is selected.
		meta_image_frame_doc.on('select', function(){
 
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame_doc.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			$('#resource_file').val(media_attachment.url);
			$('.file_name').removeClass('hide');
			$('.file_name a').attr("href",media_attachment.url).text(media_attachment.url);
			$('#resource_file').val(media_attachment.url);
		});
 
		// Opens the media library frame.
		meta_image_frame_doc.open();
	});
	
	$( ".togglesize" ).click(function(e) {
		e.preventDefault();
		if ($(this).hasClass("expand")){
			$(this).addClass("collapse").removeClass("expand").text("Collapse");
			$(this).parent(".meta_block").parent(".specialty_block").removeClass("hidebucket");
		} else {
			$(this).removeClass("collapse").addClass("expand").text("Expand");
			$(this).parent(".meta_block").parent(".specialty_block").addClass("hidebucket"); 
		}
	});
	
	$( "#add_specialty" ).click(function(e) {
		e.preventDefault();
		numBox = parseInt($("input#specializationbox_vals").val()) + 1;
		$(".specialty_block.block_"+numBox).removeClass("totalhide");
		$("input#specializationbox_vals").val(numBox);
	});
	
	$( ".button#publish" ).click(function(e) {
		$(".totalhide").remove();
	});
	
	$( "select[name='site_id']" ).change(function() {
		$(".sitelist_item").addClass("totalhide").removeClass("activebox");
		if ($(this).val() !== 0){
			$("#target_results").removeClass("hide");
			$("#sitedropdown_"+$(this).val()).removeClass("totalhide").addClass("activebox");
			$("select.sitelist_item option").prop("selected", false);
		} else {
			$("#target_results").addClass("hide");
		}
	});
	
	$( "select[name='site_idd']" ).change(function() {
		$(".sitelist_itemm").addClass("totalhide").removeClass("activebox");
		if ($(this).val() !== 0){
			$("#target_resultss").removeClass("hide");
			$("#sitedropdownn_"+$(this).val()).removeClass("totalhide").addClass("activebox");
			$("select.sitelist_itemm option").prop("selected", false);
			$(".postinfo span.siteid").text($(this).val());
			$(".postinfo").hide();
		} else {
			$("#target_resultss").addClass("hide");
		}
	});
	
	$( "select[name='page_idd']" ).change(function() {
		$(".postinfo").show();
		$(".postinfo span.id").text($(this).val());
		$(".postinfo span.url").text($("#info_page .activebox option[value='"+$(this).val()+"']").attr("data-url"));
		tagList = $("#info_page .activebox option[value='"+$(this).val()+"']").attr("data-tags").split(",");
		$(".postinfo span.tags").html("");
		if (tagList.length > 0){
			for (x=0;x<tagList.length;x++){
				$(".postinfo span.tags").append(tagList[x]+"<br>");
			}
		} else {
			$(".postinfo span.tags").text("No tags");
		}
	});
	
	$( "input[name='resource_type']" ).change(function() {
		$(".buttonarea, p.file_name").addClass("hide");
		$("p.file_name a").text("").attr("href","");
		$("#resource_file").val("");
		$("."+$(this).val()+"_buttons").removeClass("hide");
		if ($(this).val() == 5){
			$(".2_buttons").removeClass("hide");
		}
	});
	
	$("body").on("keyup","#alert_search",function(e) {
		searchLength = $(this).val().length;
		searchTerm = $(this).val();
		searchedTerm = searchTerm.replace(/\s+/g, '').toLowerCase();
		if (searchLength > 2){
			$( "#alert_scope option" ).each(function( index ) {
				optionText = $(this).text().replace(/\s+/g, '').toLowerCase();
				if (optionText.indexOf(searchedTerm) < 0){
					$(this).hide();
					$(this).prop("selected", false);
				}
			});
		} else {
			$("#alert_scope option").show();
			$("#alert_scope option").prop("selected", false);
		}
	});
	
	$("body").on("keyup","#target_resultss",function(e) {
		searchLength = $(this).val().length;
		searchTerm = $(this).val();
		searchedTerm = searchTerm.replace(/\s+/g, '').toLowerCase();
		if (searchLength > 2){
			$( "#info_page select.activebox option" ).each(function( index ) {
				optionText = $(this).text().replace(/\s+/g, '').toLowerCase();
				if (optionText.indexOf(searchedTerm) < 0){
					$(this).hide();
					$(this).prop("selected", false);
				}
			});
		} else {
			$("#info_page select option").show();
			$("#info_page select.sitelist_item option").prop("selected", false);
		}
	});
	
	$("body").on("keyup","#target_results",function(e) {
		searchLength = $(this).val().length;
		searchTerm = $(this).val();
		searchedTerm = searchTerm.replace(/\s+/g, '').toLowerCase();
		if (searchLength > 2){
			$( "#link_page select.activebox option" ).each(function( index ) {
				optionText = $(this).text().replace(/\s+/g, '').toLowerCase();
				if (optionText.indexOf(searchedTerm) < 0){
					$(this).hide();
					$(this).prop("selected", false);
				}
			});
		} else {
			$("#link_page select option").show();
			$("#link_page select.sitelist_item option").prop("selected", false);
		}
	});
	
	$( ".removepic" ).click(function(e) {
		$("#antiochhero_img, .picval, .picremover").text("").val("");
		$(".pic_show, .picval, .picremover").hide().attr("src","");
		$(".file_name a").text("").attr("href","");
	});
	
	$( "#antiochhero_herocheck" ).click(function(e) {
		if ($(this).is(':checked')) {
			$(".hero_hide").hide();
			$("#antiochhero_showhero").val("1");
		} else {
			$(".hero_hide").show();
			$("#antiochhero_showhero").val("0");
		}
	});
	
	$( "#antiochhero_formcheck" ).click(function(e) {
		if ($(this).is(':checked')) {
			$("#antiochhero_hideform").val("1");
		} else {
			$("#antiochhero_hideform").val("0");
		}
	});
	
	$( "#antiochhero_sideways" ).click(function(e) {
		if ($(this).is(':checked')) {
			$("#antiochhero_hidesideways").val("1");
		} else {
			$("#antiochhero_hidesideways").val("0");
		}
	});
	
	$("body").on("click","#postinfo_hidehome",function(e) {
		if ($(this).is(':checked')) {
			$("#postinfo_hidehomeval").val("1").text("1");
		} else {
			$("#postinfo_hidehomeval").val("0").text("0");
		}
	});
	
	$( ".color_boxes .box" ).click(function(e) {
		$(".color_boxes .box").removeClass("active");
		$(this).addClass("active");
		colorval = $(this).attr("id").replace("color_","");
		$("#antiochhero_bgcolor").text(colorval).val(colorval);
	});
});