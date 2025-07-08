<?php
// File: AppORM/Services/Utility/UUrl.php (AGGIORNATO E POTENZIATO)
namespace AppORM\Services\Utility;

class UUrl
{
    /**
     * Il percorso base del tuo progetto.
     */
    private static string $basePath = '/Pancia_mia_fatti_capanna';

    /**
     * Crea un URL completo e pulito partendo dai parametri del tag {url}.
     * Esempio: {url controller='table' action='delete' id=$table->getIdTable()}
     * diventa: /Pancia_mia_fatti_capanna/table/delete/15
     *
     * @param array $params I parametri passati dal tag {url ...}
     * @return string
     */
    public static function C(array $params): string
    {
        $url = self::$basePath;

        // Aggiunge il controller se presente
        if (isset($params['controller'])) {
            $url .= '/' . $params['controller'];
        }

        // Aggiunge l'azione se presente
        if (isset($params['action'])) {
            $url .= '/' . $params['action'];
        }

        // Aggiunge l'ID (o altri parametri) se presenti
        // Possiamo passare anche altri parametri oltre a 'id'
        $reserved_params = ['controller', 'action'];
        foreach ($params as $key => $value) {
            if (!in_array($key, $reserved_params)) {
                $url .= '/' . $value;
            }
        }

        return $url;
    }
}