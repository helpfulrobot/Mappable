<?php
class MapMarkerAdmin extends ModelAdmin {
    
  public static $managed_models = array(   //since 2.3.2
      'MapMarkerSet', 'MapMarker', 'MapMarkerType'
   );
 
  static $url_segment = 'map_markers'; // will be linked as /admin/products
  static $menu_title = 'Map Markers';
 
}

?>