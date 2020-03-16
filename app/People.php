<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

/**
 * Class People
 * @package App
 */
class People extends Model
{

    /**
     * @param int $count
     *
     * @return array
     */
    public static function getData( $count = 10 ):array {
    	$response = Http::get('https://randomuser.me/api/', [
		    'results' => $count,
		    'nat' => 'es',
		]);

		$rows = $response->json();

		return self::parseData( (array) $rows['results']);
    }

    /**
     * @param array $rows
     *
     * @return array
     */
    public static function parseData( Array $rows = array() ):array {
    	$people = [];

    	$count = 0;
    	foreach( $rows as $row ) {
    		$people[$count]['name'] = $row['name']['first'] . ' ' . $row['name']['last'];
    		$people[$count]['gender'] = $row['gender'];
    		$people[$count]['location'] = $row['location'];
    		$people[$count]['email'] = $row['email'];
    		$people[$count]['login'] = $row['login'];
    		$people[$count]['age'] = $row['dob']['age'];
    		$people[$count]['birth'] = date('Y-m-d', strtotime($row['dob']['date']));
    		$people[$count]['phone'] = $row['phone'];
    		$people[$count]['cell'] = $row['cell'];
    		$people[$count]['id_type'] = $row['id']['name'];
    		$people[$count]['id_value'] = $row['id']['value'];
    		$people[$count]['picture'] = $row['picture'];

    		$count++;
    	}

    	return $people;
    }

}
