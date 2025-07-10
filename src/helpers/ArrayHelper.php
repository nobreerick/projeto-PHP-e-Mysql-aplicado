<?php

namespace Nobreerick\MyphpsqlWeb\helpers;

function extractAtribute(array $productData, int $index): string 
    {
        $atribute = array_keys($productData);
        if (!isset($atribute[$index])) {
            throw new \InvalidArgumentException("Índice não está entre 0 e 4, portanto é inválido: $index");
        }
        return $atribute[$index]; 
    }