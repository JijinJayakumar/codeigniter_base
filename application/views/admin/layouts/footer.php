		
            </div><!-- ./main_cont_inner -->
        </div><!-- ./main_cont -->
		



    </div><!-- ./cont_dash -->
    
  </div><!-- ./main_dash -->
    
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- Mobile Menu -->
    <script>
		$('.mobile_menu').click(function(){
			$('#sidebar_h').toggleClass('autoHeight');
			});
	</script>
    
    <!-- Sidebar Dropdown -->
    <script>
		$('.dropdown_list .arrow_down').click(function(){
			$(this).siblings('.dropdown_inner_main').toggle();
			$(this).children().toggleClass('fa-angle-right fa-angle-down');
			});
	</script>
    
    <!-- Image add input -->
    <script>
		$(document).ready(function() {
		
			
			var readURL = function(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
		
					reader.onload = function (e) {
						$('.profile-pic').attr('src', e.target.result);
					}
			
					reader.readAsDataURL(input.files[0]);
				}
			}
			
		
			$(".file-upload").on('change', function(){
				readURL(this);
			});
			
			$(".upload-button").on('click', function() {
			   $(".file-upload").click();
			});
		});
	</script>
    
    <!-- File choose trigger -->
    <script>		
		$('.attachment').click(function(){
			$(this).siblings().trigger('click');
			});
	</script>


  </body>
</html>