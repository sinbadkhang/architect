console.log('ok');

var myVar;

// 
function intervalFunc() {
  myVar = setInterval(syncFunc, 3000);
};

// SYNC DATABASE
function syncFunc(){
	// 1 GET DATA FROM BRANCH

	// 2 SEND DATA TO HEAD

	// 3 COMPARE DATA

	// 4 HANDLE CONFLICT ON HEAD

	// 5 GET DATA FROM HEAD 

	// 6 SEND DATA BACK TO BRANCH

	// 7 APPLY CHANGES
	console.log('Sync successfully');
};

$(document).ready(function(){
	$.fn.serializeObject = function()
	{
	    var o = {};
	    var a = this.serializeArray();
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	    return o;
	};

	// GET template
	$.ajax({
			method: 'GET',
			url: '../../api/category/read_single.php?id=1',
			dateType: 'json',
		}).done(function (data) {
			console.log(data);
			$('#id').val(data.id);
			$('#category_name').val(data.category_name);
			$('#category_id').val(data.category_id);
			
		}).fail(function (jqXHR, statusText, errorThrown) {
			console.log('fail: '+ jqXHR.responseText);
			console.log(statusText);
			console.log(errorThrown);
		})

	// ADD template
	$('#add-btn').click(function(){
		
		var formData = JSON.stringify($('#add-cate').serializeObject());
		console.log(formData);
		$.ajax({
			method: 'POST',
			url: '../../api/category/update.php',
			dateType: 'json',
			data: formData,
		}).done(function (data) {
			console.log(data);
			
		}).fail(function (jqXHR, statusText, errorThrown) {
			console.log('fail: '+ jqXHR.responseText);
			console.log(statusText);
			console.log(errorThrown);
		})
	})
	
	// SYNC
	$('#sync-btn').click(function(){
		
		$.ajax({
			method: 'GET',
			url: '../../api/account/read.php',
			dateType: 'json',
		}).done(function (data) {
			console.log(data);

			$.ajax({
			method: 'POST',
			url: '../../api/account/create.php',
			dateType: 'json',
			data: data
			}).done(function (data) {
				console.log(data);
				
			}).fail(function (jqXHR, statusText, errorThrown) {
				console.log('fail: '+ jqXHR.responseText);
				console.log(statusText);
				console.log(errorThrown);
			})
			
		}).fail(function (jqXHR, statusText, errorThrown) {
			console.log('fail: '+ jqXHR.responseText);
			console.log(statusText);
			console.log(errorThrown);
		})
	})
		

});