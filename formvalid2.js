$("signupform").on("submit", function(e){
	e.preventDefault();
			
			
			var formData = {
				'username'		:$('input[name=username]').val();
				'email'			:$('input[name=email]').val();
				'password'		:$('input[name=password]').val();
				'Rpassword'		:$('input[name=RPassword]').val();
				'first'			:$('input[name=First]').val();
				'last'			:$('input[name=Last]').val();
				'Gender'		:$('input[name=Gender]').val();
			};
			
			$.ajax({
					type   		: 'POST',
					url	   		: 'process.php',
					data   		: 'formData',
					dataType 	: 'json'
			})
					.done(function(data){
					
						console.log(data);
						
						if(! data.success){
									if(data.errors.Username){
										$('#Username').append('<div class ="error">' + data.errors.Username + '</div>');
									
									}
									
									if(data.errors.Email){
										$('#Email').append('<div class ="error">' + data.errors.Email + '</div>');
									}
									
									if(data.errors.password){
										$('#Password').append('<div class ="error">' + data.errors.password + '</div>');
									}
									
									if(data.errors.passwordMatch){
										$('#RPassword').append('<div class ="error">' + data.errors.passwordMatch + '</div>');
									}
									
									if(data.errors.First){
										$('#First').append('<div class ="error">' + data.errors.First + '</div>');
									}
									
									if(data.errors.Last){
										$('#Last').append('<div class ="error">' + data.errors.Last + '</div>');
									}
									
									if(data.errors.Gender){
										$('#Gender').append('<div class ="error">' + data.errors.Gender + '</div>');
									}
							}
							
						else{
						
								$('#form').append('<div>' + data.message + '</div>');
								alert('success');
							}
					
					});
						.fail(function(data){
								console.log(data);
							
						});
						
						
						event.preventDefault();
					});
	});
				
