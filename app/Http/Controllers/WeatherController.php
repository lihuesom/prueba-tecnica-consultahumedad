<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\Csv\Writer;

class WeatherController extends Controller
{
    /**
     * Muestra los datos meteorológicos de una lista de ciudades.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Lista de ciudades
        $cities = ['Miami', 'Orlando', 'New York'];
        $weatherData = [];

        foreach ($cities as $city) {

            // Hacer la petición a la API
            $response = Http::get('http://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => 'd8b3f49cbd4ac8df467bab3a57e1541b',
                'units' => 'imperial',
            ]);
            
            // Almacenar los datos en un array
            $weatherData[$city] = [
                'city' => $city,
                'temperature' => $response['main']['temp'],
                'humidity' => $response['main']['humidity'],
                'wind_speed' => $response['wind']['speed'],
                'description' => $response['weather'][0]['description'],
            ];
        }
        // Guardar los datos en un archivo CSV
        $filename = 'weather_data.csv';
        $filepath = storage_path('app/' . $filename);

        if (file_exists($filepath)) {
            // El archivo existe, agregar filas nuevas
            $csv = Writer::createFromPath($filepath, 'a');
        } else {
            // El archivo no existe, crear encabezado y agregar filas nuevas
            $csv = Writer::createFromPath($filepath, 'w+');
            $csv->insertOne(['City', 'Temperature', 'Humidity', 'Wind Speed', 'Description']);
        }

        foreach ($weatherData as $data) {
            $csv->insertOne([$data['city'], $data['temperature'], $data['humidity'], $data['wind_speed'], $data['description']]);
        }
            
        // Enviar los datos a la vista
        return view('map', ['weatherData'=>$weatherData]);
    }

    /**
     * Obtener los datos del clima del archivo CSV de historial y enviarlos a la vista.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getWeatherDataHistory(Request $request)
    {
         // Obtener la ruta del archivo
        $filename = 'weather_data.csv';
        $filepath = storage_path('app/' . $filename);

        // Verificar si el archivo existe
        if (!file_exists($filepath)) {
            return redirect()->back()->with('error', 'No hay datos disponibles para la fecha seleccionada');
        }

        // Leer el archivo CSV y convertir los datos a un array asociativo
        $data = array_map('str_getcsv', file($filepath));
        $keys = array_shift($data);
        $weatherData = array();
        foreach ($data as $row) {
            $row = array_combine($keys, $row);
            $weatherData[] = $row;
        }
        // Enviar los datos a la vista
        return view('history', ['weatherData'=> $weatherData]);

    }
}
