<!-- <html><head> -->
<TITLE>Fortune Wheel:: BikePedia</TITLE>
<meta name="description" 	content="Get Premium Coupons with fortyne Whell." />
<meta name="author" 		content = "Eric Jang , janggyver@gmail.com" />
<meta name = "designer" 	content ="from the web + Eric Jang, janggyver@gmail" />


<LINK HREF="../Include/Generic.css" TYPE="text/css" REL="STYLESHEET">
<link href="../include/homepage.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../include/ProductPage.css" /> <!-- CSS for main container and footer -->

<!-- This wheel of fortune was borrowed from the web  -->

<meta http-equiv=X-UA-Compatible content="IE=EmulateIE7"/>
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"d0a4e3fcf906bdea02a46a74c9ce449b",petok:"364e3e327a0f6fcbd031e546a1d99e89eb2fc18a-1474342137-1800",zone:"bramp.net",rocket:"0",apps:{"ga_key":{"ua":"UA-136478-5","ga_bs":"2"}},sha2test:0}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=0489c402f5/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href=https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css type=text/css rel=stylesheet><script type=text/javascript src=https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js></script><script type=text/javascript src=jquery.tinysort.min.js></script><!--[if IE]><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jit/2.0.2/Extras/excanvas.min.js"></script><![endif]--><script type=text/javascript>// Helpers
	shuffle = function(o) {
		for ( var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x)
			;
		return o;
	};

	String.prototype.hashCode = function(){
		// See http://www.cse.yorku.ca/~oz/hash.html		
		var hash = 5381;
		for (i = 0; i < this.length; i++) {
			char = this.charCodeAt(i);
			hash = ((hash<<5)+hash) + char;
			hash = hash & hash; // Convert to 32bit integer
		}
		return hash;
	}

	Number.prototype.mod = function(n) {
		return ((this%n)+n)%n;
	}</script><script type=text/javascript>venues = {
		"116208"  : "Bike 10% Off",
		"66271"   : "Jacket 30% Off",
		"5518"    : "Helmet 1+1",
		"392360"  : "Lights Free",
		"2210952" : "Cap 2/$30",

	"207306"  : "Eyewear 50% Off",
		"41457"   : "Pants BOGO",
			"101161"  : "1 Item Free",
/*		"257424"  : "Afghan Kabob House",
		"512060"  : "The Perfect Pita",
		"66244"   : "California Tortilla",
		"352867"  : "Pho 75 - Rosslyn",
		"22493"   : "Ragtime",
		"268052"  : "Subway",
		"5665"    : "Summers Restaurant & Sports Bar",
		"129724"  : "Cosi",
		"42599"   : "Ray's Hell Burger" */
	};

	$(function() {

		var venueContainer = $('#venues ul');
		$.each(venues, function(key, item) {
			venueContainer.append(
		        $(document.createElement("li"))
				
		        .append(
	                $(document.createElement("input")).attr({
                         id:    'venue-' + key
                        ,name:  item
                        ,value: item
                        ,type:  'checkbox'
                        ,checked:true
	                })
	                .change( function() {
	                	var cbox = $(this)[0];
	                	var segments = wheel.segments;
	                	var i = segments.indexOf(cbox.value);

	                	if (cbox.checked && i == -1) {
	                		segments.push(cbox.value);

	                	} else if ( !cbox.checked && i != -1 ) {
	                		segments.splice(i, 1);
	                	}
						

	                	segments.sort();
	                	wheel.update();
	                } )

		        )
				.append(
	                $(document.createElement('label')).attr({
	                    'for':  'venue-' + key
	                })
	               // .text( item )
		        )
		    )
		});

		$('#venues ul>li').tsort("input", {attr: "value"});
	});</script><script type=text/javascript>// WHEEL!
	var wheel = {

		timerHandle : 0,
		timerDelay : 33,

		angleCurrent : 0,
		angleDelta : 0,

		size : 290,

		canvasContext : null,

		colors : [ '#ffff00', '#ffc700', '#ff9100', '#ff6301', '#ff0000', '#c6037e',
		           '#713697', '#444ea1', '#2772b2', '#0297ba', '#008e5b', '#8ac819' ],

		//segments : [ 'Andrew', 'Bob', 'Fred', 'John', 'China', 'Steve', 'Jim', 'Sally', 'Andrew', 'Bob', 'Fred', 'John', 'China', 'Steve', 'Jim'],
		segments : [],

		seg_colors : [], // Cache of segments to colors
		
		maxSpeed : Math.PI / 16,

		upTime : 100, // How long to spin up for (in ms)
		downTime : 3000, // How long to slow down for (in ms)

		spinStart : 0,

		frames : 0,

		centerX : 300,
		centerY : 300,

		spin : function() {

			// Start the wheel only if it's not already spinning
			if (wheel.timerHandle == 0) {
				wheel.spinStart = new Date().getTime();
				wheel.maxSpeed = Math.PI / (16 + Math.random()); // Randomly vary how hard the spin is
				wheel.frames = 0;
				wheel.sound.play();

				wheel.timerHandle = setInterval(wheel.onTimerTick, wheel.timerDelay);
			}
		},

		onTimerTick : function() {

			wheel.frames++;

			wheel.draw();

			var duration = (new Date().getTime() - wheel.spinStart);
			var progress = 0;
			var finished = false;

			if (duration < wheel.upTime) {
				progress = duration / wheel.upTime;
				wheel.angleDelta = wheel.maxSpeed
						* Math.sin(progress * Math.PI / 2);
			} else {
				progress = duration / wheel.downTime;
				wheel.angleDelta = wheel.maxSpeed
						* Math.sin(progress * Math.PI / 2 + Math.PI / 2);
				if (progress >= 1)
					finished = true;
			}

			wheel.angleCurrent += wheel.angleDelta;
			while (wheel.angleCurrent >= Math.PI * 2)
				// Keep the angle in a reasonable range
				wheel.angleCurrent -= Math.PI * 2;

			if (finished) {
				clearInterval(wheel.timerHandle);
				wheel.timerHandle = 0;
				wheel.angleDelta = 0;
/*
				$("#counter").html((wheel.frames / duration * 1000) + " FPS"); */
				

				alert("Congratulations! You got a good gift coupon for BikePedia.");
				var url = "http://localhost/products.php" ;
				window.location.replace(url);

		
			}
			


			/*
			// Display RPM
			var rpm = (wheel.angleDelta * (1000 / wheel.timerDelay) * 60) / (Math.PI * 2);
			$("#counter").html( Math.round(rpm) + " RPM" );
			 */
		},

		init : function(optionList) {
			try {
				wheel.initWheel();
				wheel.initAudio();
				wheel.initCanvas();
				wheel.draw();

				$.extend(wheel, optionList);

			} catch (exceptionData) {
				alert('Wheel is not loaded ' + exceptionData);
			}

		},

		initAudio : function() {
			var sound = document.createElement('audio');
			sound.setAttribute('src', 'wheel.mp3');
			wheel.sound = sound;
		},

		initCanvas : function() {
			var canvas = $('#wheel #canvas').get(0);

			if ($.browser.msie) {
				canvas = document.createElement('canvas');
				$(canvas).attr('width', 1000).attr('height', 600).attr('id', 'canvas').appendTo('.wheel');
				canvas = G_vmlCanvasManager.initElement(canvas);
			}

			canvas.addEventListener("click", wheel.spin, false);
			wheel.canvasContext = canvas.getContext("2d");
		},

		initWheel : function() {
			shuffle(wheel.colors);
		},

		// Called when segments have changed
		update : function() {
			// Ensure we start mid way on a item
			//var r = Math.floor(Math.random() * wheel.segments.length);
			var r = 0;
			wheel.angleCurrent = ((r + 0.5) / wheel.segments.length) * Math.PI * 2;

			var segments = wheel.segments;
			var len      = segments.length;
			var colors   = wheel.colors;
			var colorLen = colors.length;

			// Generate a color cache (so we have consistant coloring)
			var seg_color = new Array();
			for (var i = 0; i < len; i++)
				seg_color.push( colors [ segments[i].hashCode().mod(colorLen) ] );

			wheel.seg_color = seg_color;

			wheel.draw();
		},

		draw : function() {
			wheel.clear();
			wheel.drawWheel();
			wheel.drawNeedle();
		},

		clear : function() {
			var ctx = wheel.canvasContext;
			ctx.clearRect(0, 0, 1000, 800);
		},

		drawNeedle : function() {
			var ctx = wheel.canvasContext;
			var centerX = wheel.centerX;
			var centerY = wheel.centerY;
			var size = wheel.size;

			ctx.lineWidth = 1;
			ctx.strokeStyle = '#000000';
			ctx.fileStyle = '#ffffff';

			ctx.beginPath();

			ctx.moveTo(centerX + size - 40, centerY);
			ctx.lineTo(centerX + size + 20, centerY - 10);
			ctx.lineTo(centerX + size + 20, centerY + 10);
			ctx.closePath();

			ctx.stroke();
			ctx.fill();

			// Which segment is being pointed to?
			var i = wheel.segments.length - Math.floor((wheel.angleCurrent / (Math.PI * 2))	* wheel.segments.length) - 1;

			// Now draw the winning name
			ctx.textAlign = "left";
			ctx.textBaseline = "middle";
			ctx.fillStyle = '#000000';
			ctx.font = "2em Arial";
			ctx.fillText(wheel.segments[i], centerX + size + 25, centerY);
		},

		drawSegment : function(key, lastAngle, angle) {
			var ctx = wheel.canvasContext;
			var centerX = wheel.centerX;
			var centerY = wheel.centerY;
			var size = wheel.size;

			var segments = wheel.segments;
			var len = wheel.segments.length;
			var colors = wheel.seg_color;

			var value = segments[key];
			
			ctx.save();
			ctx.beginPath();

			// Start in the centre
			ctx.moveTo(centerX, centerY);
			ctx.arc(centerX, centerY, size, lastAngle, angle, false); // Draw a arc around the edge
			ctx.lineTo(centerX, centerY); // Now draw a line back to the centre

			// Clip anything that follows to this area
			//ctx.clip(); // It would be best to clip, but we can double performance without it
			ctx.closePath();

			ctx.fillStyle = colors[key];
			ctx.fill();
			ctx.stroke();

			// Now draw the text
			ctx.save(); // The save ensures this works on Android devices
			ctx.translate(centerX, centerY);
			ctx.rotate((lastAngle + angle) / 2);

			ctx.fillStyle = '#000000';
			ctx.fillText(value.substr(0, 20), size / 2 + 20, 0);
			ctx.restore();

			ctx.restore();
		},

		drawWheel : function() {
			var ctx = wheel.canvasContext;

			var angleCurrent = wheel.angleCurrent;
			var lastAngle    = angleCurrent;

			var segments  = wheel.segments;
			var len       = wheel.segments.length;
			var colors    = wheel.colors;
			var colorsLen = wheel.colors.length;

			var centerX = wheel.centerX;
			var centerY = wheel.centerY;
			var size    = wheel.size;

			var PI2 = Math.PI * 2;

			ctx.lineWidth    = 1;
			ctx.strokeStyle  = '#000000';
			ctx.textBaseline = "middle";
			ctx.textAlign    = "center";
			ctx.font         = "1.4em Arial";

			for (var i = 1; i <= len; i++) {
				var angle = PI2 * (i / len) + angleCurrent;
				wheel.drawSegment(i - 1, lastAngle, angle);
				lastAngle = angle;
			}
			// Draw a center circle
			ctx.beginPath();
			ctx.arc(centerX, centerY, 20, 0, PI2, false);
			ctx.closePath();

			ctx.fillStyle   = '#ffffff';
			ctx.strokeStyle = '#000000';
			ctx.fill();
			ctx.stroke();

			// Draw outer circle
			ctx.beginPath();
			ctx.arc(centerX, centerY, size, 0, PI2, false);
			ctx.closePath();

			ctx.lineWidth   = 10;
			ctx.strokeStyle = '#000000';
			ctx.stroke();
		},
	}

	window.onload = function() {
		wheel.init();

		var segments = new Array();
		$.each($('#venues input:checked'), function(key, cbox) {
			segments.push( cbox.value );
		});

		wheel.segments = segments;
		wheel.update();

		// Hide the address bar (for mobile devices)!
		setTimeout(function() {
			window.scrollTo(0, 1);
		}, 0);
	}</script>
	<!-- </head> -->
	<body>
	<div id=venues style=float:left><ul/></div>
	<div id=wheel><canvas id=canvas width=1000 height=600></canvas></div>
	<div id=stats><div id=counter></div></div><script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-136478-5']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>

</body>
<!--</html> -->
