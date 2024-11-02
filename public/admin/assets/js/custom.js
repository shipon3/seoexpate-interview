$(function () {
	"use strict";
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-bottom-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
});
// delete global function
function deleteItem(url,id,callback)
{
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				var data = {
					"id" : id,
				}
				$.ajax({
					type: "DELETE",
					url: url+id,
					data: data,
					success: function(response){
						console.log(response);
						if(response.status == 'error'){
							Swal.fire(
								'Deleted!',
								'You can\'t delete this.',
								'error'
								).then((result)=>{
									callback(response,result);
								})
						}
						if(response.status == 'success'){
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
								).then((result)=>{
									callback(response,result);
								})
						}
						
					}
				});
				
			}
		});
}
// delete global function
function updateItem(url,id,callback)
{
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				var data = {
					"id" : id,
				}
				$.ajax({
					type: "GET",
					url: url+id,
					data: data,
					success: function(response){
						console.log(response);
						if(response.status == 'error'){
							Swal.fire(
								'Deleted!',
								'You can\'t Convert this.',
								'error'
								).then((result)=>{
									callback(response,result);
								})
						}
						if(response.status == 'success'){
							Swal.fire(
								'Success!',
								'Successfully Converted.',
								'success'
								).then((result)=>{
									callback(response,result);
								})
						}
						
					}
				});
				
			}
		});
}

// Approved global function
function approvedItem(url,id,callback)
{
	Swal.fire({
		title: 'Are you sure?',
		text: "You are approve this!",
		icon: 'success',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				var data = {
					"id" : id,
				}
				$.ajax({
					type: "GET",
					url: url+id,
					data: data,
					success: function(response){
						Swal.fire(
						'Approved',
						'Your item has been approved.',
						'success'
						).then((result)=>{
							callback(response,result);
						})
					}
				});
				
			}
		});
}

// restore user
function restore(url,id,callback)
{
	Swal.fire({
		title: 'Are you sure?',
		text: "You are restore this!",
		icon: 'success',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				var data = {
					"id" : id,
				}
				$.ajax({
					type: "GET",
					url: url+id,
					data: data,
					success: function(response){
						Swal.fire(
						'Restored',
						'Your item has been restored.',
						'success'
						).then((result)=>{
							callback(response,result);
						})
					}
				});
				
			}
		});
}
// Approved global function
function receivedItem(url,id,callback)
{
	Swal.fire({
		title: 'Are you sure?',
		text: "You are receive this!",
		icon: 'success',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				var data = {
					"id" : id,
				}
				$.ajax({
					type: "GET",
					url: url+id,
					data: data,
					success: function(response){
						Swal.fire(
						'Received',
						'Your item has been Received.',
						'success'
						).then((result)=>{
							callback(response,result);
						})
					}
				});
				
			}
		});
}

// error handel
function setRequire(error) {
	textEmpty();
	var obj = error.responseJSON.errors;
	const errorArray = Object.entries(obj).map(([field, messages]) => ({
		field,
		message: messages[0]
	}));
	errorArray.forEach(element => {
		var class_name = element.field.replace(/\./g, '-');
		$(".require-" + class_name).html(element.message);
	});
}

function textEmpty(){
	$(".text-empty").html('');
}
