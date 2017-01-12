

function AjaxRequestMainFun(OprationName,typev,urlv,datatypev,datav) {
	if (OprationName=='selectJSON') {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				var obj = JSON.parse(data);
				it_works = obj; // obj[1].CourtName;
			}
		});
		return	it_works;
	}	

	else if (OprationName=='insert') {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				it_works = data;  
			}
		});
		return	it_works;
	}	

	else if (OprationName=='update') {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				it_works = data;  
			}
		});
		return	it_works;
	}
	else if (OprationName=='delete') {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				it_works = data;  
			}
		});
		return	it_works;
	}
	else    {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				it_works = data;  
			}
		});
		return	it_works;
	}

}

 //=========================اشعارات البداية==================================

function reload_gritter(tit,sub,v1,v2) {
	setTimeout(function () {
		$.extend($.gritter.options, {
			position: 'top-left'
		});

		var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: tit,
                    // (string | mandatory) the text inside the notification
                    text: sub  ,
                    // (string | optional) the image to display on the left
                    image: './assets/img/Signal_attention.png',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: true,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'my-sticky-class'
                });

                // You can have it return a unique id, this can be used to manually remove it later using
                setTimeout(function () {
                	$.gritter.remove(unique_id, {
                		fade: true,
                		speed: 'slow'
                	});
                }, v1*1000);
            }, v2*1000);
}
 