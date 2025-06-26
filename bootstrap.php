    <?php
    require_once __DIR__ . '/vendor/autoload.php';
    //require_once __DIR__ . '/config/config.php'; // Assicurati che il file config.php esista e contenga le costanti DB_HOST, DB_NAME, DB_USER, DB_PASS

    use Doctrine\DBAL\DriverManager;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;
    function getEntityManager(): EntityManager{
            $paths = array(__DIR__ . '/AppORM/Entity');
            $isDevMode = true;

            $proxyDir = __DIR__ . '/var/cache/doctrine/Proxy'; // Percorso all'interno del tuo progetto
            if (!is_dir($proxyDir)) {
                mkdir($proxyDir, 0775, true); // Crea la cartella con permessi appropriati
            }

            $config = ORMSetup::createAttributeMetadataConfiguration(
                $paths,
                $isDevMode,
                $proxyDir // PASSA QUI LA DIRECTORY PROXY CONFIGURATA
            );
            $dbParams = [
                        'dbname'   => 'testdb',
                        'user'     => 'root',
                        'password' => '',
                        'host'     => 'localhost',
                        'driver'   => 'pdo_mysql',
                        ];
            $connection = DriverManager::getConnection($dbParams, $config);
            $entityManager = new EntityManager($connection, $config);
            return $entityManager;

        }
    