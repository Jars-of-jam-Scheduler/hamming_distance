<?php
require_once 'DnaStrandDifferentLengthException.php';
require_once 'DnaStrand.php';

function distance(string $strandA, string $strandB) : int
{
    $dna_strand_a = new DnaStrand($strandA);
    $dna_strand_b = new DnaStrand($strandB);
    return $dna_strand_a->compareToOtherDnaStrandWithHammingDistance($dna_strand_b);
}
