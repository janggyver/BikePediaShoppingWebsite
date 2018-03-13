<SCRIPT LANGUAGE="JavaScript">
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- Original:  Andy Angrick/Mike Barone -->
<!-- Web Site:  http://www.cgiscript.net/datetoday.htm -->
<!-- Begin
// Get today's current date.
var now = new Date();

// Array list of days.
var days = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

// Array list of months.
var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

// Calculate the number of the current day in the week.
var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();

// Calculate four digit year.
function fourdigits(number)	{
	return (number < 1000) ? number + 1900 : number;
								}

// Join it all together
today =  days[now.getDay()] + " " +
              months[now.getMonth()] + " " +
               date + " " +
                (fourdigits(now.getYear())) ;

// Print out the data.
document.write(" " +today+ " ");
//  End -->
</script>


