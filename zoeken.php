<?php
// ==========================================
// 1. LINEAIR ZOEKEN
// ==========================================
function linearSearch($array, $target) {
    foreach ($array as $element) {
        if ($element == $target) {
            return true;
        }
    }
    return false;
}

// ==========================================
// 2. BINAIR ZOEKEN
// ==========================================
function binarySearch($array, $target, $low, $high) {
    if ($low > $high) {
        return false;
    }
    
    // Zorg ervoor dat mid een geheel getal is
    $mid = (int)(($low + $high) / 2);

    if ($array[$mid] == $target) {
        return true;
    } else if ($array[$mid] > $target) {
        return binarySearch($array, $target, $low, $mid - 1);
    } else {
        return binarySearch($array, $target, $mid + 1, $high);
    }
}

// ==========================================
// 3. TESTEN MET 10.000 NUMMERS EN TIMING
// ==========================================

echo "Bezig met genereren van 10.000 willekeurige getallen...\n";

// Genereer een array met 10.000 willekeurige getallen
$array = [];
for ($i = 0; $i < 10000; $i++) {
    $array[] = rand(1, 100000);
}

// Sorteer de array van laag naar hoog (vereist voor binair zoeken)
sort($array);

// Het getal waar we naar op zoek zijn
$target = $array[5000]; // Pak een bestaand getal uit het midden

// --- Test Lineair Zoeken ---
$startTijdLineair = microtime(true);
$gevondenLineair = linearSearch($array, $target);
$eindTijdLineair = microtime(true);
$duurLineair = ($eindTijdLineair - $startTijdLineair) * 1000; // in milliseconden

// --- Test Binair Zoeken ---
$startTijdBinair = microtime(true);
$gevondenBinair = binarySearch($array, $target, 0, count($array) - 1);
$eindTijdBinair = microtime(true);
$duurBinair = ($eindTijdBinair - $startTijdBinair) * 1000; // in milliseconden

// --- Resultaten tonen ---
echo "\n--- RESULTATEN (Array van 10.000 elementen) ---\n";
echo "Gezocht naar getal: $target\n\n";

echo "Lineair zoeken:\n";
echo "- Gevonden: " . ($gevondenLineair ? "Ja" : "Nee") . "\n";
echo "- Tijd: " . number_format($duurLineair, 4) . " ms\n\n";

echo "Binair zoeken:\n";
echo "- Gevonden: " . ($gevondenBinair ? "Ja" : "Nee") . "\n";
echo "- Tijd: " . number_format($duurBinair, 4) . " ms\n";
?>