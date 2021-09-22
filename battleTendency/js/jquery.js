$(document).ready(function () {
  $('.second-button').on('click', function () {

    $('.animated-icon2').toggleClass('open');
  });

  $("form").submit(function(e){
		let x = $('label[for="email"]');
		//console.log(x.length);	
		if(x.length >= 1){
        e.preventDefault();
        let isFormOk = true;
		const str = /@/g;

        const email = $("input#email");
        let passwordError = "";
        $("li p").remove();
		
        if(email.val()==undefined || !(str.test(email.val()))){
		console.log("jojo");
            email.parent().append("<p>Insert valid email</p>");
            isFormOk = false;
        }
        if(isFormOk){
            e.currentTarget.submit(); 
        }
		}
    });
});