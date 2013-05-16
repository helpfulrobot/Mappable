<?php
class MapMarkerBulkLoader extends CsvBulkLoader {
   public $columnMap = array(
      'Latitude' => 'Lat', 
      'Longitude' => 'Lon', 
      'Title' => 'Title',
      'MapMarkerSetID' => 'MapMarkerSet.ID'
   );

   public $duplicateChecks = array(
      'SpielerNummer' => 'PlayerNumber'
   );
   public $relationCallbacks = array(
      'MapMarkerSet.ID' => array(
         'relationname' => 'MapMarkerSets',
         'callback' => 'getMapMarkerSet'
      )
   );

   public static function getMapMarkerSet(&$obj, $val, $record) {
      return MapMarkerSet::get()->filter('ID', $this->MapMarkerSetID)->First());
   }
}
