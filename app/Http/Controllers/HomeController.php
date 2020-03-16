<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        // Init vars
        $data = [];

        // Get data from API
    	$collection = collect(People::getData());

        // Collect Fetch & order
        $data['persons'] = $collection->sortByDesc('name')
            ->values()
            ->all();

        // Collet Fetch & find
        $data['filterAge'] = $collection->sortBy('age')
            ->firstWhere('age', '>', $request->get('age',20));

        // Collect Fetch & count
        $data['countChars'] = [];
        $data['countChars']['persons'] = collect($data['persons'])
            ->splice(5)
            ->all();

        $contactNameChars = "";
        foreach( $data['countChars']['persons'] as $person ) {
            $contactNameChars .= str_replace(" ", "", strtoupper($this->clean($person['name'])));
        }

        $arrayNameChars = str_split($contactNameChars);

        $collectChars = collect( array_count_values($arrayNameChars) );

        $countNameChars = $collectChars->sortDesc()
            ->all();

        foreach( $countNameChars as $key => $value ) {
            $data['countChars']['letter'] = $key;
            $data['countChars']['count'] = $value;
            break;
        }

        // Render view
        return view('welcome', $data);

    }


    /**
     * @param $string
     *
     * @return string|string[]|null
     */
    private function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }


}
