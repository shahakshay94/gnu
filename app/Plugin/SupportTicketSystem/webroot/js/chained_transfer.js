$(function() {
    function getData(selectedValue, targetUrl, destination) {
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
                if (response.categories) {
                    destination.empty(),
                    destination.append('<option value="Please Select">Please Select</option>');
                    appendData(response.categories, destination); 
            }},

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

    

    $('#departments').change(function() {
        var selectedValue = $(this).val(),
              destination = $('#categories');
        if(selectedValue != 'Please Select')
        {
            targetUrl = $(this).attr('rel') + '?id=' + selectedValue;
            getData(selectedValue, targetUrl, destination);
        }   else {
        destination.empty(),
        destination.append('<option value="Select Department First">Select Department First</option>');
        }
    });
});