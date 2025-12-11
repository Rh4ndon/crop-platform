<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../models/functions.php';

$crop_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get crops with condition
$crops = getAllRecords("crops", "WHERE id = $crop_id");

$response = array();

// Check if we got any results
if ($crops && count($crops) > 0) {
    foreach ($crops as $crop) { // Changed variable name to avoid conflict
        $response[] = array(
            'id' => $crop['id'],
            'crop_name' => $crop['crop_name'],
            'category' => $crop['category'],
            'image_path' => $crop['image_path'],
            'description' => $crop['description'],
            'growth_period' => $crop['growth_period'],
            'preferred_season' => $crop['preferred_season'],
            'soil_type' => $crop['soil_type'],
            'soil_ph' => $crop['soil_ph'],
            'crop_calendar' => $crop['crop_calendar'],
            'soil_properties' => $crop['soil_properties'],
            'weather_season' => $crop['weather_season'],
            'average_yields' => $crop['average_yields'],
            'harvesting_methods' => $crop['harvesting_methods'],
            'field_topography' => $crop['field_topography'],
            'common_pests_diseases' => $crop['common_pests_diseases'],
            'recommended_pesticides' => $crop['recommended_pesticides'],
            'spray_method' => $crop['spray_method'],
            'recommended_fertilizers' => $crop['recommended_fertilizers'],
            'fertilizer_application' => $crop['fertilizer_application'],
            'created_by' => $crop['created_by'],
            'created_at' => $crop['created_at'],
            'updated_at' => $crop['updated_at']
        );
    }
} else {
    // No records found or error
    $response = array(
        'error' => true,
        'message' => 'No crops found or database error'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
