<?php 

/**
 * [digi_clock] returns the HTML code for a DIGITAL Clock.
 * @return string Digital Clock HTML Code - Created by Web Greco
*/

add_shortcode( 'digi_clock', 'digi_clock' );

function digi_clock( $atts ) {
 
 $output = '<span id="clock">'. date("h : i : s") .'</span>
 <script>
		setInterval(showTime, 1000);
		function showTime() {
			let time = new Date();
			let hour = time.getHours();
			let min = time.getMinutes();
			let sec = time.getSeconds();
			am_pm = "AM";

			if (hour > 12) {
				hour -= 12;
				am_pm = "PM";
			}
			if (hour == 0) {
				hr = 12;
				am_pm = "AM";
			}

			hour = hour < 10 ? "0" + hour : hour;
			min = min < 10 ? "0" + min : min;
			sec = sec < 10 ? "0" + sec : sec;

			let currentTime = hour + ":"
				// + min + ":" + sec + am_pm;
				+ min + ":" + sec ;

			document.getElementById("clock")
				.innerHTML = currentTime;
		}

		showTime();
	</script>';
 return $output;
}
