<?php

namespace App\Service;

use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Support\Collection;

class MooraService
{
    /**
     * Calculate complete MOORA analysis
     */
    public function calculate(): array
    {
        $alternatives = Alternative::with(['alternativeValues.criteria', 'alternativeValues.criteria.weight'])->get();
        $criteria = Criteria::with('weight')->get();

        if ($alternatives->isEmpty() || $criteria->isEmpty()) {
            throw new \Exception('No alternatives or criteria found for MOORA calculation');
        }

        $decisionMatrix = $this->buildDecisionMatrix($alternatives, $criteria);
        $normalizedMatrix = $this->normalizeMatrix($decisionMatrix);
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $criteria);
        $scores = $this->calculateScores($weightedMatrix, $criteria);
        $rankedAlternatives = $this->rankAlternatives($alternatives, $scores);

        return [
            'decision_matrix' => $decisionMatrix,
            'normalized_matrix' => $normalizedMatrix,
            'weighted_matrix' => $weightedMatrix,
            'scores' => $scores,
            'ranked_alternatives' => $rankedAlternatives,
            'criteria' => $criteria,
            'alternatives' => $alternatives,
        ];
    }

    /**
     * Build decision matrix from alternative values
     */
    private function buildDecisionMatrix(Collection $alternatives, Collection $criteria): array
    {
        $matrix = [];

        foreach ($alternatives as $alternative) {
            $row = [];
            foreach ($criteria as $criterion) {
                $value = $alternative->alternativeValues()
                    ->where('criteria_id', $criterion->id)
                    ->first();

                $row[$criterion->id] = $value ? (float) $value->value : 0;
            }
            $matrix[$alternative->id] = $row;
        }

        return $matrix;
    }

    /**
     * Normalize decision matrix using ratio analysis
     */
    private function normalizeMatrix(array $matrix): array
    {
        $normalized = [];

        // Get all criteria IDs
        $criteriaIds = array_keys(reset($matrix));

        // Calculate denominator for each criterion
        $denominators = [];
        foreach ($criteriaIds as $criterionId) {
            $sumOfSquares = 0;
            foreach ($matrix as $alternativeId => $row) {
                $sumOfSquares += pow($row[$criterionId], 2);
            }
            $denominators[$criterionId] = sqrt($sumOfSquares);
        }

        // Normalize each value
        foreach ($matrix as $alternativeId => $row) {
            $normalized[$alternativeId] = [];
            foreach ($criteriaIds as $criterionId) {
                if ($denominators[$criterionId] > 0) {
                    $normalized[$alternativeId][$criterionId] = $row[$criterionId] / $denominators[$criterionId];
                } else {
                    $normalized[$alternativeId][$criterionId] = 0;
                }
            }
        }

        return $normalized;
    }

    /**
     * Apply weights to normalized matrix
     */
    private function applyWeights(array $normalizedMatrix, Collection $criteria): array
    {
        $weighted = [];
        $weightsMap = [];

        // Build weights map
        foreach ($criteria as $criterion) {
            $weightsMap[$criterion->id] = $criterion->weight ? (float) $criterion->weight->weight : 0;
        }

        // Apply weights
        foreach ($normalizedMatrix as $alternativeId => $row) {
            $weighted[$alternativeId] = [];
            foreach ($row as $criterionId => $value) {
                $weighted[$alternativeId][$criterionId] = $value * ($weightsMap[$criterionId] ?? 0);
            }
        }

        return $weighted;
    }

    /**
     * Calculate MOORA scores (benefit - cost)
     */
    private function calculateScores(array $weightedMatrix, Collection $criteria): array
    {
        $scores = [];
        $benefitCriteria = $criteria->filter(fn ($c) => $c->type === 'benefit')->pluck('id')->toArray();
        $costCriteria = $criteria->filter(fn ($c) => $c->type === 'cost')->pluck('id')->toArray();

        foreach ($weightedMatrix as $alternativeId => $row) {
            $benefitSum = 0;
            $costSum = 0;

            foreach ($row as $criterionId => $value) {
                if (in_array($criterionId, $benefitCriteria)) {
                    $benefitSum += $value;
                } elseif (in_array($criterionId, $costCriteria)) {
                    $costSum += $value;
                }
            }

            $scores[$alternativeId] = $benefitSum - $costSum;
        }

        return $scores;
    }

    /**
     * Rank alternatives based on scores
     */
    private function rankAlternatives(Collection $alternatives, array $scores): array
    {
        $ranked = [];

        foreach ($alternatives as $alternative) {
            $ranked[] = [
                'alternative' => $alternative,
                'score' => $scores[$alternative->id] ?? 0,
                'rank' => 0, // Will be calculated below
            ];
        }

        // Sort by score (descending)
        usort($ranked, fn ($a, $b) => $b['score'] <=> $a['score']);

        // Assign ranks
        foreach ($ranked as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return $ranked;
    }

    /**
     * Get calculation summary for display
     */
    public function getCalculationSummary(): array
    {
        try {
            $result = $this->calculate();

            return [
                'success' => true,
                'data' => [
                    'best_alternative' => $result['ranked_alternatives'][0] ?? null,
                    'total_alternatives' => count($result['alternatives']),
                    'total_criteria' => count($result['criteria']),
                    'scores_count' => count($result['scores']),
                    'calculation_details' => $result,
                ],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate MOORA for user with budget filtering
     */
    public function calculateForUser(float $minBudget, float $maxBudget): array
    {
        $priceCriteria = Criteria::where('code', 'C1')->first();
        
        // Filter alternatif berdasarkan budget
        $alternatives = Alternative::whereHas('alternativeValues', function($query) use ($priceCriteria, $minBudget, $maxBudget) {
            $query->where('criteria_id', $priceCriteria->id)
                  ->whereBetween('value', [$minBudget, $maxBudget]);
        })->with(['alternativeValues.criteria', 'alternativeValues.criteria.weight'])->get();

        if ($alternatives->isEmpty()) {
            return [
                'success' => false,
                'error' => 'Tidak ada alternatif yang tersedia dalam budget range tersebut.',
                'alternatives_count' => 0,
            ];
        }

        $criteria = Criteria::with('weight')->get();
        $decisionMatrix = $this->buildDecisionMatrix($alternatives, $criteria);
        $normalizedMatrix = $this->normalizeMatrix($decisionMatrix);
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $criteria);
        $scores = $this->calculateScores($weightedMatrix, $criteria);
        $rankedAlternatives = $this->rankAlternatives($alternatives, $scores);

        return [
            'success' => true,
            'data' => [
                'best_alternative' => $rankedAlternatives[0] ?? null,
                'total_alternatives' => count($alternatives),
                'total_criteria' => count($criteria),
                'budget_range' => [
                    'min' => $minBudget,
                    'max' => $maxBudget,
                    'filtered_count' => count($alternatives)
                ],
                'ranked_alternatives' => $rankedAlternatives,
            ],
        ];
    }

    /**
     * Validate weights configuration
     */
    public function validateWeights(): array
    {
        $criteria = Criteria::with('weight')->get();
        $totalWeight = 0;
        $issues = [];

        foreach ($criteria as $criterion) {
            $weight = $criterion->weight ? (float) $criterion->weight->weight : 0;
            $totalWeight += $weight;

            if ($weight < 0 || $weight > 1) {
                $issues[] = "Weight for {$criterion->name} must be between 0 and 1";
            }
        }

        if (abs($totalWeight - 1.0) > 0.001) {
            $issues[] = 'Total weights must equal 1.00, current total: '.number_format($totalWeight, 4);
        }

        return [
            'valid' => empty($issues),
            'total_weight' => $totalWeight,
            'issues' => $issues,
        ];
    }
}
