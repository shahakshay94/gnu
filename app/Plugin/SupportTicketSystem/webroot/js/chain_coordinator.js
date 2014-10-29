$(function() {
    function getData(selectedValue, targetUrl, destination) {
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
            	console.log(destination);
            	console.log(response);
                if (response.departments) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.departments, destination); // Another from duch with the appendData function added as well, but not working either.
                }
                if (response.staffs) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.staffs, destination);
				}
				 if (response.categories) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.categories, destination);
				}
            },

            error: function(response) {
                alert("An error occurred: " + e.responseText.message);
                console.log(response);
            }
        });
    }

	function appendData(data, destination) {
		console.log(destination);
		for (var prop in data) {
			if (data.hasOwnProperty(prop)) {
			$(destination).append('<option value="' + prop + '">' + data[prop] + '</option>');
			}
		}
	}

    $('#institutions').change(function() {
        var selectedValue	=	$(this).val(),
            destination 	=	$('#departments'),
            destcity		=	$('#staffs');

		if(selectedValue != '')
		{
            targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
            getData(selectedValue, targetUrl, destination);
			destcity.empty(),
			destcity.append('<option value="Select Department First">Select Department First</option>');

		}	else {
        destination.empty(),
        destination.append('<option value="Select Institution First">Select Institution First</option>');
		destcity.empty(),
		destcity.append('<option value="Select Department First">Select Department First</option>');
		}
    });

    $('#departments').change(function() {
		var selectedValue = $(this).val(),
			  destination = $('#staffs'),
			  destination1 = $('#categories');
		if(selectedValue != 'Please Select')
		{
			targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
			getData(selectedValue, targetUrl, destination);
			targetUrl = $(this).attr('data-rel') + '?id=' + selectedValue;
			getData(selectedValue, targetUrl, destination1);

		}	else {
		destination.empty(),
		destination.append('<option value="Select Department First">Select Department First</option>');
		}
    });
});
