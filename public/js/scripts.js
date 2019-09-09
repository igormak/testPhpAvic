// Empty JS for your own code to be here


$("#exampleInputRegion").chosen().change( function() {
    var region = $('#exampleInputRegion').val();

    $('#formCity').css('display', 'block');
    $('#formDistrict').css('display', 'none');

    $.ajax({
        type: 'POST',
        url: "/getCity/",
        data: {region:region},
        cache: false,
        success: function(city){
            $('#exampleInputCity').html('<option></option>');
            for (var key in city) {
                $('#exampleInputCity').append('<option value="' +city[key][0]+ '">' +city[key][1]+ '</option>');
            }

            $("#exampleInputCity").chosen({no_results_text: "Oops, nothing found!"});
            $("#exampleInputCity").trigger("chosen:updated");
        }
    });
} );



$("#exampleInputCity").change( function() {
    var city = $('#exampleInputCity').val();

    $('#formDistrict').css('display', 'block');

    $.ajax({
        type: 'POST',
        url: "/getDistrict/",
        data: {city:city},
        cache: false,
        success: function(district){
            $('#exampleInputDistrict').html('<option></option>');
            for (var key in district) {
                $('#exampleInputDistrict').append('<option value="' +district[key][0]+ '">' +district[key][1]+ '</option>');
            }

            $("#exampleInputDistrict").chosen({no_results_text: "Oops, nothing found!"});
            $("#exampleInputDistrict").trigger("chosen:updated");
        }
    });
} );



function checkIn(){
    var fio =  $('#exampleInputFio').val();
    var email = $('#exampleInputEmail').val();
    var region = $('#exampleInputRegion').val();
    var city = $('#exampleInputCity').val();
    var district = $('#exampleInputDistrict').val();

    if (!fio) {
        $("#message").html('<span style="color: red">Поле ФИО не может быть пустым</span>');
        return;
    }
    if (!email) {
        $("#message").html('<span style="color: red">Поле Email не может быть пустым</span>');
        return;
    }
    if (!region) {
        $("#message").html('<span style="color: red">Поле Область не может быть пустым</span>');
        return;
    }
    if (!city) {
        $("#message").html('<span style="color: red">Поле Город не может быть пустым</span>');
        return;
    }
    if (!district) {
        $("#message").html('<span style="color: red">Поле Район не может быть пустым</span>');
        return;
    }


    if(email && fio && region && city && district)
    {
        $.ajax({
            type: 'POST',
            url: "/checkIn/",
            data: {fio:fio, email:email, region:region, city:city, district:district},
            cache: false,
            success: function(message){
                $("#message").html(message);

            }
        });
    }
}
