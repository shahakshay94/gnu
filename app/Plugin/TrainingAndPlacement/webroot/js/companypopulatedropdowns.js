$(function() {
    function getData(selectedValue, targetUrl, destination) {
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
                if (response.companyJobs) {
					destination.empty(),
					destination.append('<option value="Please Select">Please Select</option>');
					appendData(response.companyJobs, destination); // Another from duch with the appendData function added as well, but not working either.
                }
                
            },

            error: function(response) {
                alert("An error occurred: " + e.responseText.message);
                console.log(response);
            }
        });
    }

	function appendData(data, destination) {
		for (var prop in data) {
			if (data.hasOwnProperty(prop)) {
			$(destination).append('<option value="' + prop + '">' + data[prop] + '</option>');
			}
		}
	}

     $('#company_masters').change(function() {
        var selectedValue = $(this).val(),
              destination = $('#company_jobs');
        if(selectedValue != 'Please Select')
        {
            targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
            getData(selectedValue, targetUrl, destination);
        }   else {
        destination.empty(),
        destination.append('<option value="Select Company First">Select Company First</option>');
        }
    });
    

   
});
