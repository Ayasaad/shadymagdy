<?php
require_once('config.php');

include('header.php');

?>






<div class="page-content">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<div id="portlet-config" class="modal hide">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button"></button>
			<h3>portlet Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here will be a configuration form</p>
		</div>
	</div>
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<div class="color-panel hidden-phone">
					<div class="color-mode-icons icon-color"></div>
					<div class="color-mode-icons icon-color-close"></div>
					<div class="color-mode">
						<p>THEME COLOR</p>
						<ul class="inline">
							<li class="color-black current color-default" data-style="default-rtl"></li>
							<li class="color-blue" data-style="blue-rtl"></li>
							<li class="color-brown" data-style="brown-rtl"></li>
							<li class="color-purple" data-style="purple-rtl"></li>
							<li class="color-grey" data-style="grey-rtl"></li>
							<li class="color-white color-light" data-style="light-rtl"></li>
						</ul>
						<label>
							<span>Layout</span>
							<select class="layout-option m-wrap small">
								<option value="fluid" selected>Fluid</option>
								<option value="boxed">Boxed</option>
							</select>
						</label>
						<label>
							<span>Header</span>
							<select class="header-option m-wrap small">
								<option value="fixed" selected>Fixed</option>
								<option value="default">Default</option>
							</select>
						</label>
						<label>
							<span>Sidebar</span>
							<select class="sidebar-option m-wrap small">
								<option value="fixed">Fixed</option>
								<option value="default" selected>Default</option>
							</select>
						</label>
						<label>
							<span>Footer</span>
							<select class="footer-option m-wrap small">
								<option value="fixed">Fixed</option>
								<option value="default" selected>Default</option>
							</select>
						</label>
					</div>
				</div>
				<!-- END BEGIN STYLE CUSTOMIZER --> 
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					شاشة السكرتارية
					<small>الشاشة السكرتارية</small>
				</h3>
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.html">Home</a> 
						<i class="icon-angle-left"></i>
					</li>
					<li>
						<a href="#">Layouts</a>
						<i class="icon-angle-left"></i>
					</li>
					<li><a href="#">Blank Page</a></li>
				</ul>  
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="portlet box blue calendar">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>Calendar</div>
				</div>
				<div class="portlet-body light-grey">
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span12 fix-margin" data-desktop="span8">


							<a href="#" id="ttest">ddd</a>

							<!-- BEGIN DRAGGABLE EVENTS PORTLET-->    
							<h3 class="event-form-title">Draggable Events</h3>
							<div id="external-events">
								<form class="inline-form">
									<input type="text" value="" class="m-wrap span12" placeholder="Event Title..." id="event_title" /><br />
									<a href="javascript:;" id="event_add" class="btn green">Add Event</a>
								</form>
								<hr />
								<div id="event_box"></div>
								<label for="drop-remove">
									<input type="checkbox" id="drop-remove" />remove after drop                         
								</label>
								<hr class="visible-phone" />
							</div>
							<!-- END DRAGGABLE EVENTS PORTLET-->            
						</div>
						<div class="span9">
							<div id="calendar" class="has-toolbar"></div>
						</div>
					</div>
					<!-- END CALENDAR PORTLET-->
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER--> 
</div>


<?php
include('footer.php');

?>





<script type="text/javascript">

	$('#ttest').live("click",function(){

		$.ajax({
			type: 'POST',
			url:'getCalenderEvents.php',
			dataType: 'json', 
			success: function (data) {
				 
				alert(data.title);
			} 
		});
	});


	
	var Calendar = function () {


		return {
        //main function to initiate the module
        init: function () {
        	Calendar.initCalendar();
        },

        initCalendar: function () {

        	if (!jQuery().fullCalendar) {
        		return;
        	}

        	var date = new Date();
        	var d = date.getDate();
        	var m = date.getMonth();
        	var y = date.getFullYear();

        	var h = {};

        	if (App.isRTL()) {
        		if ($('#calendar').parents(".portlet").width() <= 720) {
        			$('#calendar').addClass("mobile");
        			h = {
        				right: 'title, prev, next',
        				center: '',
        				right: 'agendaDay, agendaWeek, month, today'
        			};
        		} else {
        			$('#calendar').removeClass("mobile");
        			h = {
        				right: 'title',
        				center: '',
        				left: 'agendaDay, agendaWeek, month, today, prev,next'
        			};
        		}                
        	} else {
        		if ($('#calendar').parents(".portlet").width() <= 720) {
        			$('#calendar').addClass("mobile");
        			h = {
        				left: 'title, prev, next',
        				center: '',
        				right: 'today,month,agendaWeek,agendaDay'
        			};
        		} else {
        			$('#calendar').removeClass("mobile");
        			h = {
        				left: 'title',
        				center: '',
        				right: 'prev,next,today,month,agendaWeek,agendaDay'
        			};
        		}
        	}


        	var initDrag = function (el) {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim(el.text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                el.data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                el.draggable({
                	zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            }

            var addEvent = function (title) {
            	title = title.length == 0 ? "Untitled Event" : title;
            	var html = $('<div class="external-event label">' + title + '</div>');
            	jQuery('#event_box').append(html);
            	initDrag(html);
            }

            $('#external-events div.external-event').each(function () {
            	initDrag($(this))
            });

            $('#event_add').unbind('click').click(function () {
            	var title = $('#event_title').val();
            	addEvent(title);
            });

            //predefined events
            $('#event_box').html("");
            addEvent("تصوير");
            addEvent("متابعة التنفيذ");
            addEvent("تصوير الحكم");
            addEvent("منطوق الحكم");
            addEvent("اول جلسة");
            

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
 
		   $('#calendar').fullCalendar({ //re-initialize the calendar
		   	header: h,
		   	slotMinutes: 15,
		   	editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped
                	alert('droping');

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.className = $(this).attr("data-class");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {

                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },






                events: 'getCalenderEvents.php'


            });
 





}

};

}();

</script>
