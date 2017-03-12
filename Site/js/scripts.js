 document.onreadystatechange = function () {
     if (document.readyState == "complete") {
     // document is ready. Do your stuff here
$('.modal').modal({
    dismissible: true, // Modal can be dismissed by clicking outside of the modal
    opacity: .3, // Opacity of modal background
    inDuration: 300, // Transition in duration
    outDuration: 200, // Transition out duration
    startingTop: '4%', // Starting top style attribute
    endingTop: '10%', // Ending top style attribute
    
    }
    );







 $('#calendar').fullCalendar({
        googleCalendarApiKey: 'AIzaSyCOz5Z77z9O4gDAvCmmC2ya1y-NUETMQ4w',
        events: {
            googleCalendarId: 'jonathan.lafreniere@gmail.com',
        },
     
    });



$("#calendar").fullCalendar({

viewRender: function(view, element){
        alert(t);
    }

    });
    
    




    $('select').material_select();




   }
 }



/*
 var newEvent = new Object();

newEvent.title = "some text\n";
newEvent.start = new Date();
newEvent.allDay = true;
 var newEvent2 = new Object();

newEvent2.title = "some tesx2\n";
newEvent2.start = new Date();
newEvent2.allDay = true;
$('#calendar').fullCalendar( 'renderEvent', newEvent2 );
 */




