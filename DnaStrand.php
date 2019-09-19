<?php

/**
 * Class DnaStrand represents a DNA strand. You must provide the nucleic sequence to the constructor.
 * Allows for Hamming distance computation between two DNA strands, if they have the same number of nucleotides.
 */
class DnaStrand
{
    private $sequence_iterator = null;

    /**
     * DnaStrand constructor.
     * @param string $sequence the DNA strand's nucleic sequence
     */
    function __construct(string $sequence)
    {
        $split_sequence = str_split($sequence);
        $array_object_split_sequence = new ArrayObject($split_sequence);
        $this->sequence_iterator = $array_object_split_sequence->getIterator();
    }

    /**
     * Compute the Hamming distance between two DNA strands
     * @param DnaStrand $the_other_dna_strand the DNA strand to compare with
     * @return int the Hamming distance between two DNA strands
     * @throws DnaStrandDifferentLengthException if DNA strands are not of equal length
     */
    public function compareToOtherDnaStrandWithHammingDistance(DnaStrand $the_other_dna_strand) : int {
        $hamming_distance = 0;

        $this_sequence_iterator = $this->sequence_iterator;
        $the_other_dna_strand_iterator = $the_other_dna_strand->getSequenceIterator();

        $sizeA = $this_sequence_iterator->count();
        $sizeB = $the_other_dna_strand_iterator->count();
        if($sizeA != $sizeB) {
            throw new DnaStrandDifferentLengthException("DNA strands must be of equal length.");
        }

        while($the_other_dna_strand_iterator->valid()) {
            $current = $the_other_dna_strand_iterator->current();
            $current_key = $the_other_dna_strand_iterator->key();
            if($this_sequence_iterator->offsetGet($current_key) != $current) {
                $hamming_distance++;
            }
            $the_other_dna_strand_iterator->next();
        }

        return $hamming_distance;
    }

    private function getSequenceIterator() : ArrayIterator {
        return $this->sequence_iterator;
    }
}