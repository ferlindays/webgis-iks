<?php


/**
 * Maps database query result to GeoJSON format.
 *
 * @param array $data Associative array of database query result.
 * @return array GeoJSON representation of the input data.
 */
function mapToGeoJSON($data)
{
    $features = [];
    foreach ($data as $item) {
        $features[] = [
            'type' => 'Feature',
            'geometry' => json_decode($item['geom'], true),
            'properties' => [
                'id' => $item['id'],
                'faskes' => $item['faskes'],
                'kalurahan' => $item['kalurahan'],
                'padukuhan' => $item['padukuhan'],
                'iks' => $item['iks'],
                'kategori' => $item['kategori'],
            ],
        ];
    }

    $geoJson = [
        "type" => "FeatureCollection",
        "features" => $features
    ];

    return $geoJson;
}
