
// console.log('ok');

// var myVar;

// // 
// function intervalFunc() {
//   myVar = setInterval(syncFunc, 3000);
// };

// // 
// function syncFunc(){
// 	console.log('Sync successfully');
// };

// $(document).ready(function(){
// 	$.fn.serializeObject = function()
// 	{
// 	    var o = {};
// 	    var a = this.serializeArray();
// 	    $.each(a, function() {
// 	        if (o[this.name] !== undefined) {
// 	            if (!o[this.name].push) {
// 	                o[this.name] = [o[this.name]];
// 	            }
// 	            o[this.name].push(this.value || '');
// 	        } else {
// 	            o[this.name] = this.value || '';
// 	        }
// 	    });
// 	    return o;
// 	};

// 	// Khang ajax get template

// 	// Khang template
// 	$('#add-product-btn').click(function(){
		
// 		var formData = JSON.stringify($('#insert_form').serializeObject());
// 		console.log(formData);
// 		$.ajax({
// 			method: 'POST',
// 			url: '../../api/category/create.php',
// 			dateType: 'json',
// 			data: formData,
// 		}).done(function (data) {
// 			console.log(data);
			
// 		}).fail(function (jqXHR, statusText, errorThrown) {
// 			console.log('fail: '+ jqXHR.responseText);
// 			console.log(statusText);
// 			console.log(errorThrown);
// 		})
// 	})
	
		

// });