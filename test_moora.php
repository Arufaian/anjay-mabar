<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Service\MooraService;
use App\Models\Criteria;

echo "=== Testing MooraService with Sample Data ===\n\n";

try {
    $service = new MooraService();
    
    // Test weight validation
    echo "1. Testing Weight Validation:\n";
    $validation = $service->validateWeights();
    echo "   Valid: " . ($validation['valid'] ? 'Yes' : 'No') . "\n";
    echo "   Total Weight: " . number_format($validation['total_weight'], 4) . "\n";
    if (!empty($validation['issues'])) {
        echo "   Issues:\n";
        foreach ($validation['issues'] as $issue) {
            echo "     - " . $issue . "\n";
        }
    }
    echo "\n";

    // Get criteria info
    $criteria = Criteria::with('weight')->get();
    echo "2. Criteria Information:\n";
    foreach ($criteria as $c) {
        $weight = $c->weight ? number_format($c->weight->weight, 4) : '0.0000';
        echo "   {$c->code}: {$c->name} ({$c->type}) - Weight: {$weight}\n";
    }
    echo "\n";

    // Test calculation summary
    echo "3. Testing MOORA Calculation Summary:\n";
    $summary = $service->getCalculationSummary();
    
    if ($summary['success']) {
        echo "   Success: Yes\n";
        echo "   Total Alternatives: " . $summary['data']['total_alternatives'] . "\n";
        echo "   Total Criteria: " . $summary['data']['total_criteria'] . "\n";
        echo "   Scores Count: " . $summary['data']['scores_count'] . "\n";
        
        if (isset($summary['data']['best_alternative'])) {
            $best = $summary['data']['best_alternative'];
            echo "   Best Alternative: {$best['alternative']['name']} (Score: " . number_format($best['score'], 6) . ", Rank: {$best['rank']})\n";
        }
        
        echo "\n4. Full Ranking Results:\n";
        $ranked = $summary['data']['calculation_details']['ranked_alternatives'];
        foreach ($ranked as $item) {
            echo sprintf("   Rank %d: %s - Score: %.6f\n", 
                $item['rank'], 
                $item['alternative']['name'], 
                $item['score']
            );
        }
    } else {
        echo "   Error: " . $summary['error'] . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";