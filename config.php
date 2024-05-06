    <?php
    define('MAILHOST', "smtp.gmail.com");
    define('USERNAME', "loujainrouached1@gmail.com");
    define('PASSWORD', "xtyq pqmf axcg xkpo");
    define('SEND_FROM', "loujainrouached1@gmail.com");
    define('SEND_FROM_NAME', "vieXplore");
    define('REPLY_TO', "loujainrouached1@gmail.com");
    define('REPLY_TO_NAME', "loujain");

    class config
    {
        private static $pdo = NULL;
    
        public static function getConnexion()
        {
            if (!isset(self::$pdo)) {
                try {
                    self::$pdo = new PDO(
                        'mysql:host=localhost;dbname=gestion_users','root','',
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]);
                   
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    }
    ?>

    
    
    
    
    
    
    
    
   









