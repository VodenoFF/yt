"use strict";
var HOST = "http://server.youtube2mp3.ml:8000";
var SOCKET = null;
var CT = 1; //1-mp3//2-mp4//
var downloadurl = null;
var counter = 10;
var id;
var requesttimer = 1;

function timer() {	
id = setInterval(function() {
    counter--;
    if(counter < 0) {
		requesttimer = 1;
        clearInterval(id);
    }
}, 1000);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function connect() {
	if(!SOCKET) {
			console.log("Connecting to server...");
			SOCKET = io(HOST, {
		secure: true
    });
			SOCKET.on('connect', function(msg) {
				console.log("Connected!");
			});
			SOCKET.on('connect_error', function(msg) {
				console.log("Connection lost...");
			});
			SOCKET.on('servermsg', function(msg) {
			onMessage(msg);
			});
	} else {
		console.log("Error: Existing connection found");
	}
}

function onMessage(msg) {
	var m = msg;
	if (m.type == "addalertfromserver") {
		$('#button').fadeIn('slow');
		addalert(m.alerttype, m.alerttext);
	} else if (m.type == "videoinfo") {
		videoinfo(m.title, m.thumbnail);
	} else if (m.type == "percentage") {
		percentage(m.percentage);
	} else if (m.type == "download") {
		download(m.newurl);
	}
}

function send(msg) {
	if (SOCKET) {
		SOCKET.emit('clientmsg', msg);
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getQueryVariable(variable) {
var query = window.location.search.substring(1)
var vars = query.split("&");
for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=")
    if(pair[0] == variable){
        if(pair[1].indexOf('%20') != -1){
            console.log(pair[1].indexOf('%20'))
            var fullName = pair[1].split('%20')
            console.log(fullName)
            return fullName[0] + ' ' + fullName[1]
        }
        else {
            return pair[1];
        }
    }
}
return(false)
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function videoinfo(title, thumbnail) {
	$( "#alerts" ).slideToggle().empty();
	$("#input_background").fadeOut('slow');
	$('#title').html('Your video is being processed!');
	$('#thumbnail').css('background-image', 'url('+thumbnail+')').slideToggle();
	$('#songtitle').html(title).slideToggle();
	$("#progressbar").slideToggle();
}

function percentage(percentage) {
	$("#progressbarp").css('width', percentage+'%');
	$("#progressbarp").html(percentage+'%');
}

function download(newurl) {
	$("#progressbarp").css('width', '100%');
	$("#progressbar").fadeOut('slow');
	$("#download").slideToggle();
	downloadurl = newurl;
	addnext();
	$("#ads").html("<script data-cfasync='false' type='text/javascript' src='//p172415.clksite.com/adServe/banners?tid=172415_328011_0&tagid=2'></script>");	
}

function refreshall() {
	$("#progressbarp").css('width', '0%');
	$("#mp4").fadeIn('slow');
	$("#mp3").fadeIn('slow');
	$("#nextsong").fadeOut('slow');
	$('#title').html('Please insert a YouTube Video link :)');
	$('#thumbnail').slideToggle();
	$('#songtitle').slideToggle();
	$("#download").slideToggle();
	$("#input_background").fadeIn('slow');
	$('#video').val('');
	$("#button").removeClass("disabled");
	$('#button').fadeIn('slow');
	$("#ads").empty();
}

function addnext() {
	$("#mp4").fadeOut('slow');
	$("#mp3").fadeOut('slow');
	$("#nextsong").fadeIn('slow');
}

function addalert(alerttype, alerttext) {
	$( "#alerts" ).slideToggle().empty();
	setTimeout(function(){if (alerttype == 1) {
		$( "#alerts" ).hide().append( '<div class="alert alert-success" role="alert">'+alerttext+'</div>' ).slideToggle();
	} else if (alerttype == 2) {
		$( "#alerts" ).hide().append( '<div class="alert alert-info" role="alert">'+alerttext+'</div>' ).slideToggle();
	} else if (alerttype == 3) {
		$( "#alerts" ).hide().append( '<div class="alert alert-warning" role="alert">'+alerttext+'</div>' ).slideToggle();
	} else if (alerttype == 4) {
		$( "#alerts" ).hide().append( '<div class="alert alert-danger" role="alert">'+alerttext+'</div>' ).slideToggle();
	}}, 800);	
}

function validateYouTubeUrl() {
    var url = $('#video').val();
        if (url != undefined || url != '') {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
				if (requesttimer == 1) {
				requesttimer = 0;
				timer();
				$( "#alerts" ).slideToggle().empty();
				connect()
				addalert(1, "Connecting...");
				$('#button').fadeOut('slow');		
				var customloop2 = setInterval(function(){ 
					if(SOCKET.connected == true) {
						clearInterval(customloop2);
						send({
							type: 'convert',
							CT: CT,
							url: match[2]
						});
					} 
				}, 250);
			
				setTimeout(function(){ 
				if(SOCKET.connected == false) {
					clearInterval(customloop2);
					$('#button').fadeIn('slow');
					addalert(4, "Unable to connect to the server. Try again later :)");
					SOCKET = null;
					} }, 2500);
					
				} 
            } else {
             addalert(3, "Please enter a valid YouTube URL");
            }
        } 
}


$( document ).ready(function() {
	$("#slider").slideReveal({
		trigger: $("#trigger"),
		push: false,
		overlay: true,
		width: 200
	});
	 $("#mp3").on("click", function () {
		 $('#mp4').css('background-color', '#8221ca');
         $('#mp3').css('background-color', '#58118c');
		  CT = 1; 
    });
	
	 $("#mp4").on("click", function () {
         $('#mp3').css('background-color', '#8221ca');
         $('#mp4').css('background-color', '#58118c');
		  CT = 2;
    });
	$(".convertbutton").on("click", function () {
	 if( document.getElementById('video').value === '' ){
		addalert(3, "Please enter a valid YouTube URL");
	 return; }
	validateYouTubeUrl()
	});
	
	$("#menubuttonopen").on("click", function () {
         $( "#menu" ).slideToggle( "slow");
    });
	
	
	 $("#download").on("click", function () {
		 window.location.href = HOST+'/'+downloadurl;
    });
	
	 $("#nextsong").on("click", function () {
		 refreshall();
    });
	
	 $("#AuthorBtn").click(function(){
        $("#Author").modal();
    });
	
	$("#slider").load("1.php");
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
particlesJS('particles-js',
  
{
  "particles": {
    "number": {
      "value": 10,
      "density": {
        "enable": true,
        "value_area": 200
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
}
);
	
});


