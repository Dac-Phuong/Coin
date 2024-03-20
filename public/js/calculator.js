$(document).ready(function(){
    $('.campaign .owl-carousel').owlCarousel({
        loop: true,
        items: 3,
        nav: true,
        navText: [
            "<img src='https://hbr.edu.vn/templates/kaizen/icons/next-arrow.png' width='14' height='26' alt='Previous' />",
            "<img src='https://hbr.edu.vn/templates/kaizen/icons/next-arrow.png' width='14' height='26' alt='Next' />",
        ],
        smartSpeed: 1200,
        autoplayTimeout: 3000,
        center: true,
        autoplay: false,
        responsive: {
            0: {
                items: 1,
                center: false,
                margin: 0,
            },

            992: {
                items: 3,
                //margin: 300,
            },
            1200: {
                //margin: 250,
            },
        },
    });





var percent = document.getElementById("Ultra").value;
	var percent =  parseFloat(document.getElementById("Ultra").value);
	var minMoney 	= [10,25.00,1000.00,50.00,100.00 ];
	var maxMoney	= [5001.00,5001.00,8001.00,5001.00,5001.00 ];
	$("#money").val(minMoney[0]);
	console.log($("#money").val(minMoney[0]));

	//Calculator
	function calc(){
		var money = parseFloat($("#money").val());
		switch (percent) {
		    case 0:
		        if( (money >= 10 && money < 9999999999)){
		        	var profitDaily = money / 100 * 0.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 500 * 0.5 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 0.5;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 500 * 0.5;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text('$' + profitDaily);
					$("#profitTotal").text('$' + profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
				//} else if(isNaN(money) == true) {
				} if (money < 10){
					$("#profitDaily").text("Error!");
					$("#profitTotal").text("Error!");
					$("#profitPercent").text("Error!");
					$("#profitNet").text("Error!");
				}
		        break;
			case 1:
		        if ( money >= 10 && money <= 999){

		        	var profitDaily = money / 100 *  9;
					var profitDaily = profitDaily.toFixed(2);

					var profitTotal = money / 100 *  9 * 13;
					var profitTotal = profitTotal.toFixed(2);



					var profitPercent =9 ;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 2.5;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);

					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');

					$("#profitNet").text('$' + profitNet);
					//} else if(isNaN(money) == true) {
		        } /*if (money >= 2001 && money <= 3000) {
		        	var profitDaily = money / 100 * 2.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 2.5 * 90 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 2.5;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 2.5 * 90;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 3001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 3;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 3 * 90 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 3;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 3 * 90;
					var profitNet = profitNet.toFixed(2);


					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);


				}*/ if (money < 10) {
					$("#profitDaily").text("Min: $10");
					$("#profitTotal").text("Min: $10");
					$("#profitPercent").text("Min: $10");
					$("#profitNet").text("Min: $10");
				}
					if (money > 999){
					$("#profitDaily").text("Max: $999");
					$("#profitTotal").text("Max: $999");
					$("#profitPercent").text("Max: $999");
					$("#profitNet").text("Max: $999");
				}
		        break;
		    case 2:
		    	 if ( money >= 1000 && money <= 2999){

		        	var profitDaily = money / 100 * 18;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 18 * 10;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 18;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 10;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
					//} else if(isNaN(money) == true) {
		        }  /*if (money >= 3001 && money <= 5000) {
		        	var profitDaily = money / 100 * 5.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 5.5 * 35 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 5.5;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 5.5 * 35;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 5001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 6;
					var profitDaily = profitDaily.toFixed(2);
		        	var profitTotal = money / 100 * 6 * 35 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 6;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 6 * 35;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
		        }*/  if (money < 1000) {
					$("#profitDaily").text("Min: $1000");
					$("#profitTotal").text("Min: $1000");
					$("#profitPercent").text("Min: $1000");
					$("#profitNet").text("Min: $1000");
				}
					if (money > 2999){
					$("#profitDaily").text("Max: $2999");
					$("#profitTotal").text("Max: $2999");
					$("#profitPercent").text("Max: $2999");
					$("#profitNet").text("Max: $2999");
				}

		        break;
		    case 3:
		    	 if ( money >= 3000 && money <= 4999){

		        	var profitDaily = money / 100 *  200;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 200;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 200;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 10;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
					//} else if(isNaN(money) == true) {
		        } /*if (money >= 5001 && money <= 10000) {
		        	var profitDaily = money / 100 * 11;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 11 * 18 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 11;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 11 * 18;
					var profitNet = profitNet.toFixed(2);


					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
		        } if (money >= 10001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 12;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 12 * 18 + money;
					var profitTotal = profitTotal.toFixed(2)
					var profitPercent = 12;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 12 * 18;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
		        }*/if (money < 3000) {
					$("#profitDaily").text("Min: $3000");
					$("#profitTotal").text("Min: $3000");
					$("#profitPercent").text("Min: $3000");
					$("#profitNet").text("Min: $3000");
				}
					if (money > 4999){
					$("#profitDaily").text("Max: $4999");
					$("#profitTotal").text("Max: $4999");
					$("#profitPercent").text("Max: $4999");
					$("#profitNet").text("Max: $4999");
				}
		        break;
		    case 4:
		    	 if ( money >= 5000 && money <= 100000){

		        	var profitDaily = money / 100 * 300;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 300;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 300;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 20;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
					//} else if(isNaN(money) == true) {
		        } /* if (money >= 10001 && money < 20000) {
		        	var profitDaily = money / 100 * 19;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 19 * 10 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 19;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 19 * 10;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 20001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 20;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 20 * 10 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 20;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 20 * 10;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        }*/ if (money < 5000){
					$("#profitDaily").text("Min: $5000");
					$("#profitTotal").text("Min: $5000");
					$("#profitPercent").text("Min: $5000");
					$("#profitNet").text("Min: $5000");
				}
					if (money > 100000){
					$("#profitDaily").text("Max: $100000");
					$("#profitTotal").text("Max: $100000");
					$("#profitPercent").text("Max: $100000");
					$("#profitNet").text("Max: $100000");
				}

		        break;
		         case 5:
		         if ( money >= 25   && money <= 20000){

		        	var profitDaily = money / 100 * 120;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 120;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 120;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 120;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
					//} else if(isNaN(money) == true) {
		        }  if (money < 25){
					$("#profitDaily").text("Min: $25");
					$("#profitTotal").text("Min: $25");
					$("#profitPercent").text("Min: $25");
					$("#profitNet").text("Min: $25");
				}
					if (money > 20000){
					$("#profitDaily").text("Max: $20000");
					$("#profitTotal").text("Max: $20000");
					$("#profitPercent").text("Max: $20000");
					$("#profitNet").text("Max: $20000");
				}
		        break;
		         case 6:
		       if ( money >= 200   && money <= 20000){

		        	var profitDaily = money / 100 * 130;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 130;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 130;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 3 * 65;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money < 200  ){
					$("#profitDaily").text("Min: $200 ");
					$("#profitTotal").text("Min: $200");
					$("#profitPercent").text("Min: $200");
					$("#profitNet").text("Min: $200");
				}
					if (money > 20000){
					$("#profitDaily").text("Max: $20000");
					$("#profitTotal").text("Max: $20000");
					$("#profitPercent").text("Max: $20000");
					$("#profitNet").text("Max: $20000");
				}
		        break;
		        case 7:
		        if ( money >= 50 && money <=  500){

		        	var profitDaily = money / 100 *160;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 160 ;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 160;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 160;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money < 50){
					$("#profitDaily").text("Min: $50");
					$("#profitTotal").text("Min: $50");
					$("#profitPercent").text("Min: $50");
					$("#profitNet").text("Min: $50");
				}
					if (money >  500){
					$("#profitDaily").text("Max: $500");
					$("#profitTotal").text("Max: $500");
					$("#profitPercent").text("Max: $500");
					$("#profitNet").text("Max: $500");
				}
		        break;
		        case 8:
		       if ( money >= 500 && money <= 20000){

		        	var profitDaily = money / 100 * 300;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 300;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 300;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 300;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        }  if (money < 500){
					$("#profitDaily").text("Min: $500");
					$("#profitTotal").text("Min: $500");
					$("#profitPercent").text("Min: $500");
					$("#profitNet").text("Min: $500");
				}
					if (money >  20000){
					$("#profitDaily").text("Max: $20000");
					$("#profitTotal").text("Max: $20000");
					$("#profitPercent").text("Max: $20000");
					$("#profitNet").text("Max: $20000");
				}
		        break;
		        case 9:
		 		if ( money >= 5000 && money <= 100000){

		        	var profitDaily = money / 100 * 10;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 10 * 50 + money;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 10;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 10 * 50;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        }  if (money < 5000){
					$("#profitDaily").text("Min: $5000");
					$("#profitTotal").text("Min: $5000");
					$("#profitPercent").text("Min: $5000");
					$("#profitNet").text("Min: $5000");
				}
		        break;
		    case 10:
		    	if ( money >= 20 && money <= 1000){

		        	var profitDaily = money / 100 * 900 / 70;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 900 ;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 900;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 900 - money;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 1001 && money <= 3000) {
		        	var profitDaily = money / 100 * 950 / 70;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 950;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 950;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 950 - money;
					var profitNet = profitNet.toFixed(2);


					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 3001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 1000 / 70;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 1000;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 1000;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 1000 - money;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);
		        } if (money < 20){
					$("#profitDaily").text("Min: $20");
					$("#profitTotal").text("Min: $20");
					$("#profitPercent").text("Min: $20");
					$("#profitNet").text("Min: $20");
				}
		        break;
		    case 11:
		    	if ( money >= 10 && money <= 1000){

		        	var profitDaily = money / 100 * 1800 / 120;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 1800;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 1800;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 1800 - money;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 1001 && money <= 3000) {
		        	var profitDaily = money / 100 * 1900 / 120;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 1900 * 1;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 1900;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 1900 - money;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        } if (money >= 3001 && money < 9999999999) {
		        	var profitDaily = money / 100 * 2000 / 120;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = money / 100 * 2000;
					var profitTotal = profitTotal.toFixed(2);
					var profitPercent = 2000;
					var profitPercent = profitPercent.toFixed(2);
					var profitNet = money / 100 * 2000 - money;
					var profitNet = profitNet.toFixed(2);

					$("#profitDaily").text(profitDaily);
					$("#profitTotal").text(profitTotal);
					$("#profitPercent").text(profitPercent + '%');
					$("#profitNet").text('$' + profitNet);

		        }if (money < 10){
					$("#profitDaily").text("Min: $10");
					$("#profitTotal").text("Min: $10");
					$("#profitPercent").text("Min: $10");
					$("#profitNet").text("Min: $10");
				}
		        break;

		}
	}
	if($("#money").length){
		calc();
	}
	$("#money").keyup(function(){
		calc();
	});

	$("#Ultra").on('change', function() {
		percent = parseFloat(this.value);
		calc();
	})



});












