/*
* При полной загрузке документа
* мы начинаем определять события
*/
$(document).ready(function () {
    /*
     * На выборе селекта страны — вешаем событие,
     * функция будет брать значение этого селекта
     * и с помощью ajax запроса получать список
     * городов для вставки в следующий селект
     */
    $('#country_id').change(function () {
        var country_id = $(this).val();

        if (country_id == '0') {
            $('#region_id').html('<option>- выберите область -</option>');
            $('#region_id').attr('disabled', true);
            return (false);
        }

        $('#region_id').attr('disabled', true);
        $('#region_id').html('<option>загрузка...</option>');
        var url = '/regions';
        $.get(
            url,
            "country_id=" + country_id,
            function (result) {

                if (result.type == 'error') {
                    /*
                     * ошибка в запросе
                     */
                    alert('error');
                    return (false);
                }
                else {
                    let items = [];
                    items = showRegions(result.regions);
                    $('#region_id').html(items);
                    $('#region_id').attr('disabled', false);
                }
            },
            "json"
        );
    });

    $('#region_id').change(function () {
        // alert($(this).val());
        var region_id = $(this).val();

        if (region_id == '0') {
            $('#city_id').html('<option>- выберите город -</option>');
            $('#city_id').attr('disabled', true);
            return (false);
        }

        $('#city_id').attr('disabled', true);
        $('#city_id').html('<option>загрузка...</option>');
        var url = '/cities';
        $.get(
            url,
            "region_id=" + region_id,
            function (result) {

                if (result.type == 'error') {
                    /*
                     * ошибка в запросе
                     */
                    alert('error');
                    return (false);
                }
                else {
                    let items= [];
                    items = showCities(result.cities);
                    $('#city_id').html(items);
                    $('#city_id').attr('disabled', false);
                }
            },
            "json"
        );
    });
});

function showRegions(data) {
    let items = [];
    // console.log(JSON.parse(result));
    items.push('<option value="0">Выберите регион</option>');
    $.each(data, function (key, val) {
        // console.log(val.region_id);
        // alert(key);
        items.push('<option value="' + val.region_id + '">' + val.title_ru + '</option>');
    });
    return items;
}
function showCities(data) {
    let items = [];
    // console.log(JSON.parse(result));
    items.push('<option value="0">Выберите город</option>');
    $.each(data, function (key, val) {
        // console.log(val.city_id);
        items.push('<option value="' + val.city_id + '">' + val.title_ru + '</option>');
    });
    return items;
}