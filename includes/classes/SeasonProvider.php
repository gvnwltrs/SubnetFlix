<?php
class SeasonProvider {

    private $connection, $username; 

    public function __construct($connection, $username) {
        $this->connection = $connection; 
        $this->username = $username; 
    }

    public function create($entity) {
       $seasons = $entity->getSeasons($entity);

       if(sizeof($seasons) == 0) {
            return; 
       }

       $seasonsHtml = ""; 
       foreach($seasons as $season) {
            $seasonNumber = $season->getSeasonNumber();  


            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                            </div>"; 
       }

       return $seasonsHtml;
    }
}
?>