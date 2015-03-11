#Adding a Map to a DataObject

Using the standard method of adding extensions in SilverStripe 3.1, add an extension called 'MapExtension' to relevant DataObjects.

```
---
name: weboftalent-example-map-extensions
---
PageWithMap:
  extensions:
    ['MapExtension']

```

This adds Latitude, Longitude and Zoom fields to the DataObject in question, here 'PageWithMap'.  In addition, the admin interface for PageWithMap now has a location tab.  Location can be changed in 3 ways
* Use the geocoder and search for a place name
* Drag the map pin
* Right click
The zoom level set by the content editor is also saved.
To render a map in the template, simply called $BasicMap

```
<h1>$Title</h1>
$Content
$BasicMap
```

For an example of this, see http://demo.weboftalent.asia/mappable/quick-map-adding-a-map-to-a-dataobject/