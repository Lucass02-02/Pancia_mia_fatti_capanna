<?php // File: AppORM/Entity/ProductCategory.php

namespace AppORM\Entity;

/**
 * Enum che definisce le categorie dei prodotti.
 */
enum ProductCategory: string
{
    case ANTIPASTO = 'antipasto';
    case PRIMO = 'primo';
    case SECONDO = 'secondo';
    case CONTORNO = 'contorno';
    case DOLCE = 'dolce';
    case BEVANDA = 'bevanda';
}
