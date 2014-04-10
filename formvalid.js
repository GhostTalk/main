$(function(){
	$("signupform").on("submit", function(e){
		e.preventDefault();
		
		alert('Stop!');
		//var formData = JSON.stringify($('signupform').serializeArray());
		//{
		//	'username'		:$('input[name=username]').val();
		//	'email'			:$('input[name=email]').val();
		//	'password'		:$('input[name=password]').val();
		//	'Rpassword'		:$('input[name=RPassword]').val();
		//	'first'			:$('input[name=First]').val();
		//	'last'			:$('input[name=Last]').val();
		//	'gender'		:$('input[name=gender]').val();
		//};
			
		$.ajax({
			type   		: 'POST',
			url	   		: 'process.php',
			data   		: JSON.stringify($('signupform').serializeArray()),
			dataType 	: 'json'
		})
		
		.done(function(data){
		
			alert('Getting here');
					
			console.log(data);
					
			if(!data.success){
				if(data.errors.Username){
					$('Username').append('<p>' + data.errors.Username + '</p>');
				}
								
				if(data.errors.Email){
					$('Email').append('<p>' + data.errors.Email + '</p>');
				}
									
				if(data.errors.password){
					$('Password').append('<p>' + data.errors.password + '</p>');
				}
									
				if(data.errors.passwordMatch){
					$('RPassword').append('<p>' + data.errors.passwordMatch + '</p>');
				}
									
				if(data.errors.First){
					$('First').append('<p>' + data.errors.First + '</p>');
				}
									
				if(data.errors.Last){
					$('Last').append('<p>' + data.errors.Last + '</p>');
				}
									
				if(data.errors.gender){
					$('gender').append('<p>' + data.errors.gender + '</p>');
				}
			} else{
						
				$('#form').append('<div>' + data.message + '</div>');
				alert('success');
			}
		})
		
		.fail(function(data){
			alert('Failing');
			console.log(data);
		});
						
						
	});
});

