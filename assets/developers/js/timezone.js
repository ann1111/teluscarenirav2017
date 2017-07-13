$(document).ready(function(){
	
	date_string_obj  = $('#date_string');
	date_string_val = date_string_obj.html();

	time_string_obj  = $('#time_string');
	

	monthArr = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	var dayArr = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	var monthdayArr = [31,28,31,30,31,30,31,31,30,31,30,31];
	change_date = 0;
	clock_date_obj = new Date(gObj.currdate);
	cdate = clock_date_obj.getDate();
	cday = clock_date_obj.getDay();
	cmonth = clock_date_obj.getMonth();
	cyear = clock_date_obj.getFullYear();
	chour = clock_date_obj.getHours();
	cmin  =  clock_date_obj.getMinutes();
	csec  =  clock_date_obj.getSeconds();
	tunit = chour>=12 ? "pm" : "am";
	leap_year = cyear%4==0 ? 1 : 0;
	if(leap_year){
		monthdayArr[1] = 29;
	}
	function tick_time(){
		csec +=1 ;
		if(csec == 60){
			csec = 0;
			cmin += 1;
		}
		if(cmin == 60){
			csec = 0;
			cmin = 0;
			chour += 1;
		}
		if(chour == 12){
			csec  = 0;
			cmin  = 0;
			chour = 0
			/* tunit = "am"; */
			change_date = 1;
		}
		if(change_date){
			if(cday == 6){
				cday =0;
			}else{
				cday +=1;
			}
			last_day = monthdayArr[cmonth];
			if(last_day==cdate){
				cdate = 1;
				if(cmonth == 11){
					cyear +=1;
					cmonth = 0;
				}else{
					cmonth +=1;
					
				}
			}else{
				cdate +=1;
			}
		}
		date_str = dayArr[cday] + " " + monthArr[cmonth] + " "+ cdate + ", " +cyear;

		time_hr = chour > 12 ? (chour - 12) : chour;

		time_hr = chour < 10 ? "0"+chour : chour;

		time_min = cmin < 10 ? "0"+cmin : cmin;

		time_sec = csec < 10 ? "0"+csec : csec;

		time_str = time_hr + ":" + time_min + ":" + time_sec + " "+tunit;


		if(date_string_val!=date_str){
			//console.log(date_str);
			date_string_obj.html(date_str);
		}

		time_string_obj.html(time_str);

		//console.log(date_str);

		//console.log(time_str);
	}
	window.setInterval(function(){ tick_time();},1000);
});
