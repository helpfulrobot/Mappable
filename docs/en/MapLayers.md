#Map Layers
KML layers can be added through the CMS by adding an extension to the class in question.

```
<?php
 
// layers are configured in _config.php
 
class PageWithMapAndLayers extends PageWithMap {
 
}
 
class PageWithMapAndLayers_Controller extends DemoPage_Controller {
 
}
?>
```

Add this to extensions.yml

```
PageWithMapAndLayers:
  extensions:
    ['MapExtension', 'MapLayersExtension']
```

Execute a /dev/build to update your database with the map layers relationship.

When you add a new page of type PageWithMapAndLayers, there is now an extra tab called 'Map Layers'.  Each layer consists of a human readable name and a file attachment, which in this case have to be KML files.
Templating is the same as before, the $BasicMap method takes account of layers when rendering a map.

##Gotchas
Note you will not be able to see map layers in your dev environment, as the KML file URL needs to be publicly visible in order that Google's servers can 

#Adding Lines to Maps
A line can be added to a map with the following API call:

```
    $map->addLine( $point1, $point2, $colorHexCode );
```

Each point is an array whose 0th element is the latitude and 1st element is the longitude.  The third parameter is optional and represents the color of the line in standard CSS hex code colors (RGB).

An example method to draw a multicolored triangle on a map is as follows:

```
/*
  Render a triangle around the provided lat,lon, zoom from the editing functions,
  */
  public function MapWithLines() {
    $map = $this->owner->getRenderableMap();
    $map->setZoom( $this->ZoomLevel );
    $map->setAdditionalCSSClasses( 'fullWidthMap' );
    $map->setShowInlineMapDivStyle( true );
 
    $scale = 0.3;
 
    // draw a triangle
    $point1 = array(
      $this->Lat - 0.5*$scale, $this->Lon
    );
    $point2 = array(
      $this->Lat + 0.5*$scale, $this->Lon-0.7*$scale
    );
 
    $point3 = array(
      $this->Lat + 0.5*$scale, $this->Lon+0.7*$scale
    );
 
    $map->addLine( $point1, $point2 );
    $map->addLine( $point2, $point3, '#000077' );
    $map->addLine( $point3, $point1, '#007700' );
 
    return $map;
  }
```



  Instead of calling $BasicMap call $MapWithLines instead from the template.

  See http://demo.weboftalent.asia/mappable/map-with-lines/ for a working demo.
