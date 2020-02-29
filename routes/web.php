<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/r/{code}', function ($code) {
    $link = \App\Link::where('short_code', $code)->get()->first();
    $sourceLink = \App\Link::where('short_code', $code)->value('source_link');

    $city = null;
    $countryCode = null;
    $statistic = new \App\Statistic();
    $statistic->user_agent = request()->userAgent();
    $parser = new WhichBrowser\Parser($statistic->user_agent);

    $reader = new \GeoIp2\Database\Reader(resource_path() . '/GeoLite2/GeoLite2-City.mmdb');

    try {
       $record = $reader->city(request()->ip());
   } catch (\GeoIp2\Exception\AddressNotFoundException $exception) {
        $record = $reader->city(env('DEFAULT_IP_ADDR'));
    } finally {
        $city = $record->city->name;
        $countryCode = $record->country->isoCode;
   }

//    $result = file_get_contents('http://ip-api.com/json/' . request()->ip());
//    $data = json_decode($result, true);
//
//    if ($data['status'] == 'fail') {
//        $result = file_get_contents('http://ip-api.com/json/' . env('DEFAULT_IP_ADDR'));
//        $data = json_decode($result, true);
//
//        $city = $data['city'];
//        $countryCode = $data['countryCode'];
//    }

    $statistic = new \App\Statistic();
    $statistic->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $statistic->link_id = $link->id;
    $statistic->ip = request()->ip();
    $statistic->browser = $parser->browser->toString();
    $statistic->engine = $parser->engine->toString();
    $statistic->os = $parser->os->toString();
    $statistic->device = $parser->device->type;
    $statistic->country_code = $countryCode;
    $statistic->city_name = $city;
    $statistic->save();

    return redirect($link->source_link);

});
