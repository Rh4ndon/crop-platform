<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../../models/functions.php';

try {
    // Get farmer dashboard statistics
    $response = [];

    // Count available vegetables/crops
    $vegetablesCount = countAllRecords('crops');
    $response['vegetables_count'] = $vegetablesCount;

    // Count growth guides (same as vegetables for now, can be expanded)
    $response['growth_guides_count'] = $vegetablesCount;

    // Count treatment methods (calculated from crops data)
    $treatmentMethods = 0;
    $crops = getAllRecords('crops');
    foreach ($crops as $crop) {
        // Count non-empty treatment fields
        if (!empty($crop['recommended_pesticides'])) $treatmentMethods++;
        if (!empty($crop['recommended_fertilizers'])) $treatmentMethods++;
    }
    $response['treatment_methods_count'] = $treatmentMethods;

    // Get recently added vegetables (last 10)
    $recentVegetables = getAllRecords('crops', 'ORDER BY created_at DESC LIMIT 10');
    $response['recent_vegetables'] = $recentVegetables;

    // Get vegetables by category for quick stats
    $categoryCounts = [];
    $categoryQuery = getAllRecords('crops', 'GROUP BY category');
    foreach ($crops as $crop) {
        $category = ucfirst($crop['category']);
        if (!isset($categoryCounts[$category])) {
            $categoryCounts[$category] = 0;
        }
        $categoryCounts[$category]++;
    }
    $response['category_counts'] = $categoryCounts;

    // Get popular crops (for now, just get all crops with their basic info)
    $popularCrops = [];
    $limitedCrops = array_slice($crops, 0, 5); // Get first 5 crops
    foreach ($limitedCrops as $crop) {
        $popularCrops[] = [
            'id' => $crop['id'],
            'name' => $crop['crop_name'],
            'category' => $crop['category'],
            'growth_period' => $crop['growth_period'],
            'preferred_season' => $crop['preferred_season'],
            'image_path' => $crop['image_path'],
            'description' => substr($crop['description'], 0, 100) . '...' // Truncate description
        ];
    }
    $response['popular_crops'] = $popularCrops;

    // Get seasonal recommendations
    $currentMonth = date('n'); // 1-12
    $seasonalCrops = [];

    // Simple seasonal logic (can be expanded)
    foreach ($crops as $crop) {
        $season = $crop['preferred_season'];
        $isRecommended = false;

        if ($season === 'all') {
            $isRecommended = true;
        } elseif ($season === 'dry' && ($currentMonth >= 12 || $currentMonth <= 5)) {
            $isRecommended = true;
        } elseif ($season === 'wet' && ($currentMonth >= 6 && $currentMonth <= 11)) {
            $isRecommended = true;
        }

        if ($isRecommended) {
            $seasonalCrops[] = [
                'name' => $crop['crop_name'],
                'category' => $crop['category'],
                'growth_period' => $crop['growth_period'],
                'reason' => $season === 'all' ? 'Suitable year-round' : 'Perfect for current season'
            ];
        }
    }

    $response['seasonal_recommendations'] = array_slice($seasonalCrops, 0, 5);

    // Get farming tips (static for now, can be made dynamic)
    $farmingTips = [
        [
            'title' => 'Soil Preparation',
            'tip' => 'Always test your soil pH before planting. Most vegetables prefer slightly acidic to neutral soil (6.0-7.0 pH).',
            'icon' => 'bi-dirt'
        ],
        [
            'title' => 'Watering Schedule',
            'tip' => 'Water early morning or late evening to reduce evaporation and prevent leaf diseases.',
            'icon' => 'bi-droplet'
        ],
        [
            'title' => 'Pest Prevention',
            'tip' => 'Regular inspection of crops can help identify pest problems early. Prevention is better than cure.',
            'icon' => 'bi-bug'
        ],
        [
            'title' => 'Crop Rotation',
            'tip' => 'Rotate different crop families to maintain soil health and reduce pest and disease buildup.',
            'icon' => 'bi-arrow-clockwise'
        ]
    ];
    $response['farming_tips'] = $farmingTips;

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
