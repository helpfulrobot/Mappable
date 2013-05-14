<?php

class MapMarkerType extends DataObject
{
    static $db = array(
        'Title' => 'Varchar',
        'Description' => 'HTMLText'
   );
    
    static $has_many = array(
        'MapMarkers' => 'MapMarker'
   );


    static $has_one = array(
    	'MarkerImage' => 'Image',
    	'MarkerShadow' => 'Image'
   );


    function getCMSFields() {
    	$fields = new FieldList();

    	$fields->push(new TabSet("Root", $mainTab = new Tab("Main")));
    	$mainTab->setTitle(_t('SiteTree.TABMAIN', "Main"));


    	$fields->addFieldToTab('Root.Main',  new TextField('Title', 'Title'));
    	$fields->addFieldToTab('Root.Main', $taf = new HTMLEditorField('Description', 'Description') );

    	$fields->addFieldToTab('Root.Main', new UploadField('MarkerImage', 'Marker to show on the map.  Leave blank for default map pin.'));
    	$fields->addFieldToTab('Root.Main', new UploadField('MarkerImageShadow', 'Shadow of the marker to show on the map.  Leave blank for default map pin.'));
    	$taf->setRows(5);

   		return $fields;
   }
    
}
