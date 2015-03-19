		<script>
			$(document).read(function()
			{
				$("#sub").click(function()    //the submit button on login form has #sub id //when the user click the bottom ajax method should executed
				{
					$.ajax({
						url:"localhost/test/index.php",   //php location.
						type:"POST",                      //type of method. This should be similar to the method in php
						dataType:"json",                  //data type is json as we intend to send the data as json file or data
						data:{type:"login",UserName:"name",password:"pass"}, //this the data i want to send to php. 
						ContentType:"application/json",
						success:function(response)
						{
							alert(JSON.stringify(response));
						},
						error:function(err)
						{
							alert(JSON.stringify(err));
						}
					})
				})
			})
		</script
